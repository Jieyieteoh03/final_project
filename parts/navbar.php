<nav class="navbar navbar-expand-lg bg-dark bg-opacity-25">
  <div class="container-fluid">
        
        <a class="navbar-brand" href="/">
            <img src="/includes/assets/images/fs logo.jpg" alt="fs logo" class="w-25">
            Fake reddit
        </a>
        <button class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
        >
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex">

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>
                </ul>
            </div>
            <!-- Login and logout -->
            <?php if(isUserLoggedIn()) {?>
                <a href="/logout">
                    <button type="button" class="btn btn-primary">Logout</button>
                </a>
                <a href="/dashboard">
                    <button type="button" class="btn btn-primary ms-1 ">Dashboard</button>
                </a>
                <?php } else { ?>
                    <a href="/login">
                        <button type="button" class="btn btn-primary">Login</button>
                    </a>
            <?php } ?>

        </div>
    </div>
</nav>
