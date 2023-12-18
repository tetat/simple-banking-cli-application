<?php

require_once __DIR__ . "/../View/Transaction/ViewTransaction.php";
require_once __DIR__ . "/../View/Money/ViewBalance.php";

require_once __DIR__ . "/../Transaction/AddDeposit.php";
require_once __DIR__ . "/../Transaction/AddWithdraw.php";
require_once __DIR__ . "/../Transaction/AddTransfer.php";

class CustomerUI {
    public function customerUI($email) {
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