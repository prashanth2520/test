<?php
namespace App\Services\Interfaces;


interface UserServiceInterface
{
    
    public function updateProfile($data);

    public function login($data);

    public function forgotPassword($data);

    public function home(); 

    public function getProfile();

    public function createGroup($data);
}