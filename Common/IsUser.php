<?php

require_once __DIR__ . "/../Model/Users.php";

trait IsUser {
    public function isUser(string $email) {
        $user_data = unserialize(file_get_contents(__DIR__ . "/../DB/Users.txt"));

        if ($user_data) {
            foreach ($user_data as $user) {
                if ($email === $user->email) return true;
            }
        }

        return false;
    }
}

?>