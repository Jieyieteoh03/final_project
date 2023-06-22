<?php

    // check if the current user is an admin or not
    if ( !isUserLoggedIn() ) {
        // if current user is not an admin, redirect to dashboard
        header("Location: /");
        exit;
    }

    // load the database
    $database = connectToDB();

    // get all the $_POST data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $profile_image = $_POST['profile_image'];

    // catch the image file
    $image = $_FILES['image'];
    // get image file name
    $image_name = $image['name'];

    // add image to the uploads folder
    if ( !empty( $image_name ) ) {
        // target the uploads folder
        $target_dir = "uploads-profile/";
        // add the image name to the uploads folder
        $target_file = $target_dir . basename( $image_name ); // output: uploads/fs.jpg
        // move the file to the uploads folder
        move_uploaded_file( $image["tmp_name"], $target_file );
    }

    /* 
        do error check
        - make sure all the fields are not empty
        - make sure the *new* email entered is not duplicated
    */
    if(empty($name) || empty($email) || empty($id) ){
        $error = "Make sure all the fields are filled.";
    }
    
    // check if email is already taken by calling the database
    $sql = "SELECT * FROM users WHERE email = :email AND id != :id";
    $query = $database->prepare($sql);
    $query->execute([
        'email'=>$email,
        'id' => $_SESSION["user"]["id"]
    ]);
    $user = $query->fetch();
    
    if ( $user ){
        $error = "Please enter different email";
    }

    // if error found, set error message & redirect back to the manage-users-edit page with id in the url
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /manage-profile-edit?id=$id");
        exit;
    }   
    // if no error found, update the user data based whatever in the $_POST data
    $sql = "UPDATE users SET name = :name, email = :email , image = :image WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'name' => $name,
        'email' => $email,
        'id' => $_SESSION["user"]["id"],
        'image' => ( !empty( $image_name ) ? $image_name : ( !empty( $profile_image ) ? $profile_image : null ) ),
    ]);

    // set success message
    $_SESSION["success"] = "User has been edited.";

    // redirect
    header("Location: /profile");
    exit;