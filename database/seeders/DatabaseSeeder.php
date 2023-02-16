<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use JsonMachine\Items;
use JsonMachine\JsonDecoder\ExtJsonDecoder;

class DatabaseSeeder extends Seeder
{
    private $userRepository , $transactionRepository;

    public function __construct(UserRepository $userRepository,TransactionRepository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->importUsers();

        $this->importTransactions();
    }

    public function importUsers()
    {
        $usersJson = Items::fromFile(public_path("users.json"), ['pointer' => ['/users'], 'decoder' => new ExtJsonDecoder(true)]);

        foreach ($usersJson as $value) {
            unset($value['id']);
            $this->userRepository->create($value);
        }
    }

    private function importTransactions()
    {
        $usersJson = Items::fromFile(public_path("transactions.json"), ['pointer' => ['/transactions'], 'decoder' => new ExtJsonDecoder(true)]);

        foreach ($usersJson as $value) {


            $this->transactionRepository->create($value);
        }
    }
}
