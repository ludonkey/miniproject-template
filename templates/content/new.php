<!DOCTYPE html>
<html lang="en">

{% include 'inc/head.php' %}

<body>

    {% include 'inc/nav.php' %}

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div id="login">
                    <form class="form-new" action="/new" method="POST">
                        <p>
                            <?php
                            if (isset($errorMsg)) {
                                echo "<div class='alert alert-warning' role='alert'>$errorMsg</div>";
                            }
                            ?>
                            <h5>&gt; New Card</h5>
                        </p>
                        <p>
                            <label>Title:</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ title }}">
                            <label>Description:</label>
                            <input type="text" name="description" class="form-control" placeholder="Description" value="{{ description }}">
                            <label>Image URL:</label>
                            <input type="text" name="image_url" class="form-control" placeholder="http://..." value="{{ image_url }}">
                            <label>External Link:</label>
                            <input type="text" name="external_url" class="form-control" placeholder="http://..." value="{{ external_url }}">
                        </p>
                        <p>
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Create</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {% include 'inc/javascript.php' %}

</body>

</html>