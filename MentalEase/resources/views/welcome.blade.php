<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MentalEase - Mental Health Services</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/landingnavbar.css', true) }}">
    <link rel="stylesheet" href="{{ asset('style/welcomepage.css', true) }}">
</head>
<body>

@include('include.landingnavbar')

<!-- Hero Section (Home) -->
<section id="home" class="hero parallax-section" style="background-image: url('{{ asset('style/assets/parallax-bg1.jpg', true) }}'); background-color: #F4F4F2;">
    <div class="container text-center">
        <div class="welcome-header mb-4">
            <h2 class="welcome-title"><span class="text-secondary">WELCOME TO</span> <span class="text-primary">MENTALEASE</span></h2>
            <h1 class="trusted-partner-title">Your Trusted Partner in Mental Wellness</h1>
            <p class="lead mx-auto" style="max-width: 700px;">
                MENTALEASE provides AI-driven emotional support, real-time mental health assessments, and easy access to professional consultations anytime, anywhere.
            </p>
            <div class="hero-buttons justify-content-center mt-4">
                <a href="{{ route('login') }}" class="btn btn-primary">Start Your Mental Wellness Journey →</a>
            </div>
        </div>
        
        <div class="trusted-by mt-5 pt-4">
            <h3 class="trusted-by-title mb-4">Trusted By</h3>
            <div class="trusted-logo">
                <a href="https://www.facebook.com/sanda.diagnostic/" target="_blank">
                    <img src="{{ asset('style/assets/sanda_logo.jpg', true) }}" alt="Sanda Diagnostic Center" class="img-fluid" style="max-width: 200px;">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="about-section parallax-section" style="background-image: url('{{ asset('style/assets/sanda.jpg', true) }}'); background-color: #F4F4F2;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="display-4 fw-bold text-white">About Us</h2>
            <p class="lead text-white">Dedicated to improving mental wellness through compassionate care</p>
            <div class="divider mx-auto my-4"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card about-card h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="section-icon mb-4">
                            <i class="fa-solid fa-heart-pulse fa-2x" style="color: #2D6A4F;"></i>
                        </div>
                        <h3 class="card-title fw-bold">Who We Are</h3>
                        <p class="card-text">MentalEase, in collaboration with Sanda Diagnostic Center, is an AI-powered web and mobile platform dedicated to providing accessible mental health support and diagnostic services.</p>
                        
                        <div class="section-icon mt-5 mb-4">
                            <i class="fa-solid fa-handshake fa-2x" style="color: #2D6A4F;"></i>
                        </div>
                        <h3 class="card-title fw-bold">Our Partner</h3>
                        <h4 class="card-subtitle mb-2" style="color: #2D6A4F;">Sanda Diagnostic Center</h4>
                        <p class="card-text">A trusted healthcare facility committed to delivering high-quality diagnostic and medical services, integrating modern technology with compassionate care.</p>
                        
                        <div class="section-icon mt-5 mb-4">
                            <i class="fa-solid fa-bullseye fa-2x" style="color: #2D6A4F;"></i>
                        </div>
                        <h3 class="card-title fw-bold" >Purpose</h3>
                        <h4 class="card-subtitle mb-2 text-primary text-green" >Our Mission</h4>
                        <p class="card-text">To empower individuals with AI-driven mental health tools and professional diagnostic services that promote self-awareness, emotional stability, and overall well-being.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card about-card h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="section-icon mb-4">
                            <i class="fa-solid fa-building-shield fa-2x" style="color: #2D6A4F;"></i>
                        </div>
                        <h3 class="card-title fw-bold">Sanda Diagnostic Center</h3>
                        
                        <h4 class="card-subtitle mb-3 text-primary text-green">Mission</h4>
                        <ul class="card-text list-group list-group-flush">
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-check-circle text-success me-2"></i>To consistently deliver top-quality and prompt medical services.</li>
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-check-circle text-success me-2"></i>To maintain a reputation as a value-driven, well-managed, and service-oriented organization.</li>
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-check-circle text-success me-2"></i>To implement an internationally-based quality system.</li>
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-check-circle text-success me-2"></i>To maintain properly conditioned test equipment/instruments and facilities.</li>
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-check-circle text-success me-2"></i>To maintain a pool of qualified and well-trained clinic workforce.</li>
                        </ul>
                        
                        <h4 class="card-subtitle mt-4 mb-3 text-primary text-green">Vision</h4>
                        <p class="card-text"><i class="fa-solid fa-quote-left text-muted me-2"></i>A recognized dependable provider of quality diagnostic medical services for pre-employment medical examinations and other healthcare services.<i class="fa-solid fa-quote-right text-muted ms-2"></i></p>
                        
                        <h4 class="card-subtitle mt-4 mb-3 text-primary text-green">Quality Policy</h4>
                        <p class="card-text">Our aim is to provide all customers with a service that consistently exceeds their expectations in relation to Quality, Reliability and Customer Service.</p>
                        <p class="card-text fw-bold">The company is totally committed to:</p>
                        <ul class="card-text list-group list-group-flush">
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-star text-warning me-2"></i>Achieving the highest Management standards with particular emphasis placed upon quality.</li>
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-star text-warning me-2"></i>Enhancing customer satisfaction, with continual improvement and effectiveness of the Quality Management System.</li>
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-star text-warning me-2"></i>Constant drive to satisfy our customers, while always being mindful of our responsibility to all relevant national and international legislation, our employees and the broader community.</li>
                            <li class="list-group-item bg-transparent border-0 ps-0"><i class="fa-solid fa-star text-warning me-2"></i>Requiring the active participation, endeavor and contribution of ideas from all staff.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services parallax-section" style="background-image: url('{{ asset('style/assets/healthservices.jpg', true) }}'); background-color: #F4F4F2;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="display-4 fw-bold text-white">Our Services</h2>
            <p class="lead text-white">Comprehensive mental health support tailored to your needs</p>
            <div class="divider mx-auto my-4"></div>
        </div>
        
        <div class="row g-4">

            
            <div class="col-md-6 col-lg-3">
                <div class="service-card h-100 border-0 shadow-lg">
                    <div class="icon">
                        <i class="fa-solid fa-brain" style="color: #2D6A4F;"></i>
                    </div>
                    <h3>Assessments</h3>
                    <p>Comprehensive mental health evaluations to understand your needs better.</p>
                </div>
            </div>
            

            
            <div class="col-md-6 col-lg-3">
                <div class="service-card h-100 border-0 shadow-lg">
                    <div class="icon">
                        <i class="fa-solid fa-video" style="color: #2D6A4F;"></i>
                    </div>
                    <h3>Online Mental Health Consultation</h3>
                    <p>Book virtual consultations with licensed mental health professionals for personalized support and guidance.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="service-card h-100 border-0 shadow-lg">
                    <div class="icon">
                        <i class="fa-solid fa-robot" style="color: #2D6A4F;"></i>
                    </div>
                    <h3>AI-Powered Emotional Support</h3>
                    <p>Engage in real-time conversations with an AI companion designed to provide emotional assistance and stress relief.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="service-card h-100 border-0 shadow-lg">
                    <div class="icon">
                        <i class="fa-solid fa-chart-line" style="color: #2D6A4F;"></i>
                    </div>
                    <h3>Mood Tracking & Mental Wellness Insights</h3>
                    <p>Monitor your daily mood patterns and receive AI-driven insights to help improve emotional well-being.</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="service-card h-100 border-0 shadow-lg">
                    <div class="icon">
                        <i class="fa-solid fa-heart" style="color: #2D6A4F;"></i>
                    </div>
                    <h3>Stress Management & Coping Strategies</h3>
                    <p>Access guided relaxation techniques, mindfulness exercises, and self-help programs tailored to your mental health needs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section parallax-section" style="background-image: url('{{ asset('style/assets/parallax-bg4.jpg', true) }}'); background-color: #F4F4F2;">
    <div class="container">
        <div class="section-contact">
            <h2>Contact Us</h2>
            <p>We're here to help - reach out to us today</p>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="contact-info-card">
                    <h3>Get in Touch</h3>
                    <div class="contact-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>1418 Larson Ave, Sampaloc, Manila</p>
                    </div>
                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <p>(8) 742 - 4080 / (8) 256 - 3337</p>
                    </div>
                    <div class="contact-item">
                        <i class="fa-solid fa-envelope"></i>
                        <p>sandadxcenter@yahoo.com</p>
                    </div>
                    <div class="contact-item">
                        <i class="fa-regular fa-clock"></i>
                        <p>Monday - Friday: 8:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form-card">
                    <h3>Send us a Message</h3>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta">
    <div class="container">
        <h2>Ready to take the first step?</h2>
        <p>Our team of professionals is here to support you on your journey to better mental health.</p>
        <a href="{{ route('login') }}" class="btn btn-light">Sign Up Today</a>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-logo">
                    <img src="{{ asset('style/assets/mentaleaselogo.png', true) }}" alt="MentalEase Logo">
                    <span>MentalEase</span>
                </div>
                <p>Providing professional mental health services to help you live a balanced and fulfilling life.</p>
            </div>
            <div class="col-lg-4">
                <h4>Contact Us</h4>
                <p><i class="fa-solid fa-location-dot"></i> 1418 Larson Ave, Sampaloc, Manila</p>
                <p><i class="fa-solid fa-phone"></i> (+63) 939 939 1293</p>
                <p><i class="fa-solid fa-envelope"></i> info@mentalease.com</p>
            </div>
            <div class="col-lg-4">
                <h4>Follow Us</h4>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 MentalEase. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Simple parallax effect
    window.addEventListener('scroll', function() {
        const parallaxSections = document.querySelectorAll('.parallax-section');
        
        parallaxSections.forEach(section => {
            const scrollPosition = window.pageYOffset;
            const sectionTop = section.offsetTop;
            const distance = scrollPosition - sectionTop;
            
            // Apply parallax effect only when section is visible
            if (scrollPosition > sectionTop - window.innerHeight && 
                scrollPosition < sectionTop + section.offsetHeight) {
                section.style.backgroundPositionY = (distance * 0.4) + 'px';
            }
        });
    });
</script>
</body>











