<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveType extends Model
{
    use HasFactory;
    protected $table = 'move_type';
    protected $fillable = ['name'];

}
