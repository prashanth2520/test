<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\UserRepository;

class UserService implements UserServiceInterface
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function updateProfile($data){

        return $this->user->updateProfile($data);
    }

    public function login($data){

        return $this->user->login($data);
    }

    public function forgotPassword($data){

        return $this->user->forgotPassword($data);
    }

    public function changePassword($data){

        return $this->user->changePassword($data);
    }

    public function home(){
        
        return $this->user->home();
    }

    public function getProfile(){

        return $this->user->getProfile();
    }

    public function createGroup($data){

        return $this->user->createGroup($data);
    }
}
