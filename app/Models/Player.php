<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'age', 'points', 'address'];
    protected $table = 'players';
    use HasFactory;
}
