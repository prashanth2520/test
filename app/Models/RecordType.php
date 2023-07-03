<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    use HasFactory;
    protected $table = 'record_type';
    protected $fillable = ['record_type'];
}
