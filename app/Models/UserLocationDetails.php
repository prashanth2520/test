<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLocationDetails extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'users_location_details';

    protected $fillable = [
        'user_id','individual_user_id', 'location_id'
    ];

}
