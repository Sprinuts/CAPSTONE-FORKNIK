<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MentalEase - Mental Health Services</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/landingnavbar.css') }}">
    <link rel="stylesheet" href="{{ asset('style/welcomepage.css') }}">
</head>
<body>

@include('include.landingnavbar')

<!-- Hero Section (Home) -->
<section id="home" class="hero parallax-section" style="background-image: url('{{ asset('style/assets/parallax-bg1.jpg') }}'); background-color: #F4F4F2;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1>Your Mental Health Matters</h1>
                <p>MentalEase provides professional mental health services to help you live a balanced and fulfilling life. Our team of experts is here to support your journey to wellness.</p>
                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
                    <a href="#services" class="btn btn-outline">Learn More</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('style/assets/mentalhealth1.jpg') }}" alt="Mental Health Support" class="hero-image">
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="about-section parallax-section" style="background-image: url('{{ asset('style/assets/sanda.jpg') }}'); background-color: #F4F4F2;">
    <div class="container">
        <div class="section-header">
            <h2>About Us</h2>
            <p>Dedicated to improving mental wellness through compassionate care</p>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card about-card">
                    <div class="card-body">
                        <h3 class="card-title">Our Mission</h3>
                        <p class="card-text">At MentalEase, we believe everyone deserves access to quality mental health care. Our mission is to provide compassionate, evidence-based services that empower individuals to overcome challenges and live fulfilling lives.</p>
                        
                        <h3 class="card-title mt-4">Our Team</h3>
                        <p class="card-text">Our team consists of licensed psychologists, therapists, and counselors with extensive experience in various mental health specialties. We're committed to creating a safe, supportive environment for all our clients.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services parallax-section" style="background-image: url('{{ asset('style/assets/healthservices.jpg') }}'); background-color: #F4F4F2;">
    <div class="container">
        <div class="section-header">
            <h2>Our Services</h2>
            <p>Comprehensive mental health support tailored to your needs</p>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3>Counseling</h3>
                    <p>One-on-one sessions with licensed therapists to address your specific concerns.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h3>Assessments</h3>
                    <p>Comprehensive mental health evaluations to understand your needs better.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h3>Support Groups</h3>
                    <p>Connect with others facing similar challenges in a supportive environment.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section parallax-section" style="background-image: url('{{ asset('style/assets/parallax-bg4.jpg') }}'); background-color: #F4F4F2;">
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
                        <p>(+63) 939 939 1293</p>
                    </div>
                    <div class="contact-item">
                        <i class="fa-solid fa-envelope"></i>
                        <p>info@mentalease.com</p>
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
                    <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo">
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

