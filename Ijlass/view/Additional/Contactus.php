<link rel="stylesheet" href="/css/Additional/Contact.css">
<div class="contact-us-section d-flex align-items-center justify-content-center">
  <div class="container text-white">
    <h1 class="text-center mb-2">Contact Us</h1>
    <p class="text-center lead mb-3">We'd love to hear from you! Please fill out the form below and we’ll get back to you as soon as possible.</p>
    
    <form method="post" action="/controller/contactus.php">
      <div class="mb-4">
        <label for="email" class="form-label">Your Contact Email</label>
        <input type="email" class="form-control shadow" name="email" placeholder="Enter your email" required>
      </div>
      <div class="mb-4">
        <label for="message" class="form-label">Your Message</label>
        <textarea class="form-control shadow" name="message" rows="5" placeholder="Enter your message" required></textarea>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg shadow">Submit</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

