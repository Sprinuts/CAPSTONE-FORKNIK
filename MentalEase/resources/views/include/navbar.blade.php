<link rel="stylesheet" href="{{ asset('style/navbar.css') }}">

<nav class="navbar navbar-expand-lg bg-body-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="">
            <img src="" alt="home" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('welcomepatient') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('chatbot') }}">ChatBot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route(name: 'appointment.selectPsychometrician') }}">Appointment</a>  
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Assessments
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route(name: 'assessment.stress') }}">Stress</a></li>
                        <li><a class="dropdown-item" href="{{ route(name: 'assessment.emotional') }}">Emotional</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="{{ route('consultation') }}">Online Consultation</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="{{ route('about') }}">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="Btn" href="{{ route('logout') }}">
                    <div class="sign">  
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    <div class="text">Logout</div>
                </a>
                </li>
            </ul>
        </div>
    </div>
</nav>