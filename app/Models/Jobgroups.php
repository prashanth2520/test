<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobgroups extends Model
{
    use HasFactory;
    protected $table = 'jobgroups';
    protected $fillable = ['caption'];
}
