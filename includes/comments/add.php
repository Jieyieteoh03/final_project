<?php

    if ( !isUserLoggedIn() ) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    $comments = $_POST['comments'];
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    // do error checking
    if ( empty( $comments ) || empty( $post_id ) || empty( $user_id ) ) {
        $error = "Please fill out the comment";
    }
    
    // insert the comment into database
    if( isset ($error)){
        $_SESSION['error'] = $error;
        header("Location: /home?id=$post_id" ); 
        exit;
    }else{
        $sql = "INSERT INTO comments (`comments`, `post_id`, `user_id`)
        VALUES(:comments, :post_id, :user_id)";
        $query = $database->prepare( $sql );
        $query->execute([
            'comments' => $comments,
            'post_id' => $post_id,
            'user_id' => $user_id
        ]);
    }

    $_SESSION["success"] = "New comment added";
        
    header("Location: /home?id=$post_id" );
    exit;
?>