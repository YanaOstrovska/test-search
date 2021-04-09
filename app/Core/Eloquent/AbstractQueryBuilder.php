<?php

declare(strict_types=1);

namespace App\Core\Eloquent;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of \Illuminate\Database\Eloquent\Model
 * @extends \Illuminate\Database\Eloquent\Builder<TModelClass>
 */
abstract class AbstractQueryBuilder extends Builder
{

}
