<?php

require_once "../Model/Users.php";
require_once "../Model/Transaction.php";

class AddWithdraw {
    function __construct(string $email, float $amount) {
        $this->email = $email;
        $this->amount = $amount;
        $this->Time = date("d/m/Y h:i:s");
    }
    
    private function balanceUpdate() {
        $user_data = unserialize(file_get_contents("../DB/Users.txt"));
        $users = [];

        $exist = false;
        $sufficient_balance = true;

        if ($user_data) {
            foreach ($user_data as $user) {
                if ($user->email === $this->email) {
                    if ($user->balance >= $this->amount) $user->balance -= $this->amount;
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

            $withdraw = new Transaction($this->email, $this->amount);

            if ($withdraw_data) {
                array_push($withdraw_data, $withdraw);
            } else {
                $withdraw_data = [$withdraw];
            }

            file_put_contents("../DB/AllWithdraw.txt", serialize($withdraw_data));

            return "success.";
        }

        return "withdraw failed: {$success}";
    }
}

// $withdraw = new AddWithdraw("nishat@gmail.com", 100);
// echo $withdraw->withdrawSave();

?>