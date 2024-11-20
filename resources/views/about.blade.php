<!DOCTYPE html>
<html lang="en">
<head>
  <title>Talent Hive</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/animate.css">
  
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<img src="images/icon.jpeg" class="img-fluid" alt="">
			<a class="navbar-brand" href="index.html"><span style="color:black" >Talent Hive</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

   <div class="collapse navbar-collapse" id="ftco-nav">
     <ul class="navbar-nav ml-auto">
       <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
       <li class="nav-item active"><a href="{{ route('about') }}" class="nav-link">About</a></li>
       <!-- <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li> -->
       <li class="nav-item"><a href="{{ route('projects') }}" class="nav-link">Projects</a></li>
       <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
       <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact us</a></li>
       <li class="nav-item cta"><a  href="{{ route('mainpage') }}" class="nav-link" style="background-color:  #0DB688;">Login </a></li>

     </ul>
   </div>
 </div>
</nav>
<!-- END nav -->

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <h1 class="mb-3 bread">About Us</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>About us <i class="fa fa-chevron-right"></i></span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center pb-5">
      <div class="col-lg-6 heading-section text-center ftco-animate">
        <h2 class="mb-4">About  <span style="color: #0DB688;">Talent Hive</span></h2>
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
                              system and companies will easily get a suitable candidate according to their requirements
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

<section class="ftco-section ftco-no-pb testimony-section" style="background-image: url(images/bg_1.jpg);">
 <div class="overlay-1"></div>
 <div class="container-fluid">
  <div class="row justify-content-center mb-5 pb-3">
    <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
      <h2 class="mb-4">Our insights &amp; creative ideas</h2>
    </div>
  </div>
  <div class="row ftco-animate">
    <div class="col-md-12 testimonial">
      <div class="carousel-testimony owl-carousel ftco-owl">
        <div class="item">
          <div class="testimony-wrap d-flex align-items-stretch" style="background-image: url(images/testimony-1.jpg);">
           <div class="overlay"></div>
           <div class="text">
             <div class="line"></div>
             <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
             <p class="name">Donna Scott</p>
             <span class="position">Marketing Manager</span>
           </div>
         </div>
       </div>
       <div class="item">
        <div class="testimony-wrap d-flex align-items-stretch" style="background-image: url(images/testimony-2.jpg);">
         <div class="overlay"></div>
         <div class="text">
           <div class="line"></div>
           <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
           <p class="name">Roger Scott</p>
           <span class="position">Interface Designer</span>
         </div>
       </div>
     </div>
     <div class="item">
      <div class="testimony-wrap d-flex align-items-stretch" style="background-image: url(images/testimony-3.jpg);">
       <div class="overlay"></div>
       <div class="text">
         <div class="line"></div>
         <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
         <p class="name">Roger Scott</p>
         <span class="position">UI Designer</span>
       </div>
     </div>
   </div>
   <div class="item">
    <div class="testimony-wrap d-flex align-items-stretch" style="background-image: url(images/testimony-4.jpg);">
     <div class="overlay"></div>
     <div class="text">
       <div class="line"></div>
       <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
       <p class="name">Roger Scott</p>
       <span class="position">Web Developer</span>
     </div>
   </div>
 </div>
 <div class="item">
  <div class="testimony-wrap d-flex align-items-stretch" style="background-image: url(images/testimony-5.jpg);">
   <div class="overlay"></div>
   <div class="text">
     <div class="line"></div>
     <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
     <p class="name">Roger Scott</p>
     <span class="position">System Analyst</span>
   </div>
 </div>
</div>
</div>
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

<footer class="ftco-footer ftco-footer-2 ftco-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-footer-logo">Talent<span style="color: #0DB688;">Hive</span></h2>
          <p>Our Automated Open House Management System revolutionizes how educational institutions organize events, providing a centralized platform for stakeholders.</p>
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
              <li><span class="icon fa fa-map marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
              <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929 210</span></a></li>
              <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span class="text">info@yourdomain.com</span></a></li>
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
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

</body>
</html>