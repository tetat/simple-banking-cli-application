<?php

// require_once "/Model/Users.php";
// require_once "/Common/ValidEmail.php";

require_once __DIR__ . "/Login/Login.php";
require_once __DIR__ . "/Register/Register.php";

require_once __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv as Dotenv;

echo "\nWelcome to Simple Banking.\n";
while (true) {
    echo "\n1 for Login.\n";
    echo "2 for Register.\n";
    echo "0 for Close.\n\n";

    $primary_option = (int) readline("Enter a number: ");

    if ($primary_option < 0 || $primary_option > 2) {
        echo "\nInvalid input! Try again please.\n\n";
        continue;
    }
    if ($primary_option === 0) {
        break;
    }

    $email = "";
    $role = "";

    if ($primary_option === 1) {
        echo "Please Login.\n\n";
        $email = (string) readline("Enter your email: ");
        $password = (string) readline("Enter your password: ");

        $role = (new Login($email, $password))->login();
    } 
    if ($primary_option === 2) { // register
        echo "\n1 for Register as Customer.\n";
        echo "2 for Register as Admin.\n\n";

        $choice = (int) readline("Enter a number: ");

        if ($choice < 1 || $choice > 2) {
            echo "\nInvalid input! Try again please.\n\n";
            continue;
        }

        echo "\n";
        $name = (string) readline("Enter your name: ");
        $email = (string) readline("Enter your email: ");
        $password = (string) readline("Enter your password: ");

        if ($choice === 1) {
            $role = (new Register($name, $email, $password))->register();
        }
        if ($choice === 2) { // register as admin
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            echo "\n";
            $code = (string) readline("Enter admin secret code: ");

            if ($code !== $_ENV["SECRET"]) {
                echo "\nYou are not allowed to create as admin\n\n";
                continue;
            }

            $role = (new Register($name, $email, $password, "admin"))->register();
        }
    }

    echo $role . "\n";
}

?>