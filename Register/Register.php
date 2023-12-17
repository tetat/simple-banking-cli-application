<?php

require_once __DIR__ . "/../Model/Users.php";
require_once __DIR__ . "/../Common/ValidEmail.php";

class Register {
    // use traits to get common methods
    use ValidEmail;

    private string $name;
    private string $email;
    private string $password;
    private string $role;

    function __construct(string $name, string $email, string $password, string $role = "customer") {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function register() {
        if (!$this->validEmail($this->email)) return "Enter valid email.";

        $users = [];
        $user_data = unserialize(file_get_contents(__DIR__ . "/../DB/Users.txt"));

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

        file_put_contents(__DIR__ . "/../DB/Users.txt", serialize($users));

        return $this->role;
    }
}

// $reg = new Register();
// echo $reg->register();

?>