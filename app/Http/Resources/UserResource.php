<?php /** @noinspection PhpLanguageLevelInspection */

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = [
            'id' => $this->id,
            'balance' => $this->balance,
            'currency' => $this->currency,
            'email' => $this->email,
            'created_at' => $this->created_at,
        ];

        if ($this->relationLoaded("transactions")) {
            $user['transactions'] = TransactionResource::collection($this->transactions);
        }

        return $user;
    }
}
