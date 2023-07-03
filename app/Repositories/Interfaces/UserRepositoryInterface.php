<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function updateProfile($data);

    public function login($data);

    public function forgotPassword($data);

    public function changePassword($data);

    public function home();
    
    public function getProfile();

    public function createGroup($data);
}