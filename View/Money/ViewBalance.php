<?php

require_once "../../Model/Users.php";

class ViewBalance {
    public function viewBalance(string $email) {
        $users = [];
        $user_data = unserialize(file_get_contents("../../DB/Users.txt"));

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

$view = new viewBalance();
$view->viewBalance("solim@gmail.com");

?>