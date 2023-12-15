<?php

require_once "../Model/Users.php";

class Login {
    private string $email;
    private string $password;

    private function getInput() {
        $this->email = (string) readline("Enter your email: ");
        $this->password = (string) readline("Enter your password: ");
    }

    private function validEmail() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return false;

        return true;
    }

    public function login() {
        $this->getInput();
        
        if (!$this->validEmail()) {
            return "Enter valid email.";
        }

        $user_data = unserialize(file_get_contents("../DB/Users.txt"));

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

// $log = new Login();
// echo $log->login();

?>