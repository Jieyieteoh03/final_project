<?php

    require "parts/header.php";    

?>

<?php

?>
    <div class="container my-5 mx-auto" style="max-width: 500px;">
        <div class="card p-4">
            <h1 class="text-center pb-5">Sign up</h1>
            <?php require "parts/message_error.php"?>
                <form method="POST" action="auth/signup">
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input 
                            type="name" 
                            class="form-control" 
                            id="name" 
                            name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="email" 
                            name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="password" 
                            name="password"> 
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm password</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="confirm_password" 
                            name="confirm_password">
                    </div>
                    <div class="pt-4 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form> 
               
        </div>
    </div>
<?php
    require "parts/footer.php"
?>