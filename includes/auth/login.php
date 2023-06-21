<?php
    $database = connectToDB();

    $email = $_POST["email"];
    $password = $_POST["password"];

    // make sure field not empty
    if( empty($email) || empty($password)){
        $error = "Please enter field";
    } else {
        // retrieve data
        $sql = "SELECT * FROM users WHERE email = :email";
        // prepare
        $query = $database -> prepare($sql);
        // execute
        $query -> execute([
            'email' => $email,
        ]);
        // fetch user from database
        $user = $query->fetch();
    }

    // Make sure user exist
    if(empty($user)){
        $error = "User doesn't exist";
    }else{
        if (password_verify($password, $user["password"])){
            $_SESSION["user"] = $user;

            header("Location: /home");
            exit;

        } else {
            $error = "Password not match";
        }
    }

    if(isset($error)){
        $_SESSION['error'] = $error;
        
        header("Location: /login");
        exit;
    }
