<?php

// namespace UserInterface;

require_once __DIR__ . "/../View/Users/ViewUsers.php";
require_once __DIR__ . "/../View/Transaction/ViewTransaction.php";

class AdminUI {
    public function adminUI() {
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
}

?>