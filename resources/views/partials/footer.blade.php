<footer class="container justify-content-between footer">
    <div class="footer__sosmed">
        <h3 class="heading-secondary">Social Media</h3>
        <ul class="p-0">
            <li class="mb-3"><a href="//instagram.com/_saseka"><i class="bi bi-instagram"></i>Instagram</a></li>
            <li class="mb-3"><a href="https://www.youtube.com/channel/UCd3DAM6nM3oW_FFNrMFU3iQ"><i class="bi bi-youtube"></i>Youtube</a></li>
            <li class="mb-3"><a href="//facebook.com/Sanggar%20Seni%20Kimia%20Analisis"><i class="bi bi-facebook"></i>Facebook</a></li>
        </ul>
    </div>
    <div class="footer__aboutUs">
        <h3 class="heading-secondary">About Us</h3>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque, ipsum beatae necessitatibus ut amet placeat voluptates obcaecati ea, quis libero incidunt aliquid veritatis cumque enim impedit nostrum omnis quaerat. Voluptate molestiae magnam distinctio repudiandae facere enim libero tempore sed, error amet! Sit laboriosam assumenda nobis dolorum, ut quidem labore repellendus?</p>
    </div>
    <div class="footer__contactUs" id="contactUs">
        <h3 class="heading-secondary">Contact Us</h3>
        <form action="/contactUs" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <input type="hidden" name="currUrl" value="{{ Request::url() }}">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
</footer>