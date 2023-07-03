<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $table = 'group_members';
    protected $fillable = ['group_id','individual_id'];

    public function individuals()
    {
        return $this->hasOne(Individual::class, 'id', 'individual_id');
    }
    
}
