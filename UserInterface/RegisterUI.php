<?php

namespace UserInterface;

require_once __DIR__ . "/../Register/Register.php";

use Dotenv\Dotenv as Dotenv;

class RegisterUI {
    public function registerUI() {
        echo "\n1 for Register as Customer.\n";
        echo "2 for Register as Admin.\n\n";

        $choice = (int) readline("Enter a number: ");

        if ($choice < 1 || $choice > 2) {
            echo "\nInvalid input! Try again please.\n\n";
            return array("email" => "", "role" => "");
        }

        echo "\n";
        $name = (string) readline("Enter your name: ");
        $email = (string) readline("Enter your email: ");
        $password = (string) readline("Enter your password: ");

        if ($choice === 1) {
            $role = (new Register($name, $email, $password))->register();

            return array("email" => $email, "role" => $role);
        }
        if ($choice === 2) { // register as admin
            $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
            $dotenv->load();

            echo "\n";
            $code = (string) readline("Enter admin secret code: ");

            if ($code !== $_ENV["SECRET"]) {
                echo "\nYou are not allowed to create as admin\n\n";
                return array("email" => "", "role" => "");
            }

            $role = (new Register($name, $email, $password, "admin"))->register();

            return array("email" => $email, "role" => $role);
        }

        return array("email" => "", "role" => "");
    }
}

?>