<link rel="stylesheet" href="{{ asset('style/concerns.css') }}">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header">
                    <h3 class="text-center mb-0">We're Here to Help</h3>
                    <p class="text-center text-muted mt-2">Your mental health matters to us</p>
                </div>
                <div class="card-body">
                    <div class="row g-0">
                        <div class="col-lg-5 contact-info-section">
                            <div class="p-4">
                                <h4 class="section-title"><i class="fas fa-info-circle me-2"></i>Contact Us</h4>
                                <p class="text-muted mb-4">If you have any questions or concerns about our services, our dedicated support team is ready to assist you.</p>
                                
                                <div class="contact-card mb-4">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Phone Support</h6>
                                        <p class="mb-0">(+63) 939 929 1293</p>
                                        <span class="availability">Available 24/7</span>
                                    </div>
                                </div>
                                
                                <div class="contact-card mb-4">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Email Support</h6>
                                        <p class="mb-0">sandadxcenter@yahoo.com</p>
                                        <span class="availability">Response within 24 hours</span>
                                    </div>
                                </div>
                                
                                <div class="contact-card">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Office Location</h6>
                                        <p class="mb-0">Sanda BLDG, 1418 Lacson Ave, Sampaloc, Manila</p>
                                        <span class="availability">Mon-Fri: 9AM-5PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-7 form-section">
                            <div class="p-4">
                                <h4 class="section-title"><i class="fas fa-paper-plane me-2"></i>Send Your Concern</h4>
                                <p class="text-muted mb-4">We value your feedback and are committed to addressing your concerns promptly.</p>
                                
                                <form method="POST" action="{{ route('concern.send') }}" class="concern-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input type="text" name="name" id="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" name="email" id="email" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                            <input type="text" name="subject" id="subject" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="message" class="form-label">Your Message</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-comment"></i></span>
                                            <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-2"></i>Submit Concern
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



