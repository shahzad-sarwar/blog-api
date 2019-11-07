<?php

namespace App\Observers\User;

use App\Handler\Images\StoreOrUpload;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\getHttpHost;

class UserObserver
{
    protected $dir = 'users';

    public function __construct(StoreOrUpload $imageHandler)
    {
        $this->imageHandler = $imageHandler;
    }

     public function creating(User $user)
    {
        if (request()->image !== null) {
            $this->imageHandler->addOrUpdate($user, $this->dir);
        }
        $user->password =  Hash::make(request()->password);
    }
}
