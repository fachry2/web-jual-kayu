<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'nama'      => $user->name,
            'username'  => $user->username,
            'email'     => $user->email,
            'roles'     => $user->roles_id,
            'reistered' => $user->created_at->diffForHumans(),
            'updated' => $user->updated_at->diffForHumans(),
        ];
    }
}