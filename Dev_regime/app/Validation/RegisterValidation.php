<?php

namespace App\Validation;

class RegisterValidation
{
    public static function validate($data)
    {
        $errors = [];

        if (strlen($data['username']) < 3) {
            $errors['username'] = "Nom trop court.";
        }

        if (
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $errors['email'] = "Email invalide.";
        }

        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";

        if (
            !preg_match(
                $regex,
                $data['password']
            )
        ) {
            $errors['password'] = "Mot de passe faible.";
        }

        return $errors;
    }
}
