<!-- Header -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header id="header" class="header">
    <div class="header-menu">
        <div class="col-sm-7"></div>
        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "<h5>Welcome, " . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . "</h5>";
                    }
                    ?>
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- /Header -->
