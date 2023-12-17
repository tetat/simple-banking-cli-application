<?php

require_once "./AllDeposit.php";
require_once "./AllWithdraw.php";
require_once "./AllTransfer.php";

class ViewTransaction {
    public function viewAllTransaction() {
        (new AllDeposit())->viewAllDeposit();
        (new AllWithdraw())->viewAllWithdraw();
        (new AllTransfer())->viewAllTransfer();
    }

    public function viewTransactionByEmail(string $email) {
        (new AllDeposit())->viewDepositByEmail($email);
        (new AllWithdraw())->viewWithdrawByEmail($email);
        (new AllTransfer())->viewTransferByEmail($email);
    }
}

$view = new ViewTransaction();
$view->viewTransactionByEmail("solim@gmail.com");

?>