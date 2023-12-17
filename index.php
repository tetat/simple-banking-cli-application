<?php

require_once __DIR__ . "/Login/Login.php";
require_once __DIR__ . "/Register/Register.php";

require_once __DIR__ . "/View/Users/ViewUsers.php";
require_once __DIR__ . "/View/Transaction/ViewTransaction.php";
require_once __DIR__ . "/View/Money/ViewBalance.php";

require_once __DIR__ . "/Transaction/AddDeposit.php";
require_once __DIR__ . "/Transaction/AddWithdraw.php";
require_once __DIR__ . "/Transaction/AddTransfer.php";

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
    if ($primary_option === 0) break;

    $email = "";
    $role = "";

    if ($primary_option === 1) {
        echo "\nPlease Login.\n\n";
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

    if ($role !== "admin" && $role !== "customer") {
        echo "\n{$role}\n\n";
        continue;
    }

    if ($role === "admin") {
        while (true) {
            echo "\n1 for See All Transactions.\n";
            echo "2 for See Transaction For A User.\n";
            echo "3 for See All Customers.\n";
            echo "0 for back.\n\n";

            $choice = (int) readline("Enter a number: ");

            if ($choice < 0 || $choice > 3) {
                echo "\nInvalid input! Try again please.\n\n";
                continue;
            }
            if ($choice === 0) break;

            if ($choice === 1) { // View all transaction
                $success = (new ViewTransaction())->viewAllTransaction();
            }
            if ($choice === 2) { // view one user's transaction
                echo "\n";
                $customer_email = (string) readline("Enter customer's email: ");
                
                $success = (new ViewTransaction())->viewTransactionByEmail($customer_email);

                if ($success !== "printed.") {
                    echo "\n{$success}\n\n";
                    continue;
                }
            }
            if ($choice === 3) { // view all customers
                (new ViewUsers())->viewAllUser();
            }
        }
    }

    if ($role === "customer") {
        while (true) {
            echo "\n1 for See My Transactions.\n";
            echo "2 for Deposit Money.\n";
            echo "3 for Withdraw Money.\n";
            echo "4 for Transfer Money.\n";
            echo "5 for Current Balance.\n";
            echo "0 for back.\n\n";

            $choice = (int) readline("Enter a number: ");

            if ($choice < 0 || $choice > 5) {
                echo "\nInvalid input! Try again please.\n\n";
                continue;
            }
            if ($choice === 0) break;

            if ($choice === 1) { // My Transactions
                $success = (new ViewTransaction())->viewTransactionByEmail($email);
            }
            if ($choice === 2) { // Deposit Money
                $amount = (float) readline("Enter amount: ");
                if ($amount < 1) {
                    echo "\nInvalid amount! Try again please.\n\n";
                    continue;
                }
                
                $success = (new AddDeposit($email, $amount))->depositSave();

                echo $success . "\n\n";
            }

            if ($choice === 3) { // Withdraw Money
                $amount = (float) readline("Enter amount: ");
                if ($amount < 1) {
                    echo "\nInvalid amount! Try again please.\n\n";
                    continue;
                }
                
                $success = (new AddWithdraw($email, $amount))->withdrawSave();

                echo $success . "\n\n";
            }

            if ($choice === 4) { // Transfer Money
                $reciever_email = (string) readline("Enter reciever email: ");
                $amount = (float) readline("Enter amount: ");
                if ($amount < 1) {
                    echo "\nInvalid amount! Try again please.\n\n";
                    continue;
                }
                
                $success = (new AddTransfer($email, $reciever_email, $amount))->transferSave();

                echo $success . "\n\n";
            }

            if ($choice === 5) { // Current balance
                (new ViewBalance())->viewBalance($email);
            }
        }
    }
}

?>