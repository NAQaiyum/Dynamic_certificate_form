<header>
    <!-- ... Your header content ... -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="file:///D:/Internship/www.carcheck.co.uk/www.carcheck.co.uk/indexx.html">
                <img src="{{asset('frontend')}}/img/fav.png" alt="logo"> UK Car Check
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('frontend::home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('frontend::pricing')}}">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Car Check
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Stolen Car</a>
                            <a class="dropdown-item" href="#">Car Tax</a>
                            <a class="dropdown-item" href="#">MOT History</a>
                            <a class="dropdown-item" href="#">Outstanding Finance</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('frontend::contact')}}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>