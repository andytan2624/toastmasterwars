<?php

namespace App\Custom\Transformers;

class UserTransformer extends Transformer {

    public function transform($user) {
        return [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'date_joined' => $user['date_joined'],
            'is_admin' => (boolean) $user['is_super_admin'],
        ];
    }
}