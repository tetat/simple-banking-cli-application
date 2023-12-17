<?php

require_once "../Model/Users.php";
require_once "../Model/Transaction.php";

class AddDeposit {
    private Transaction $deposit;

    function __construct(string $email, float $amount) {
        $this->deposit = new Transaction($email, $amount);
    }
    
    private function balanceUpdate() {
        $user_data = unserialize(file_get_contents("../DB/Users.txt"));
        $users = [];

        $exist = false;

        if ($user_data) {
            foreach ($user_data as $user) {
                if ($user->email === $this->deposit->email) {
                    $user->balance += $this->deposit->amount;
                    $exist = true;
                }
                array_push($users, $user);
            }
        }

        if ($exist) {
            file_put_contents("../DB/Users.txt", serialize($users));
            return "success.";
        }

        return "invalid access.";
    }

    public function depositSave() {
        $success = $this->balanceUpdate();

        if ($success === "success.") {
            $deposit_data = unserialize(file_get_contents("../DB/AllDeposit.txt"));

            if ($deposit_data) {
                array_push($deposit_data, $this->deposit);
            } else {
                $deposit_data = [$this->deposit];
            }

            file_put_contents("../DB/AllDeposit.txt", serialize($deposit_data));

            return "success.";
        }

        return "deposit failed: {$success}";
    }
}

// $depo = new AddDeposit("solim@gmail.com", 205.5);
// echo $depo->depositSave();

?>