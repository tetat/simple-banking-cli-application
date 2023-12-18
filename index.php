<?php

use UserInterface\LoginUI;
use UserInterface\RegisterUI;
use UserInterface\AdminUI;
use UserInterface\CustomerUI;

// require_once __DIR__ . "/UserInterface/LoginUI.php";
// require_once __DIR__ . "/UserInterface/RegisterUI.php";
// require_once __DIR__ . "/UserInterface/AdminUI.php";
// require_once __DIR__ . "/UserInterface/CustomerUI.php";

require_once __DIR__ . "/vendor/autoload.php";


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
    if ($primary_option === 0) break;

    $email = "";
    $role = "";

    if ($primary_option === 1) {
        $user = (new LoginUI())->loginUI();
        
        $email = $user["email"];
        $role = $user["role"];
    } 
    if ($primary_option === 2) { // register
        $user = (new RegisterUI())->registerUI();

        $email = $user["email"];
        $role = $user["role"];
    }

    if ($role !== "admin" && $role !== "customer") {
        echo "\n{$role}\n\n";
        continue;
    }

    if ($role === "admin") {
        (new AdminUI())->adminUI();
    }

    if ($role === "customer") {
        (new CustomerUI())->customerUI($email);
    }
}

?>