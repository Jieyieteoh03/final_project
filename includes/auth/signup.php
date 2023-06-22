<?php

$database=connectToDB();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

$sql = "SELECT * FROM users WHERE email = :email";
$query = $database->prepare($sql);
$query->execute([
    'email' => $email
]);
$user = $query->fetch();

if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
    $error = 'Please enter field';
} else if ($password !== $confirm_password){
    $error = "Password incorrect";
} else if (strlen($password) < 8){
    $error = 'Must be 8 characters';
} else if ($user){
    $error = 'User existed';
} else {
    $sql = "INSERT INTO users (`name`,`email`,`password`) 
    VALUES(:name, :email, :password)";
    $query = $database->prepare($sql);
    $query->execute([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $database->prepare($sql);
    $query->execute([
        'email' => $email
    ]);
    $user = $query->fetch();

    $_SESSION["user"] = $user;



    header("Location: /home");
    exit;
}
if(isset($error)){
    $_SESSION['error'] = $error;
    header("Location:/signup");
    exit;
}
?>