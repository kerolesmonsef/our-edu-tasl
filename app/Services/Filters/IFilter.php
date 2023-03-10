<?php


namespace App\Services\Filters;


use Illuminate\Database\Eloquent\Builder;

abstract class IFilter
{
    protected $ask_check;

    public function __construct($ask_check)
    {
        $this->ask_check = $ask_check;
    }

    public final function handle($request, $next)
    {
        if ($this->ask_check === null or $this->ask_check === false) {
            return $next($request);
        }

        $builder = $this->applyFilter($request);

        return $next($builder);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public abstract function applyFilter($builder);
}
