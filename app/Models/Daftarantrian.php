<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Daftarantrian extends Model
{
    use HasFactory;

    protected $fillable = ['antrian_id','user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function antrian(): BelongsTo
    {
        return $this->belongsTo(Antrian::class, 'antrian_id');
    }
}
