<!DOCTYPE html>
<html lang="en">

<head>
    <title>TalentHive</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
    </style>
    </sytle>

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <img src="images/icon.jpeg" class="img-fluid" alt="">
            <a class="navbar-brand" href="index.html"><span style="color:black">Talent Hive</span></a>

            <!-- <a class="navbar-brand" href="index.html">    Talent<span style="color:  #0DB688;" >Hive</span></a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <!-- <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li> -->
                    <li class="nav-item"><a  href="{{ route('projects') }}" class="nav-link">Projects</a></li>
                    <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
                    <li class="nav-item"><a  href="{{ route('contact') }}" class="nav-link">Contact us</a></li>
                    <li class="nav-item cta"><a  href="{{ route('mainpage') }}"class="nav-link"
                            style="background-color:  #0DB688;">Login </a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <div class="hero-wrap js-fullheight" style="background-image: url('images/open house event.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-8 ftco-animate mt-5 pt-md-5" data-scrollax=" properties: { translateY: '70%' }">
                    <div class="row">
                        <div class="col-md-7">
                            <p class="mb-4 pl-md-5 line"
                                data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Discover, Connect,
                                Thrive
                            </p>
                        </div>
                    </div>
                    <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Connecting Talent
                        <br>With Opportunity
                    </h1>
                    <!-- <p><a href="#" class="btn btn-primary px-4 py-3">Read more</a></p> -->
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-lg-6 heading-section text-center ftco-animate">
                    <h2 class="mb-4">About <span style="color: #0DB688;">Talent Hive</span></h2>
                    <p>Talent Hive is an Automated Open House Management System that
                        will revolutionize the way educational institutions organize and manage their Open
                        House event.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="services-2 text-center">
                        <div class="icon">
                            <span class="flaticon-web-programming"></span>
                        </div>
                        <div class="text">
                            <!-- <h3>Web Development</h3> -->
                            <p>Students will be able to showcase their projects and skills through the
                                system and companies will easily get a suitable candidate according to their
                                requirements
                                or needs. Interviews can be scheduled with students by the companies through our
                                application during the job fair.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/services.svg" class="img-fluid" alt="">
                </div>
                <div class="col-md-4">
                    <div class="services-2 text-center">
                        <div class="icon">
                            <span class="flaticon-secure"></span>
                        </div>
                        <div class="text">
                            <!-- <h3>Server Security</h3> -->
                            <p>Incharge & Supervisors will have tools to track students' progress regarding
                                interviews and jobs efficiently. The system will collect and analyze feedback and
                                analytics to improve future events which will provide valuable information to help in
                                decision making.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-counter img" id="section-counter">
        <div class="container">
            <div class="row no-gutters d-flex">
                <div class="col-md-6 d-flex">
                    <div class="img d-flex align-self-stretch" style="background-image:url(images/shields.JPG);"></div>
                </div>
                <div class="col-md-6 p-3 pl-md-5 py-5 bg-primary">
                    <div class="row justify-content-start pb-3">
                        <div class="col-md-12 heading-section heading-section-white ftco-animate">
                            <h2 class="mb-4">Talent Hive <span style="color: #0DB688;">Info</span></h2>
                            <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 mb-4">
                                <div class="text">
                                    <strong class="number"
                                        data-number="{{ $completedProjects }}">{{ $projectCount }}</strong>
                                    <span>Project Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 mb-4">
                                <div class="text">
                                    <strong class="number" data-number="{{ $projectsInProgress }}">
                                        {{ $projectsInProgress }}</strong>
                                    <span>Project Inprogress</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 mb-4">
                                <div class="text">
                                    <strong class="number"
                                        data-number="{{ $studentCount }}">{{ $studentCount }}</strong>
                                    <span>Students</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 mb-4">
                                <div class="text">
                                    <strong class="number"
                                        data-number="{{ $companyCount }}">{{ $companyCount }}</strong>
                                    <span>Associated companies</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section services-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-6 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Our Exclusive <span>Talent Hive</span> Features</h2>
                </div>
            </div>
            <div class="row d-flex no-gutters">
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="line"></div>
                        <div class="icon"><span class="flaticon-web-programming"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Project Showcase</h3>
                            <p> The Project Showcase feature is designed to highlight and display completed projects or student work in an organized and visually appealing manner. </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="line"></div>
                        <div class="icon"><span class="flaticon-stats"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Interview Scheduling</h3>
                            <p>The interview scheduling feature is a tool designed to automate and simplify the process of setting up interviews. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="line"></div>
                        <div class="icon"><span class="flaticon-secure"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Automated Matching Algorthm</h3>
                            <p>An automated matching algorithm is a feature that uses data analysis and pattern recognition to pair candidates with the most suitable opportunities or connections based on predefined criteria</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="line"></div>
                        <div class="icon"><span class="flaticon-presentation"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Online meeting with remote companies</h3>
                            <p>The online meeting feature allows users to conduct virtual meetings seamlessly through integrated video conferencing platforms. </p>
                        </div>
                    </div>
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
                                {{ $project->abstract }}
                            </p>
                            <div class="hstack row-gap-3 gap-2 mb-3 align-items-center justify-content-between flex-wrap">
                                <div class="hstack gap-1" style="align-items: center;">
                                <a href="{{ route('mainpage') }}">
    <button class="btn btn-success-emphasis btn-sm" style="background-color: #0DB688;">
        Show More
    </button>
</a>

                                </div>
                                <div class="hstack gap-2">
                                    <span class="text-danger">Ending {{ \Carbon\Carbon::parse($project->ending_date)->format('F Y') }}</span>
                                </div>
                            </div>
                            <div class="hstack row-gap-3 gap-4 flex-wrap justify-content-between">
                                <span>
                                    Students:<br>
                                    <div class="avatar-stack">
                                        @foreach($project->students as $member)
                                            <div class="d-flex align-items-center mb-2">
                                                <img class="avatar" src="{{ Storage::url($member->profile_image) }}" title="{{ $member->name }}" alt="User Avatar" />
                                            </div>
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
            {{ $projects->links() }}
        </div>

         
    </div>
</div>

    </section>

    <section class="ftco-section bg-light ftco-faqs">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-md-last">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0"
                        style="background-image:url(images/people.JPG);">
                    </div>
                    <div class="d-flex mt-3">
                        <div class="img img-2 mr-md-2 w-100" style="background-image:url(images/shields.JPG);"></div>
                        <div class="img img-2 ml-md-2 w-100" style="background-image:url(images/cards.JPG);"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="heading-section mb-5 mt-5 mt-lg-0">
                        <h2 class="mb-3">Frequently Asks Questions</h2>
                    </div>
                    <div id="accordion" class="myaccordion w-100" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header p-0" id="headingOne">
                                <h2 class="mb-0">
                                    <button href="#collapseOne"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <p class="mb-0">What is the Automated Open House Management System?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse show" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-body py-3 px-0" style="background-color:  #0DB688;">
                                    <ol>
                                      <p>
                                      An Automated Open House Management System is a software solution designed to streamline and automate various tasks associated with organizing and managing open houses for real estate properties. These systems are typically used by real estate agents, property managers, or real estate agencies to enhance the efficiency of the open house process. 
                                     </p>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-0" id="headingTwo" role="tab">
                                <h2 class="mb-0">
                                    <button href="#collapseTwo"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <p class="mb-0">How long does it take to build a website?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse" id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body py-3 px-0" style="background-color:  #0DB688;">
                                    <ol>
                                    <p> 
                                            The time it takes to create a website can vary widely depending on several factors, including the complexity of the site, the features and functionality required, and the development process itself. A simple website with basic pages (home, about, contact, etc.) might take 2 to 4 weeks if it's designed from scratch, including planning, design, development, and testing. More complex websites, such as those with e-commerce functionality, user authentication, or custom features, can take anywhere from 1 to 3 months or longer.
                                        </p>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-0" id="headingThree" role="tab">
                                <h2 class="mb-0">
                                    <button href="#collapseThree"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <p class="mb-0">How does automated interview scheduling work?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse" id="collapseThree" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body py-3 px-0" style="background-color:  #0DB688;">
                                    <ol>
                                    <p>
                                            Automated interview scheduling works by using software to streamline the process of coordinating interviews between candidates and recruiters or hiring managers. The system integrates with calendars, allowing candidates to view available time slots and select a convenient interview time, eliminating the need for back-and-forth communication. 
                                        </p>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-0" id="headingFour" role="tab">
                                <h2 class="mb-0">
                                    <button href="#collapseFour"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <p class="mb-0">How can students showcase their projects and skills through the
                                            system?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse" id="collapseFour" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body py-3 px-0" style="background-color:  #0DB688;">
                                    <ol>
                                    <p>
                                            Students can showcase their projects and skills through a system by creating personalized profiles that highlight their academic achievements, skills, and completed projects. The system can provide dedicated sections for students to upload project descriptions, code repositories, presentations, or even demo videos. Students can tag their work with relevant skills or technologies used, making it easier for potential employers or evaluators to find projects related to specific competencies.
                                        </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0" id="headingFour" role="tab">
                                <h2 class="mb-0">
                                    <button href="#collapseFour"
                                        class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link"
                                        data-parent="#accordion" data-toggle="collapse" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <p class="mb-0">How can educational institutions benefit from implementing this
                                            system?</p>
                                        <i class="fa" aria-hidden="true"></i>
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse" id="collapseFour" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body py-3 px-0" style="background-color:  #0DB688;">
                                    <ol>
                                    <p>
                                            Educational institutions can greatly benefit from implementing an automated interview scheduling system by enhancing efficiency in admissions, faculty hiring, and student services. For admissions, the system can streamline the process of scheduling interviews with prospective students, allowing candidates to easily book interview slots and reducing administrative workload. It also simplifies faculty recruitment by coordinating interviews with applicants, ensuring that schedules align with multiple stakeholders, such as department heads and hiring committees
                                        </p>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- <section class="ftco-appointment ftco-section img" style="background-image: url(images/Help-Support.png);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 half ftco-animate">
                    <h2 class="mb-4">Don't hesitate to contact us</h2>
                    <form action="#" class="appointment">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">Services</option>
                                                <option value="">Web Development</option>
                                                <option value="">Database Analysis</option>
                                                <option value="">Server Security</option>
                                                <option value="">UX/UI Strategy</option>
                                                <option value="">Branding</option>
                                                <option value="">Applications</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="" id="" cols="30" rows="7" class="form-control"
                                        placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Send message" class="btn btn-default py-3 px-4"
                                        style="background-color: #0DB688 ; color: white;">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> -->

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
                            <li><a href="{{ route('home') }}" class="py-2 d-block">Home</a></li>
                            <li><a href="{{ route('about') }}" class="py-2 d-block">About</a></li>
                            <li><a href="{{ route('contact') }}" class="py-2 d-block">Contact</a></li>
                            <li><a href="{{ route('projects') }}" class="py-2 d-block">Projects</a></li>
                          
                            <!-- <li><a href="#" class="py-2 d-block">Call Us</a></li> -->
                        </ul>
                    </div>
                </div>
                
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map marker"></span><span class="text">Islamabad Pakistan</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">05822221952</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span>
                                <span class="text">TalentHive@gmail.com</span></a></li>
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

</body>

</html>