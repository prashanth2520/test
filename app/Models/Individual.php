<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Individual extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'individuals';
    protected $fillable = ['name','email','belongs_to','phone','caption'];
}
