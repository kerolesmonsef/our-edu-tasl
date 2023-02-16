<?php /** @noinspection PhpLanguageLevelInspection */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const CREATED_AT = null;


    public function user()
    {
        return $this->belongsTo(User::class, 'parentEmail', 'email');
    }

    public function getStatusName()
    {
        $types = [
            1 => 'authorized',
            2 => 'decline',
            3 => 'refunded'
        ];

        return $types[$this->statusCode] ?? "Unknown";
    }
}
