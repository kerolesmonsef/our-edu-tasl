<?php


namespace App\Repositories;


use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionRepository implements IRepository
{
    public function create(array $data): Model
    {
        // TODO: we can change this
        return Transaction::create($data);
    }
}