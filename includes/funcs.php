<?php
    function rerouteNeeded($to, $mssg){
        header("Location: ./".$to."?".$mssg);
        exit();
    }

    function checkPassword($pwd, &$errors)
    {
        $errors_init = $errors;

        if (strlen($pwd) < 8) {
            $errors[] = "Password too short!";
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $errors[] = "Password must include at least one number!";
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $errors[] = "Password must include at least one letter!";
        }

        return ($errors == $errors_init);
    }

    function closeStmtConnReroute($conn, $stmt, $to, $mssg){
        $stmt->close();
        $conn->close();
        rerouteNeeded($to, $mssg);
    }
?>