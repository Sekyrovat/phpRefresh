<?php
require_once __DIR__ . '/funcs.php';
if (isset($_POST['submtBtn'])) {
    $uName = $_POST['userN'];
    $uPass = $_POST['pwd'];
    $uPassR = $_POST['pwdR'];
    if (empty($uName) || empty($uPass) || empty($uPassR)) {
        rerouteNeeded("../signup.php", "error=emptyParams");
    } elseif (!preg_match("/^[A-Za-z0-9]*$/", $uName)) {
        rerouteNeeded("../signup.php", "error=invalidUser");
    }

    # Section to check password strength
// --------------------------------------------------------------
    $error = "";
    if (strlen($uPass) < 8) {
        # PLS = Password Length Short
        $error = "error=PLS";
    }
    if (!preg_match("#[0-9]+#", $uPass)) {
        #Password must include at least one number!
        if (strlen($error) !== 0) {
            $error = $error . "&";
        }
        $error = $error . "error=P1N";
    }
    if (!preg_match("#[a-zA-Z]+#", $uPass)) {
        # Password must include at least one letter!
        if (strlen($error) !== 0) {
            $error = $error . "&";
        }
        $error = $error . "error=P1L";
    }
    if (strlen($error) > 0) {
        rerouteNeeded("../signup.php", $error);
    }
// --------------------------------------------------------------

    if ($uPass !== $uPassR) {
        rerouteNeeded("../signup.php", "error=passwordMismatch");
    } else {
        require_once __DIR__ . '/dbh.inc.php';
        $conn = connect();
        if ($conn) {
            $sql = "SELECT * FROM users WHERE uId = ?;";
            $stmt = $conn->prepare($sql);
            if($stmt->bind_param('s', $uName) && $stmt->execute() && $stmt->store_result()) {
                $rows = $stmt->num_rows;
                if($rows > 0){
                    closeStmtConnReroute($conn, $stmt, "../signup.php", "error=UserTaken");
                }else{
                    $stmt -> free_result();
                    $sql = "INSERT INTO users (uId, uPass) VALUES (?, ?);";
                    $stmt = $conn->prepare($sql);
                    $newPass = password_hash($uPass, PASSWORD_DEFAULT);
                    if($stmt->bind_param('ss', $uName, $newPass) && $stmt->execute()){
                        closeStmtConnReroute($conn, $stmt, "../login.php", "status=CorrectSignUp");
                    }else{
                        closeStmtConnReroute($conn, $stmt, "../signup.php", "error=SignUpErr");
                    }
                }
            } else {
                closeStmtConnReroute($conn, $stmt, "../signup.php", "error=Connection2Error");
            }
        }
    }
} else {
    rerouteNeeded("../signup.php", "error=InvalidAccess");
}
