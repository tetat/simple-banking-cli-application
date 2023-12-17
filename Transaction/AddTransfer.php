<?php

require_once "../Model/Users.php";
require_once "../Model/Transfer.php";

class AddTransfer {
    private Transfer $transfer;

    function __construct(string $sender, string $reciever, float $amount) {
        $this->transfer = new Transfer($sender, $reciever, $amount);
    }

    private function balanceUpdate() {
        $user_data = unserialize(file_get_contents("../DB/Users.txt"));
        $users = [];

        $sender_exist = false;
        $reciever_exist = false;
        $sufficient_balance = true;

        if ($user_data) {
            foreach ($user_data as $user) {
                if ($user->email === $this->transfer->sender_email) {
                    if ($user->balance >= $this->transfer->amount) $user->balance -= $this->transfer->amount;
                    else $sufficient_balance = false;
                    $sender_exist = true;
                }
                if ($user->email === $this->transfer->reciever_email) {
                    $user->balance += $this->transfer->amount;
                    $reciever_exist = true;
                }
                array_push($users, $user);
            }
        }

        if (!$sufficient_balance) return "insufficient balance.";

        if ($sender_exist && $reciever_exist) {
            file_put_contents("../DB/Users.txt", serialize($users));
            return "success.";
        }

        return "invalid access.";
    }


    public function transferSave() {
        if ($this-transfer->sender_email === $this->transfer->reciever_email) {
            return "transfer failed: own transfer not allowed.";
        }
        
        $success = $this->balanceUpdate();

        if ($success === "success.") {
            $transfer_data = unserialize(file_get_contents("../DB/AllTransfer.txt"));

            if ($transfer_data) {
                array_push($transfer_data, $this->transfer);
            } else {
                $transfer_data = [$this->transfer];
            }

            file_put_contents("../DB/AllTransfer.txt", serialize($transfer_data));

            return "success.";
        }

        return "transfer failed: {$success}";
    }
}

// $trans = new AddTransfer("solim@gmail.com", "nishat@gmail.com", 23);
// $trans->transferSave();

?>