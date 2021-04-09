<?php

declare(strict_types=1);

namespace App\Core\Http\Response\Api\v1;

class Error implements \JsonSerializable
{
    /**
     * @var string
     */
    private string $code;

    /**
     * @var string
     */
    private string $message;

    /**
     * @param string $code
     * @param string $message
     */
    public function __construct(string $code, string $message)
    {
        $this->code    = $code;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'code'    => $this->code,
            'message' => $this->message,
        ];
    }
}
