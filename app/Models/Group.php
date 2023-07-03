<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'group';
    protected $fillable = ['created_by','group_name','individual_user_id'];


    public function groupMembers()
    {
        return $this->hasMany(GroupMember::class, 'group_id', 'id');
    }
    
}
