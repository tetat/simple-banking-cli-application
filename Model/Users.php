<?php

class Users {
    public string $name;
    public string $email;
    public string $password;
    public string $role;

    function __construct(string $name, string $email, string $password, string $role = "customer") {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
}

?>