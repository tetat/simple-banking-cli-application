<?php

require_once __DIR__ . "/../../Model/Transaction.php";

class AllDeposit {

    public function viewAllDeposit() {
        $allDeposit = unserialize(file_get_contents(__DIR__ . "/../../DB/AllDeposit.txt"));

        echo "\nAll Deposit\n...........\n";
        foreach ($allDeposit as $deposit) {
            echo "Email: {$deposit->email} | ";
            echo "Amount: {$deposit->amount} | ";
            echo "Date: {$deposit->Time}\n";
        }echo "\n";
    }

    public function viewDepositByEmail(string $email) {
        $allDeposit = unserialize(file_get_contents(__DIR__ . "/../../DB/AllDeposit.txt"));

        echo "\nAll Deposit\n...........\n";
        foreach ($allDeposit as $deposit) {
            if ($email === $deposit->email) {
                echo "Email: {$deposit->email} | ";
                echo "Amount: {$deposit->amount} | ";
                echo "Date: {$deposit->Time}\n";
            }
        }echo "\n";
    }
}

?>