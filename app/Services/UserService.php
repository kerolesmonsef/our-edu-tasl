<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Filters\QueryFiltersClasses\WhereTransactionAmountBetween;
use App\Services\Filters\QueryFiltersClasses\WhereTransactionCurrency;
use App\Services\Filters\QueryFiltersClasses\WhereTransactionDateBetween;
use App\Services\Filters\QueryFiltersClasses\WhereTransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class UserService
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function filter(Request $request)
    {
        $userQuery = $this
            ->userRepository
            ->UserJoinTransactionQuery()
            ->with("transactions");

        app(Pipeline::class)
            ->send($userQuery)
            ->through([
                new WhereTransactionStatus($request->get("status")),
                new WhereTransactionCurrency($request->get("currency")),
                new WhereTransactionAmountBetween($request->get("from_amount"), $request->get("to_amount")),
                new WhereTransactionDateBetween($request->get("from_date"), $request->get("to_date")),
            ])->thenReturn();

        return $userQuery->get();
    }
}