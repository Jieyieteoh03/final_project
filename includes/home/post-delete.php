<?php

if ( !isUserLoggedIn() ) {
    header("Location: /");
    exit;
}
    // load the database
    $database = connectToDB();

    // get all the $_POST data
    $id = $_POST["id"];

    /* 
        do error check
        - make sure the id is not empty
    */
    if (empty($id)){
        $error = "Error 404";
    }

    // if error found, set error message & redirect back to the manage-users page
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /home");
        exit;
    }

    // if no error found, delete the user
    $sql = "DELETE FROM posts WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'id' => $id
    ]);

    // set success message
    $_SESSION["success"] = "Post has been deleted.";

    // redirect
    header("Location: /home");
    exit;