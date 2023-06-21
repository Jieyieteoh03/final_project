<?php
    if ( !isUserLoggedIn() ) {
        header("Location: /");
        exit;
    }

    $database = connectToDB();

    $title = $_POST['title'];
    $content = $_POST['content'];

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

    if(empty( $title ) || empty( $content )){
        $error = "Please enter all fields";
    }

    if (isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-post-add");
    }else{
        $sql = "INSERT INTO posts (`title`, `content`, `user_id`, `image`)
        VALUES(:title, :content, :user_id, :image)";
        $query = $database->prepare( $sql );
        $query->execute([
            'title' => $title,
            'content' => $content,
            'image' => ( !empty( $image_name ) ? $image_name : null ), // if there is an image, put it to db. If not, set null
            'user_id' => $_SESSION["user"]["id"]
        ]);

        $_SESSION["success"] = "New post added";
        $_SESSION['new_post'] = $title;
        header("Location: /home");
        exit;
    }
?>