<div class="col-md-6">
    <div class="contact-form-card">
        <h3>Send us a Message</h3>
        <form method="POST" action="{{ route('concern.send') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="subject" class="form-control" placeholder="Subject">
            </div>
            <div class="mb-3">
                <textarea name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Send Message</button>
        </form>
    </div>
</div>
