<?php

namespace App\Validation;

class LoginValidation
{
    public static function validate($data)
    {
        $errors = [];

        if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email invalide.';
        }

        if (empty($data['password']) || strlen($data['password']) < 6) {
            $errors['password'] = 'Mot de passe invalide.';
        }

        return $errors;
    }
}
