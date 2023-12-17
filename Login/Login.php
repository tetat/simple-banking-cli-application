<?php

require_once __DIR__ . "/../Model/Users.php";
require_once __DIR__ . "/../Common/ValidEmail.php";

class Login {
    use ValidEmail; // use traits to get common methods

    private string $email;
    private string $password;

    function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function login() {
        
        if (!$this->validEmail($this->email)) return "Enter valid email.";

        $user_data = unserialize(file_get_contents(__DIR__ . "/../DB/Users.txt"));

        if ($user_data) {
            foreach ($user_data as $user) {
                if ($user->email === $this->email) {
                    if ($user->password === $this->password) return $user->role;
                }
            }
        }

        return "login has failed.";
    }
}


?>