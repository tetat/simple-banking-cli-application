<?php

require_once __DIR__ . "/../../Model/Users.php";

class ViewBalance {
    public function viewBalance(string $email) {
        $users = [];
        $user_data = unserialize(file_get_contents(__DIR__ . "/../../DB/Users.txt"));

        echo "Current Balance\n...............\n";
        if ($user_data) {
            foreach ($user_data as $user) {
                if ($email === $user->email) {
                    echo "Total: {$user->balance}\n";
                }
            }
        }echo "\n";
    }
}


?>