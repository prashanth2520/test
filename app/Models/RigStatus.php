<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RigStatus extends Model
{
    use HasFactory;
    protected $table = 'rig_status';
    protected $fillable = ['name'];
}
