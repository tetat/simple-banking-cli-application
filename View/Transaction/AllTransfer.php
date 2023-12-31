<?php

require_once __DIR__ . "/../../Model/Transfer.php";

class AllTransfer {
    public function viewAllTransfer() {
        $allTransfer = unserialize(file_get_contents(__DIR__ . "/../../DB/AllTransfer.txt"));

        echo "\nAll Transfer\n...........\n";
        if ($allTransfer) {
            foreach ($allTransfer as $transfer) {
                echo "Sender: {$transfer->sender_email} | ";
                echo "Reciever: {$transfer->reciever_email} | ";
                echo "Amount: {$transfer->amount} | ";
                echo "Date: {$transfer->Time}\n";
            }
        }echo "\n";
    }

    public function viewTransferByEmail(string $email) {
        $allTransfer = unserialize(file_get_contents(__DIR__ . "/../../DB/AllTransfer.txt"));

        echo "\nAll Transfer\n...........\n";
        if ($allTransfer) {
            foreach ($allTransfer as $transfer) {
                if ($email === $transfer->sender_email || $email === $transfer->reciever_email) {
                    echo "Sender: {$transfer->sender_email} | ";
                    echo "Reciever: {$transfer->reciever_email} | ";
                    echo "Amount: {$transfer->amount} | ";
                    echo "Date: {$transfer->Time}\n";
                }
            }
        }echo "\n";
    }
}

?>