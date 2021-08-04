<?php
session_start();
include "../../vendor/autoload.php";

use dao\UserDao;
use model\User;

try{
    $userDao = new UserDao();
    $listUsers = $userDao->getuser();
    
    include "../View/show_users.php";
}
catch (PDOException $e){
    echo $e->getMessage();
} 