<?php

declare(strict_types=1);

namespace App\Core\Http\Response\Api\v1;

use App\Core\Http\Resource\JsonResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse as LaravelJsonResponse;
use Illuminate\Support\Arr;
use JsonSerializable;
use Symfony\Component\HttpFoundation\JsonResponse as SymfonyJsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class JsonResponse implements Responsable
{
    /**
     * @var int
     */
    private int $status;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string[]
     */
    private array $headers;

    /**
     * @var \App\Core\Http\Response\Api\v1\Error|null
     */
    private ?Error $error = null;

    /**
     * @var string[][]
     */
    private array $validation = [];

    /**
     * @var \Throwable|null
     */
    private ?Throwable $exception = null;

    /**
     * @var int
     */
    private int $options = 0;

    /**
     * @param mixed    $data
     * @param int      $status
     * @param string[] $headers
     */
    public function __construct($data, int $status, array $headers = [])
    {
        $this->data    = $data;
        $this->status  = $status;
        $this->headers = $headers;
    }

    /**
     * @return self
     */
    public static function null(): self
    {
        return new self(null, Response::HTTP_OK);
    }

    /**
     * @param bool $value
     *
     * @return self
     */
    public static function boolean(bool $value): self
    {
        return new self((int)$value, Response::HTTP_OK);
    }

    /**
     * @param \App\Core\Http\Resource\JsonResource $resource
     *
     * @return self
     */
    public static function resource(JsonResource $resource): self
    {
        return new self($resource, Response::HTTP_OK);
    }

    /**
     * @param \App\Core\Http\Resource\JsonResource $resource
     *
     * @return self
     */
    public static function resourceCreated(JsonResource $resource): self
    {
        return new self($resource, Response::HTTP_CREATED);
    }

    /**
     * @param string $message
     *
     * @return self
     */
    public static function unauthenticated(string $message): self
    {
        $code = Response::HTTP_UNAUTHORIZED;

        return self::error("HTTP{$code}", $message, $code);
    }

    /**
     * @param string $code
     * @param string $text
     * @param int    $status
     *
     * @return \App\Core\Http\Response\Api\v1\JsonResponse
     */
    public static function error($code, string $text, int $status = Response::HTTP_INTERNAL_SERVER_ERROR): self
    {
        return (new self(null, $status))->setError(new Error((string)$code, $text));
    }

    /**
     * @param string $message
     *
     * @return self
     */
    public static function forbidden(string $message): self
    {
        $code = Response::HTTP_FORBIDDEN;

        return self::error("HTTP{$code}", $message, $code);
    }

    /**
     * @param \App\Core\Http\Response\Api\v1\Error $error
     *
     * @return $this
     */
    public function setError(Error $error): self
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function toResponse($request): SymfonyJsonResponse
    {
        $payload = [];

        if ($this->status >= Response::HTTP_OK && $this->status < Response::HTTP_MULTIPLE_CHOICES) {
            $payload['result'] = $this->prepareResult();
        }

        if ($this->error) {
            $payload['error'] = $this->error->jsonSerialize();
        }

        if ($this->validation) {
            $payload['validation'] = $this->validation;
        }

        if ($this->exception) {
            $payload['exception'] = $this->prepareException();
        }

        return (new LaravelJsonResponse($payload, $this->status, $this->headers))
            ->setEncodingOptions($this->options);
    }

    /**
     * @param string[][] $errors
     *
     * @return \App\Core\Http\Response\Api\v1\JsonResponse
     */
    public function addValidation(array $errors): self
    {
        $this->validation = $errors;

        return $this;
    }

    /**
     * @param \Throwable $e
     *
     * @return $this
     */
    public function setException(Throwable $e): self
    {
        $this->exception = $e;

        return $this;
    }

    /**
     * @param string[] $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @param int $options
     *
     * @return $this
     */
    public function setOptions(int $options): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return mixed[]|int|null
     */
    private function prepareResult()
    {
        if ($this->data instanceof JsonSerializable) {
            return $this->data->jsonSerialize();
        }

        return $this->data;
    }

    /**
     * @return mixed[]|null
     */
    private function prepareException(): ?array
    {
        if (!$this->exception) {
            return null;
        }

        return [
            'message'   => $this->exception->getMessage(),
            'exception' => get_class($this->exception),
            'file'      => $this->exception->getFile(),
            'line'      => $this->exception->getLine(),
            'trace'     => collect($this->exception->getTrace())->map(static function ($trace) {
                return Arr::except($trace, ['args']);
            })->all(),
        ];
    }
}
