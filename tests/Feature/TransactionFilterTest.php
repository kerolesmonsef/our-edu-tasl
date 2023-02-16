<?php /** @noinspection PhpHierarchyChecksInspection */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;
use Tests\TestCase;

class TransactionFilterTest extends TestCase
{
    public function test_if_api_is_working()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);

        assert(sizeof($response->json()['users']) > 0);
    }

    public function test_filter_status_code_validation_error()
    {
        $response = $this->get('/api/users?status=44',[
            "accept"=>"application/json"
        ]);

        $response->assertStatus(422);
    }

    public function test_filter_by_status_code()
    {
        $response = $this->get('/api/users?status=decline',[
            "accept"=>"application/json"
        ]);

        $response->assertStatus(200);

        $users = $response->json()['users'];

        if (sizeof($users) == 0){
            return;
        }

        $transactions = collect($users[0]['transactions']);

        foreach ($transactions as $transaction){
            if ($transaction['statusCode'] == "decline"){
                return;
            }
        }

        assertFalse(true);
    }
}
