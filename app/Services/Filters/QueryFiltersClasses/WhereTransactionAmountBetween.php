<?php /** @noinspection PhpLanguageLevelInspection */


namespace App\Services\Filters\QueryFiltersClasses;


use App\Services\Filters\IFilter;
use Illuminate\Database\Eloquent\Builder;

class WhereTransactionAmountBetween extends IFilter
{
    private $from, $to;

    public function __construct($from, $to, $ask_check = null)
    {
        parent::__construct($ask_check ?? ($from and $to));

        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function applyFilter($builder)
    {
        return $builder->whereBetween("transactions.paidAmount", [$this->from, $this->to]);
    }
}