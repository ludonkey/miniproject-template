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
                <div class="card card-block">
                    <img src="https://cdn.pixabay.com/photo/2016/04/24/17/27/wood-1350175_960_720.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card card-block">
                    <img src="https://cdn.pixabay.com/photo/2017/01/24/03/53/plant-2004483_960_720.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 masonry-column">
                <div class="card card-block">
                    <img src="https://cdn.pixabay.com/photo/2017/05/30/12/21/green-tea-2356770_960_720.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card card-block">
                    <img src="https://cdn.pixabay.com/photo/2016/06/27/17/54/leaf-1482948_960_720.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 masonry-column">
                <div class="card card-block">
                    <img src="https://cdn.pixabay.com/photo/2016/12/16/13/18/canola-fields-1911392_960_720.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card card-block">
                    <img src="https://cdn.pixabay.com/photo/2016/03/10/18/44/top-view-1248955_960_720.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {% include 'inc/javascript.php' %}

</body>

</html>