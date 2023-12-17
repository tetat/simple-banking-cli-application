<?php

require_once __DIR__ . "/../Model/Users.php";
require_once __DIR__ . "/../Model/Transfer.php";

require_once __DIR__ . "/../Common/ValidEmail.php";

class AddTransfer {
    use ValidEmail;

    private Transfer $transfer;

    function __construct(string $sender, string $reciever, float $amount) {
        $this->transfer = new Transfer($sender, $reciever, $amount);
    }

    private function balanceUpdate() {
        $user_data = unserialize(file_get_contents(__DIR__ . "/../DB/Users.txt"));
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
            file_put_contents(__DIR__ . "/../DB/Users.txt", serialize($users));
            return "success.";
        }

        return "invalid access.";
    }


    public function transferSave() {
        if (!$this->validEmail($this->transfer->reciever_email)) return "Enter valid email.";

        if ($this->transfer->sender_email === $this->transfer->reciever_email) {
            return "transfer failed: own transfer not allowed.";
        }
        
        $success = $this->balanceUpdate();

        if ($success === "success.") {
            $transfer_data = unserialize(file_get_contents(__DIR__ . "/../DB/AllTransfer.txt"));

            if ($transfer_data) {
                array_push($transfer_data, $this->transfer);
            } else {
                $transfer_data = [$this->transfer];
            }

            file_put_contents(__DIR__ . "/../DB/AllTransfer.txt", serialize($transfer_data));

            return "success.";
        }

        return "transfer failed: {$success}";
    }
}


?>