<?php
    session_start();

    require "includes/function.php";

    $path = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);

    $path = trim($path, '/');

    switch($path){
        case 'auth/login':
            require "includes/auth/login.php";
            break;
        case 'auth/signup':
            require "includes/auth/signup.php";
            break;
        case 'users/add':
            require "includes/users/add.php";
            break;
        case 'users/edit':
            require "includes/users/edit.php";
            break;
        case 'users/delete':
            require "includes/users/delete.php";
            break;
        case 'users/changepwd':
            require "includes/users/changepwd.php";
            break;
        case 'posts/add':
            require "includes/posts/add.php";
            break;
        case 'posts/edit':
            require "includes/posts/edit.php";
            break;
        case 'posts/delete':
            require "includes/posts/delete.php";
            break;
        case 'comments/add':
            require "includes/comments/add.php";
            break;
        case 'comments/delete':
            require "includes/comments/delete.php";
            break;
        case 'profile/edit':
            require "includes/profile/edit.php";
            break;
        case 'replies/add':
            require "includes/replies/add.php";
            break;
        case 'replies/delete':
            require "includes/replies/delete.php";
            break;
        case 'home/post-delete':
            require "includes/home/post-delete.php";
            break;
        case 'home/comment-delete':
            require "includes/home/comment-delete.php";
            break;
        case 'home/replies-delete':
            require "includes/home/replies-delete.php";
            break;
        case 'dashboard':
            require "pages/dashboard.php";
            break;
        case 'logout':
            require "pages/logout.php";
            break;
        case 'manage-posts':
            require "pages/posts/manage-posts.php";
            break;
        case 'manage-posts-add':
            require "pages/posts/manage-posts-add.php";
            break;
        case 'manage-posts-edit':
            require "pages/posts/manage-posts-edit.php";
            break;
        case 'manage-users':
            require "pages/users/manage-users.php";
            break;
        case 'manage-users-add':
            $_SESSION["title"] = "Add New User";
            require "pages/users/manage-users-add.php";
            break;
        case 'manage-users-changepwd':
            require "pages/users/manage-users-changepwd.php";
            break;
        case 'manage-users-edit':
            require "pages/users/manage-users-edit.php";
            break;
        case 'manage-profile-edit';
            require "pages/profile/manage-profile-edit.php";
            break;
        case 'manage-comments';
            require "pages/comments/manage-comments.php";
            break;
        case 'replies';
            require "pages/replies.php";
            break;
        case 'manage-replies';
            require "pages/replies/manage-replies.php";
            break;
        case 'manage-replies-add';
            require "pages/replies/manage-replies-add.php";
            break;
        case 'profile':
            require "pages/profile.php";
            break;
        case 'login':
            require "pages/login.php";
            break;
        case 'signup':
            require "pages/signup.php";
            break;
        case 'home':
            require "pages/home.php";
            break;
        default:
            require "pages/main-page.php";
            break;
    }
?>