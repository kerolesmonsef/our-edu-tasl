<?php /** @noinspection PhpLanguageLevelInspection */


namespace App\Services\Filters\QueryFiltersClasses;


use App\Services\Filters\IFilter;
use Illuminate\Database\Eloquent\Builder;

class WhereTransactionCurrency extends IFilter
{
    private $currency;

    public function __construct($currency, $askCheck = null)
    {
        parent::__construct($askCheck ?? $currency);
        $this->currency = $currency;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function applyFilter($builder)
    {
        return $builder->where("transactions.currency", $this->currency);
    }
}