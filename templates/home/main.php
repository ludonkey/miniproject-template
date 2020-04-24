<!DOCTYPE html>
<html lang="en">

<head>
    {% include 'inc/head.php' %}
</head>

<body>

    {% include 'inc/nav.php' %}

    <div class="container">
        <div class="jumbotron">
            <h1>HelloWorld</h1>
            <p class="lead">{{myText}}</p>
            <a class="btn btn-lg btn-primary" href="#" role="button">A simple button</a>
        </div>

        <div class="row masonry-grid">
            <div class="col-md-6 col-lg-4 masonry-column">
                <?php
                $oneColumnItemNumber = ceil(count($cards) / 3);
                $i = 0;
                foreach ($cards as $oneCard) {
                ?>
                <div class="card card-block">
                    <img src="{{oneCard->image->url}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{oneCard->title}}</h5>
                        <p class="card-text">{{oneCard->text}}</p>
                        <a href="#{{oneCard->id}}" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <?php
                    $i++;
                    if ($i % $oneColumnItemNumber == 0) {
                        echo '</div>';
                        echo '<div class="col-md-6 col-lg-4 masonry-column">';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    {% include 'inc/javascript.php' %}

</body>

</html>