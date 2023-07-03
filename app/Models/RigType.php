<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RigType extends Model
{
    use HasFactory;
    protected $table = 'rig_type';
    protected $fillable = ['name'];
}
