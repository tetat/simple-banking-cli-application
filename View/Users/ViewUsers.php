<?php

require_once __DIR__ . "/../../Model/Users.php";

class ViewUsers {
    public function viewAllUser() {
        $users = [];
        $user_data = unserialize(file_get_contents(__DIR__ . "/../../DB/Users.txt"));

        echo "\nAll Users\n.........\n";
        if ($user_data) {
            foreach ($user_data as $user) {
                if ($user->role === "admin") continue;
                echo "Name: {$user->name}\n";
                echo "Email: {$user->email}\n";
                echo "Role: {$user->role}\n\n";
            }
        }echo "\n";
    }
}

// $view = new ViewUsers();
// $view->viewAllUser();

?>