<?php

require_once "./AllDeposit.php";
require_once "./AllWithdraw.php";
require_once "./AllTransfer.php";

class ViewTransaction {
    private string $email;

    function __construct(string $email) {
        $this->email = $email;
    }

    public function viewAllTransaction() {
        (new AllDeposit())->viewAllDeposit();
        (new AllWithdraw())->viewAllWithdraw();
        (new AllTransfer())->viewAllTransfer();
    }
}

$view = new ViewTransaction("nishat@gmail.com");
$view->viewAllTransaction();

?>