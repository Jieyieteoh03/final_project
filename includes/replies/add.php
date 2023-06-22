<?php

    if ( !isUserLoggedIn() ) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    $replies = $_POST['replies'];
    $comment_id = $_POST['comment_id'];
    $post_id = $_POST['post_id'];

    // do error checking
    if ( empty( $replies) || empty( $comment_id ) || empty( $post_id) ) {
        $error = "Please enter reply";
    }
    
    // insert the comment into database
    if( isset ($error)){
        $_SESSION['error'] = $error;
        header("Location: /replies?id=$comment_id" ); 
        exit;

    }else{
        $sql = "INSERT INTO replies (`reply`,`comment_id`, `post_id`, `user_id`)
        VALUES(:reply, :comment_id, :post_id, :user_id)";
        $query = $database->prepare( $sql );
        $query->execute([
            'reply' => $replies,
            'comment_id' => $comment_id,
            'post_id' => $post_id,
            'user_id' => $_SESSION['user']['id']
        ]);
    }

        $_SESSION["success"] = "Reply has been added";

        
        header("Location: /replies?id=$comment_id" );
        exit;
?>