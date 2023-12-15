<?php

require_once "../Model/Users.php";

class Register {
    private string $name;
    private string $email;
    private string $password;
    private string $role;

    private function getInput() {
        $this->name = (string) readline("Enter your name: ");
        $this->email = (string) readline("Enter your email: ");
        $this->password = (string) readline("Enter your password: ");
    }

    private function validEmail() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return false;

        return true;
    }

    public function register(string $role = "customer") {
        $this->role = $role;

        $this->getInput();

        if (!$this->validEmail()) {
            return "Enter valid email.";
        }

        $users = [];
        $user_data = unserialize(file_get_contents("../DB/Users.txt"));

        $exist = false;

        if ($user_data) {
            foreach ($user_data as $user) {
                array_push($users, $user);
                if ($user->email === $this->email) {
                    $exist = true;
                    break;
                }
            }
        }

        if ($exist) return "user already exist.";

        $user = new Users($this->name, $this->email, $this->password, $this->role);
        
        array_push($users, $user);

        file_put_contents("../DB/Users.txt", serialize($users));

        return $this->role;
    }
}

$reg = new Register();
echo $reg->register();

?>