<?php require_once 'config.php'; ?>
    <link rel="stylesheet" href="css/orderForm.css">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <!-- Navigation Bar -->
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" alt="" width="80" height="80">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact!</a>
                    </li>

                    <?php if (!isset($_SESSION["username"])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">Registration</a>
                        </li>
                    <?php } else { ?>

                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">User Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orderForm.php">Order Form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="invoice.php">Invoices</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($_SESSION["level"])) : ?>
                        <?php if ($_SESSION["level"] == "Administrator") : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrator Functions</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="user-search.php">Search Users</a>
                                    <a class="dropdown-item" href="user-add.php">Add Users</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="product-add.php">Add Products</a>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="search-user.php">Search Users</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <?php if (isset($_SESSION["name"])) {
                    echo "<div class='alert alert-success d-flex'><span>Welcome, " . $_SESSION["name"] . "<br><a href='logout.php'>Logout</a></span></div>";
                } else {
                    echo "<div class='alert alert-info d-flex'><a href='index.php'>Sign In</a>";
                }
                ?>
            </div>
        </div>
        <?php
        if (!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
            ?>
            <div class="cart_div">
                <a href="cart.php"><img src="images/cart-icon.png"/> Cart<span>
<?php echo $cart_count; ?></span></a>
            </div>
            <?php
        }
        ?>
    </nav>

    <script src="js/bootstrap.bundle.js"></script>
<?php
function sanitise_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function outputFooter()
{
    date_default_timezone_set('Australia/Canberra');
    echo "<footer>This page was last modified: " . date("F d Y H:i:s.", filemtime("index.php")) . "</footer>";
}

?>