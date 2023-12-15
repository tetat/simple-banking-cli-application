<?php

class Transactions {
    public float $total_money;
    public array $total_deposit;
    public array $total_withdraw;
    public array $total_transfer;
    public string $user_email;

    function __construct(string $email) {
        $this->user_email = $email;
    }
}

?>