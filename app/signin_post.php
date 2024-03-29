<?php
require_once("../lib/functions.php");
require_once("../lib/AccountDAO.php");

$csrf_token =  filter_input(INPUT_POST,"csrf_token");

if(validate_csrf_token($csrf_token === false))
{
    echo "naiyo";
    exit();
}

$name = filter_input(INPUT_POST,"name");
if($name === "")
{
    set_message(MESSAGE_SIGNIN_ERROR);
    header("Location:signin.php");
    exit();
}
elseif(mb_strlen($name) > 20)
{
    set_message(MESSAGE_SIGNIN_ERROR);
    header("Location:signin.php");
    exit();
}

$password = filter_input(INPUT_POST,"password");
if($password === "")
{
    set_message(MESSAGE_SIGNIN_ERROR);
    header("Location:signin.php");
    exit();
}
elseif(mb_strlen($password) > 20)
{
    set_message(MESSAGE_SIGNIN_ERROR);
    header("Location:signin.php");
    exit();
}

try{
    $pdo = new_PDO();

    $account_dao = new AccountDAO($pdo);
    $account = $account_dao->selectbyName($name);
    if($account === false){
        set_message(MESSAGE_SIGNIN_ERROR);
        header("location:signin.php");
        exit();
    }
    if(password_verify($password,$account["hashed_password"]) ===false ){
        set_message(MESSAGE_SIGNIN_ERROR);
        header("location:signin.php");
        exit();

    }
#ここから先を理解するがまずは講座を終えてからがいい
    sign_in($account);
    set_message(MESSAGE_SIGNIN_SUCCESS);

    header("location:index.php");

}catch(PDOException $e){
    echo $e->getMessage();
    header("location:error.php");

}


?>