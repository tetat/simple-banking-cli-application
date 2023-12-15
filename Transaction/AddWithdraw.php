<?php

require_once "../Model/Users.php";
require_once "../Model/Transaction.php";

class AddWithdraw {
    private Transaction $withdraw;

    function __construct(string $email, float $amount) {
        $this->withdraw = new Transaction($email, $amount);
    }
    
    private function balanceUpdate() {
        $user_data = unserialize(file_get_contents("../DB/Users.txt"));
        $users = [];

        $exist = false;
        $sufficient_balance = true;

        if ($user_data) {
            foreach ($user_data as $user) {
                if ($user->email === $this->withdraw->email) {
                    if ($user->balance >= $this->withdraw->amount) $user->balance -= $this->withdraw->amount;
                    else $sufficient_balance = false;
                    $exist = true;
                }
                array_push($users, $user);
            }
        }

        if (!$sufficient_balance) return "insufficient balance.";

        if ($exist) {
            file_put_contents("../DB/Users.txt", serialize($users));
            return "success.";
        }

        return "invalid access.";
    }

    public function withdrawSave() {
        $success = $this->balanceUpdate();

        if ($success === "success.") {
            $withdraw_data = unserialize(file_get_contents("../DB/AllWithdraw.txt"));

            // $withdraw = new Transaction($this->email, $this->amount);

            if ($withdraw_data) {
                array_push($withdraw_data, $this->withdraw);
            } else {
                $withdraw_data = [$this->withdraw];
            }

            file_put_contents("../DB/AllWithdraw.txt", serialize($withdraw_data));

            return "success.";
        }

        return "withdraw failed: {$success}";
    }
}

// $withdraw = new AddWithdraw("nishat@gmail.com", 2);
// echo $withdraw->withdrawSave();

?>