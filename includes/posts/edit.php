<?php
     
    if ( !isUserLoggedIn() ) {
        header("Location: /");
        exit;
    }

    // load the database
    $database = connectToDB();

    // get all the $_POST data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['id'];
    $original_image = $_POST['original_image'];

    // catch the image file
    $image = $_FILES['image'];
    // get image file name
    $image_name = $image['name'];

    // add image to the uploads folder
    if ( !empty( $image_name ) ) {
        // target the uploads folder
        $target_dir = "uploads/";
        // add the image name to the uploads folder
        $target_file = $target_dir . basename( $image_name ); // output: uploads/fs.jpg
        // move the file to the uploads folder
        move_uploaded_file( $image["tmp_name"], $target_file );
    }

    /* 
        do error check
        - make sure all the fields are not empty
    */
    if(empty($title) || empty($content)){
        $error = "All fields is required";
    }

    // if error found, set error message & redirect back to the manage-posts-edit page with id in the url
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header("Location: /manage-posts-edit?id=$id");
        exit;
    }   
    // if no error found, update the user data based whatever in the $_POST data
    $sql = "UPDATE posts SET title = :title, content = :content, image = :image WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'title' => $title,
        'content' => $content,
        'image' => ( !empty( $image_name ) ? $image_name : ( !empty( $original_image ) ? $original_image : null ) ),
        'id' => $_POST['id']

    ]);

    // set success message
    $_SESSION["success"] = "Post edited";

    // redirect
    header("Location: /home");
    exit;