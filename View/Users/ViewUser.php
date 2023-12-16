<?php

require_once "../../Model/Users.php";

class ViewUser {
    public function viewAllUser() {
        $users = [];
        $user_data = unserialize(file_get_contents("../../DB/Users.txt"));

        echo "All Users\n.........\n";
        if ($user_data) {
            foreach ($user_data as $user) {
                echo "Name: {$user->name}\n";
                echo "Email: {$user->email}\n";
                echo "Role: {$user->role}\n\n";
            }//echo "\n";
        }echo "\n";
    }
}

$view = new ViewUser();
$view->viewAllUser();

?>