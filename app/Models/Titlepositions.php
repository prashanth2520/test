<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titlepositions extends Model
{
    use HasFactory;
    protected $table = 'titlepositions';
    protected $fillable = ['caption','type'];
    
}
