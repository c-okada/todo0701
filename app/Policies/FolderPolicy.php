<?php

namespace App\Policies;

use App\User;
use App\Folder;

class FolderPolicy
{
    public function view(User $user,Folder $folder){
        return $user->id === $folder->user_id;
    }
}
