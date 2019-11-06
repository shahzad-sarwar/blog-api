<?php

namespace App\Observers\User;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\getHttpHost;

class UserObserver
{
     public function creating(User $user)
    {
        if (request()->image !== null) {
            $name = time().'.' . explode('/', explode(':', substr(request()->image, 0, strpos(request()->image, ';')))[1])[1];
            $image = request()->image;
            $key = 'users' . '/' . $name;
            Storage::disk('public')->put($key, file_get_contents($image));
            $user->image = $key;
        }
        $user->password =  Hash::make(request()->password);
    }
}
