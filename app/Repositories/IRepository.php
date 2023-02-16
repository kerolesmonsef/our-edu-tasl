<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IRepository
{
    public function create(array $data): Model;
}