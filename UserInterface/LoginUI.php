<?php

require_once __DIR__ . "/../Login/Login.php";

class LoginUI {
    public function loginUI() {
        echo "\nPlease Login.\n\n";
        $email = (string) readline("Enter your email: ");
        $password = (string) readline("Enter your password: ");

        $role = (new Login($email, $password))->login();

        return array("email" => $email, "role" => $role);
    }
}

?>