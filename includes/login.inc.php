<?php

require_once './funcs.php';

if (isset($_POST['loginBtn'])) {
    $uName = $_POST['userN'];
    $uPass = $_POST['pwd'];
    
    if(empty($uName) || empty($uPass)){
        rerouteNeeded("../login.php", "error=emptyParams");
    }else{
        require "./dbh.inc.php";
        $sql = "SELECT * FROM Users WHERE uId = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            rerouteNeeded("../signup.php", "error=ConnectionError");
        }else{
            mysqli_bind_param($stmt, 's', $uName);
            mysqli_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($res)){
                $pwdCheck = password_verify($uPass, $row['uPass']);
                if($pwdCheck === true){
                    session_start();
                    $_SESSION['id'] = $row['id'];
                }else{
                    rerouteNeeded("../login.php", "error=invalidCombination");
                }
            }else{
                rerouteNeeded("../login.php", "error=FetchError");
            }
        }
    }
}else {
    rerouteNeeded("../login.php", "error=InvalidAccess");
}