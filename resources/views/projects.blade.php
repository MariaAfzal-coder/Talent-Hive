<!DOCTYPE html>
<html lang="en">

<head>
    <title>TalentHive</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="shortcut icon" href="Incharge/assets/images/favicon.ico" type="image/x-icon">
    <link href="Incharge/assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/incharge_font.css">
    <link rel="stylesheet" href="css/incharge_style.css">
    <style>
    .date {
        font-size: 20px;
        margin-top: 5px;
    }

    .col-md-4 {
        max-width: 300px;
        /* Set maximum width */
        width: 100%;
        /* Ensure responsiveness */
        margin: 0 auto;
        /* Center the box horizontally */
        transition: transform 0.3s;
        /* Add transition effect */
    }

    /* Add hover effect */
    .col-md-4:hover {
        transform: scale(1.05);
        /* Scale up on hover */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    /* Add shadow on hover */

    .search-form {
        display: flex;
        justify-content: flex-end;
        /* Aligns the form to the right */
        margin-bottom: 0;
        /* Removes any bottom margin */
    }

    .search-form .form-group {
        position: relative;
        display: inline-block;
        margin-bottom: 0;
        /* Removes bottom margin */
    }

    .search-form .icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .search-form .search-input {
        width: 250px;
        /* Adjust width as needed */
        padding: 5px 10px 5px 30px;
        /* Adjust padding as needed */
        font-size: 14px;
        /* Adjust font size as needed */
        margin-bottom: 0;
        /* Removes bottom margin */
    }

    .card.shadow-none.border-0 {
        margin-top: 0;
        /* Ensure no margin above the card */
        padding-top: 0;
        /* Ensure no padding above the card */
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <img src="images/icon.jpeg" class="img-fluid" alt="">
            <a class="navbar-brand" href="index.html"><span style="color:black">Talent Hive</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item "><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <!-- <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li> -->
                    <li class="nav-item active"><a href="{{ route('projects') }}" class="nav-link">Projects</a></li>
                    <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
                    <li class="nav-item"><a  href="{{ route('contact') }}" class="nav-link">Contact us</a></li>
                    <li class="nav-item cta"><a href="{{ route('mainpage') }}" class="nav-link"
                            style="background-color:  #0DB688;">Login </a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb-3 bread">Projects</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Projects <i
                                class="fa fa-chevron-right"></i></span></p>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Showcase Innovative <span> Project</span></h2>
                </div>
            </div>
            <!-- Search Box -->
            <form action="#" class="search-form">
                <div class="form-group">
                    <span class="icon fa fa-search"></span>
                    <input type="text" class="form-control search-input" placeholder="Search">
                </div>
            </form>
            <div class="card shadow-none border-0">
                <div class="card-body py-4">
                <div class="row g-3">
    @foreach($projects as $project)
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="hstack justify-content-between gap-2 flex-wrap">
                        <h3 class="fs-5 mb-0 fw-semibold d-flex align-items-center">
                            <a href="#" class="event-title text-decoration-none text-dark">{{ $project->title }}</a>
                        </h3>
                        <span class="bg-success-subtle text-success-emphasis rounded-pill px-3 py-1 text-sm project-status ms-3">
                            {{ $project->status }}
                        </span>
                    </div>
                    <hr>
                    <p class="project-description text-secondary mb-3 fw-normal">
                        {{ Str::limit($project->abstract, 150) }} <!-- Displaying a shortened version of the abstract -->
                    </p>
                    <div class="hstack row-gap-3 gap-2 mb-3 align-items-center justify-content-between flex-wrap">
                        <div class="hstack gap-1" style="align-items: center;">
                            <a href="{{ route('mainpage') }}">
                                <button class="btn btn-success-emphasis btn-sm" data-btn-edit style="background-color: #0DB688;">
                                    Show More
                                </button>
                            </a>
                        </div>
                        <br><br>
                        <div class="hstack gap-2">
                             <span class="text-danger">Ending {{ \Carbon\Carbon::parse($project->ending_date)->format('F Y') }}</span>
                        </div>
                    </div>
                    <div class="hstack row-gap-3 gap-4 flex-wrap justify-content-between">
                        <span>
                            Students:<br>
                            <div class="avatar-stack">
                                @foreach($project->students as $member)
                                    <img class="avatar" src="{{ Storage::url($member->profile_image) }}" title="{{ $member->name }}" alt="User Avatar" />
                                @endforeach
                            </div>
                        </span>
                        <span>Supervised By:<br><span class="supervisor text-secondary">{{ $project->supervisor ? $project->supervisor->name : 'Unknown' }}</span></span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination links -->
<div class="d-flex justify-content-center">
    {{ $projects->links() }} <!-- This will display pagination controls -->
</div>


                    
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer ftco-footer-2 ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-footer-logo">Talent<span style="color: #0DB688;">Hive</span></h2>
                        <p>Our Automated Open House Management System revolutionizes how educational institutions
                            organize events, providing a centralized platform for stakeholders.</p>
                        <ul class="ftco-footer-social list-unstyled mt-2">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Explore</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Home</a></li>
                            <li><a href="#" class="py-2 d-block">About</a></li>
                            <li><a href="#" class="py-2 d-block">Contact</a></li>
                            <li><a href="#" class="py-2 d-block">Projects</a></li>
                            <!-- <li><a href="#" class="py-2 d-block">Plans &amp; Pricing</a></li> -->
                            <!-- <li><a href="#" class="py-2 d-block">Refund Policy</a></li> -->
                            <li><a href="#" class="py-2 d-block">Call Us</a></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Legal</h2>
          <ul class="list-unstyled">
            <li><a href="#" class="py-2 d-block">Join Us</a></li>
            <li><a href="#" class="py-2 d-block">Blog</a></li>
            <li><a href="#" class="py-2 d-block">Privacy &amp; Policy</a></li>
            <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
            <li><a href="#" class="py-2 d-block">Careers</a></li>
            <li><a href="#" class="py-2 d-block">Contact</a></li>
          </ul>
        </div>
      </div> -->
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map marker"></span><span class="text">203 Fake St. Mountain
                                        View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929
                                            210</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span
                                            class="text">info@yourdomain.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
    <script src="Incharge/assets/js/svg-injector.min.js"></script>
    <script src="Incharge/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="Incharge/assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="Incharge/assets/js/main.js"></script>

</body>

</html>