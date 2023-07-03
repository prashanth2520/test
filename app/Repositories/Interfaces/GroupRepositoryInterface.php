<?php
namespace App\Repositories\Interfaces;

interface GroupRepositoryInterface
{

    
    public function hasGroup(int $group_id);
    public function hasMember(int $group_id, int $indi_id);
    public function getGroupByUser(int $user_id);
    public function viewGroup(int $group_id);
    public function getGroupMembersByGrp(int $group_id);
    public function updateGroup(int $group_id, array $group_array);
    public function deleteGroup(int $group_id);
    public function removeMember(int $member_id);
    public function individualsList();
    public function groupsList();
    public function updateGroupMembers(int $group_id, array $individuals);
}



?>