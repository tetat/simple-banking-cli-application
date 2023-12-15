<?php

class Users {
    public string $name;
    public string $email;
    public string $password;
    public string $role;
    public float $balance;

    function __construct(string $name, string $email, string $password, string $role = "customer") {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->balance = 0;
    }
}

?>