<?php
namespace App\Services\Interfaces;

interface GroupServiceInterface
{
    public function saveGroup(array $request);
    public function getGroupByUser(int $user_id);
    public function deleteGroup(int $group_id);
    public function updateGroup(array $group);
    public function removeMember(int $member_id);
    public function individualsList();
    public function groupsList();

}

?>