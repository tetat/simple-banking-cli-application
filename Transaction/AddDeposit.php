<?php

require_once "../Model/Users.php";
require_once "../Model/Transaction.php";

class AddDeposit {
    function __construct(string $email, float $amount) {
        $this->email = $email;
        $this->amount = $amount;
        $this->Time = date("d/m/Y h:i:s");
    }
    
    private function balanceUpdate() {
        $user_data = unserialize(file_get_contents("../DB/Users.txt"));
        $users = [];

        $exist = false;

        if ($user_data) {
            foreach ($user_data as $user) {
                if ($user->email === $this->email) {
                    $user->balance += $this->amount;
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

            $deposit = new Transaction($this->email, $this->amount);

            if ($deposit_data) {
                array_push($deposit_data, $deposit);
            } else {
                $deposit_data = [$deposit];
            }

            file_put_contents("../DB/AllDeposit.txt", serialize($deposit_data));

            return "success.";
        }

        return "deposit failed: {$success}";
    }
}

// $depo = new AddDeposit("nishat@gmail.com", 25.5);
// echo $depo->depositSave();

?>