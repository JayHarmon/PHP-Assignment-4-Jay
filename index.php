<?php include "template.php"; ?>
<?php include 'login.php'; ?>
<title>Adventure Hub</title>

<h1 class='text-primary'>Welcome to our shopfront</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <p>Username: admin</p>
            <p>Password: admin</p>
            <p>Username: user</p>
            <p>Password: user</p>
            <p>Username: ryan</p>
            <p>Password: ryan</p>
            <p>Username: test</p>
            <p>Password: test</p>
        </div>
        <div class="col-md-6">


            <?php if (!isset($_SESSION["username"])) : ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required="required"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required="required"/>
                    </div>

                    <center>
                        <button name="login" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-log-in"></span> Login
                        </button>
                    </center>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>

