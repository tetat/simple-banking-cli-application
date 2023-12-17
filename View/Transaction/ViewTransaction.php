<?php

require_once __DIR__ . "/AllDeposit.php";
require_once __DIR__ . "/AllWithdraw.php";
require_once __DIR__ . "/AllTransfer.php";

require_once __DIR__ . "/../../Common/IsUser.php";

class ViewTransaction {
    use IsUser;

    public function viewAllTransaction() {
        (new AllDeposit())->viewAllDeposit();
        (new AllWithdraw())->viewAllWithdraw();
        (new AllTransfer())->viewAllTransfer();

        return "printed.";
    }

    public function viewTransactionByEmail(string $email) {
        if (!$this->isUser($email)) return "User doesn't exist!";

        (new AllDeposit())->viewDepositByEmail($email);
        (new AllWithdraw())->viewWithdrawByEmail($email);
        (new AllTransfer())->viewTransferByEmail($email);

        return "printed.";
    }
}


?>