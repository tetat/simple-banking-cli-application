<?php

class Transaction {
    public string $email;
    public string $amount;
    public string $Time;

    function __construct(string $email, float $amount) {
        $this->email = $email;
        $this->amount = $amount;
        $this->Time = date("d/m/Y h:i:s");
    }
}

?>