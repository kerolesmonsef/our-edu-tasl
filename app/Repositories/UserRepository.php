<?php


namespace App\Repositories;


use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class UserRepository implements IRepository
{


    public function create(array $data): User
    {
        $data['created_at'] = Carbon::createFromFormat("d/m/Y", $data['created_at']);
        return User::updateOrCreate([
            'email' => $data['email']
        ], $data);
    }

    public function UserJoinTransactionQuery()
    {
        return User::query()
            ->select("users.*")
            ->join("transactions","transactions.parentEmail","users.email")
            ->groupBy("users.id");
    }
}