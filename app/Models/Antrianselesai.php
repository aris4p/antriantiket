<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrianselesai extends Model
{
    use HasFactory;

    protected $fillable = ['antrian_id','status'];
}
