<?php


namespace App\Services\Filters\QueryFiltersClasses;


use App\Services\Filters\IFilter;
use Illuminate\Database\Eloquent\Builder;

class WhereTransactionStatus extends IFilter
{
    private $status;

    public function __construct($status, $askCheck = null)
    {
        parent::__construct($askCheck ?? $status);
        $this->status = $status;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function applyFilter($builder)
    {
        $types = [
            'authorized' => 1,
            'decline' => 2,
            'refunded' => 3
        ];


        $status = $types[$this->status] ?? null;

        if (!$status) return $builder;

        return $builder->where("transactions.statusCode", $status);
    }
}