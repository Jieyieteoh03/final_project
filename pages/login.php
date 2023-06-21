<?php

    require "parts/header.php";

?>
<div class="container my-5 mx-auto" style="max-width: 500px;">
    <div class="card p-4">
        <?php require "parts/message_error.php"; ?>
        <h1 class="fs-1 text-center pb-4">Login</h1>
        <form method="POST" action="/auth/login">
            <div class="mb-3 row">
                <label for="email" class="col-6 col-form-label">Email :</label>
                <div class="col-12">
                    <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email"
                    placeholder="example@email.com"/>
                </div>
            </div>
                
            <div class="row">
                <label for="password" class="col-6 col-form-label">Password :</label>
                <div class="col-12">
                    <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    name="password">
                </div>
            </div>    
            <div class="pt-4 d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>   
        </form>
        <!-- Direct to signup page -->
        <p class="pt-4 text-end">
            <a href="/signup">
                No account? Sign up here! <i class="bi bi-arrow-right-circle"></i>
            </a>                            
        </p>
    </div>
</div>

<?php

    require "parts/footer.php";
    
?>