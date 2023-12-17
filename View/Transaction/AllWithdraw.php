<?php

require_once "../../Model/Transaction.php";

class AllWithdraw {
    public function viewAllWithdraw() {
        $allWithdraw = unserialize(file_get_contents("../../DB/AllWithdraw.txt"));

        echo "All Withdraw\n...........\n";
        foreach ($allWithdraw as $withdraw) {
            echo "Email: {$withdraw->email} | ";
            echo "Amount: {$withdraw->amount} | ";
            echo "Date: {$withdraw->Time}\n";
        }echo "\n";
    }

    public function viewWithdrawByEmail(string $email) {
        $allWithdraw = unserialize(file_get_contents("../../DB/AllWithdraw.txt"));

        echo "All Withdraw\n...........\n";
        foreach ($allWithdraw as $withdraw) {
            if ($email === $withdraw->email) {
                echo "Email: {$withdraw->email} | ";
                echo "Amount: {$withdraw->amount} | ";
                echo "Date: {$withdraw->Time}\n";
            }
        }echo "\n";
    }
}

?>