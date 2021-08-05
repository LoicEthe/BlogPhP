<?php

use dao\UserDao;

require "../../vendor/autoload.php";
include "../Dao/UserDao.php";

session_start();
$id_user = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if($id_user !== false){
    try{
        $deluser = new UserDao();
        $user = $deluser->deleteUser($id_user);
        header("location:show_users_controller.php");
        include "../View/show_users.php";
    } 
        catch(PDOException $e){
        echo $e->getMessage();
    }
    
}