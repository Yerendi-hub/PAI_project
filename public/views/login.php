<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <?
        include("public/templates/head.php")
        ?>
    </head>
    <body>
        <?
        include("public/templates/navbar.php")
        ?>
        <main class="page">
            <section class="login-container">
                    <form class="form" action="postLogin" method="post">
                        <h3>Login</h3>

                        <div class="messages">
                            <?php
                            if(isset($messages)){
                                foreach($messages as $message) {
                                    echo '<div class="alert alert-danger">'.$message.'</div>';
                                }
                            }
                            ?>
                        </div>

                        <div class="form-row">
                            <label html="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-input" />
                        </div>
                        <div class="form-row">
                            <label html="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-input" />
                        </div>
                        <button type="submit" class="btn btn-block">
                            Login
                        </button>
                    </form>
            </section>
        </main>
        <?
        include("public/templates/footer.php")
        ?>
        <script src="public/js/app.js"></script>
    </body>
</html>