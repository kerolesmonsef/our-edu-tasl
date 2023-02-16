<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function PHPUnit\TextUI\CliArguments\hasDefaultTimeLimit;

/**
 * Class TransactionResource
 * @package App\Http\Resources
 * @mixin Transaction
 */
class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'paidAmount' => $this->paidAmount,
            'currency' => $this->currency,
            'parentEmail' => $this->parentEmail,
            'statusCode' => $this->getStatusName(),
            'paymentDate' => $this->paymentDate,
            'parentIdentification' => $this->parentIdentification,
        ];
    }
}
