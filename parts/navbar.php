<nav class="navbar navbar-expand-lg bg-danger bg-opacity-75">
  <div class="container-fluid">
        
        <a class="navbar-brand text-light" href="/home">
            <img src="/includes/assets/images/cat-image2.png" alt="fs logo" style="width: 50px;">
            Discat
        </a>
        <div class="d-flex">
                <ul class="nav">
                    <a href="/profile">
                        <button type="button" class="btn btn-primary me-1">
                            <i class="bi bi-person-circle"></i>
                        </button>
                    </a>
                </ul>
            <!-- Login and logout -->
            <?php if(isUserLoggedIn()) {?>
                <a href="/logout">
                    <button type="button" class="btn btn-primary">Logout</button>
                </a>
                <?php if(isAdminOrEditor()) :?>
                    <a href="/dashboard">
                        <button type="button" class="btn btn-primary ms-1 ">Dashboard</button>
                    </a>
                <?php endif ;?>
                <?php } else { ?>
                    <a href="/login">
                        <button type="button" class="btn btn-primary">Login</button>
                    </a>
            <?php } ?>

        </div>
    </div>
</nav>
