<?php

if ( !isUserLoggedIn() ) {
    header("Location: /");
    exit;
}
    // load the database
    $database = connectToDB();

    // get all the $_POST data
    $id = $_POST["id"];
    $comment_id = $_POST["comment_id"];

    /* 
        do error check
        - make sure the id is not empty
    */
    if (empty($id) || empty($comment_id)){
        $error = "Error 404";
    }

    // if error found, set error message & redirect to reply page
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /replies");
        exit;
    }

    // if no error found, delete the user
    $sql = "DELETE FROM replies WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'id' => $id,
        
    ]);

    // set success message
    $_SESSION["success"] = "Reply has been deleted.";

    

    // redirect
    header("Location: /replies?id=$comment_id");
    exit;