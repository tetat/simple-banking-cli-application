<?php

class Transfer {
    public string $sender_email;
    public string $reciever_email;
    public float $amount;
    public string $Time;

    function __construct(string $sender, string $reciever, float $amount) {
        $this->sender_email = $sender;
        $this->reciever_email = $reciever;
        $this->amount = $amount;
        $this->Time = date("d/m/Y h:i:s");
    }
}

?>