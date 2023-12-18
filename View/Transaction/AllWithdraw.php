<?php

require_once __DIR__ . "/../../Model/Transaction.php";

class AllWithdraw {
    public function viewAllWithdraw() {
        $allWithdraw = unserialize(file_get_contents(__DIR__ . "/../../DB/AllWithdraw.txt"));

        echo "\nAll Withdraw\n...........\n";
        if ($allWithdraw) {
            foreach ($allWithdraw as $withdraw) {
                echo "Email: {$withdraw->email} | ";
                echo "Amount: {$withdraw->amount} | ";
                echo "Date: {$withdraw->Time}\n";
            }
        }echo "\n";
    }

    public function viewWithdrawByEmail(string $email) {
        $allWithdraw = unserialize(file_get_contents(__DIR__ . "/../../DB/AllWithdraw.txt"));

        echo "\nAll Withdraw\n...........\n";
        if ($allWithdraw) {
            foreach ($allWithdraw as $withdraw) {
                if ($email === $withdraw->email) {
                    echo "Email: {$withdraw->email} | ";
                    echo "Amount: {$withdraw->amount} | ";
                    echo "Date: {$withdraw->Time}\n";
                }
            }
        }echo "\n";
    }
}

?>