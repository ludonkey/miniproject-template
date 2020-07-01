<!DOCTYPE html>
<html lang="en">

{% include 'inc/head.php' %}

<body>

    {% include 'inc/nav.php' %}

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div id="login">
                    <form class="form-signin" action="/register" method="POST">
                        <p>
                            <?php
                            if (isset($errorMsg)) {
                                echo "<div class='alert alert-warning' role='alert'>$errorMsg</div>";
                            }
                            ?>
                            <h5>Register</h5>
                        </p>
                        <p>
                            <label>Your username:</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <label>Your password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <label>Retype your password:</label>
                            <input type="password" name="passwordRetype" class="form-control" placeholder="Retype Password">
                        </p>
                        <p>
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {% include 'inc/javascript.php' %}

</body>

</html>