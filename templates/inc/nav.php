<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class=" container">
        <a class="navbar-brand" href="{{ url('homepage') }}">{{ main_title }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown07">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-md-0" action="{{ url('homepage') }}">
                <input class="form-control" type="text" name="search" placeholder="Search" aria-label="Search">
            </form>
            <?php
            if ($app_session->has('user')) {
            ?>
                <a href="/logout" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" id="logout-btn">Logout</a>
                <a href="/new" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" id="new-btn">+</a>
            <?php
            } else {
            ?>
                <a href="/login" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" id="login-btn">Log in</a>
                <a href="/register" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" id="signup-btn">Sign up</a>
            <?php
            }
            ?>
        </div>
    </div>
</nav>