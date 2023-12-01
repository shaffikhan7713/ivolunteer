@extends('layouts.main')

@section('main-section')

<main>
    @if(session('success'))
    <h4 class="tm-text-success text-center mt-3">{{session('success')}}</h4>
    @endif

    @if(session('error'))
    <h4 class="tm-text-success text-center mt-3">{{session('error')}}</h4>
    @endif
    <header class="row tm-welcome-section">
        <h2 class="col-12 text-center tm-section-title">Contact Us</h2>
        <!-- <p class="col-12 text-center">You may use <a rel="nofollow"
                href="https://www.ltcclock.com/downloads/simple-contact-form/" target="_blank">Simple Contact Form</a>
            to send email to your inbox. You can modify and use this template for your website. Header image has a
            parallax effect. Total 3 HTML pages included in this template.</p> -->
    </header>

    <div class="tm-container-inner-2 tm-contact-section">
        <div class="row">
            <div class="col-md-6">
                <form action="/add-contact" method="POST" class="tm-contact-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name" required="" />
                    </div>

                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email" required="" />
                    </div>

                    <div class="form-group">
                        <textarea rows="5" name="message" class="form-control" placeholder="Message"
                            required=""></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="phone" required="" />
                    </div> -->

                    <div class="form-group tm-d-flex">
                        <button type="submit" class="tm-btn tm-btn-success tm-btn-right">
                            Send
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="tm-address-box">
                    <h4 class="tm-info-title tm-text-success">Our Address</h4>
                    <address>{{ $contact['address'] }}</address>
                    <a href="tel:{{ $contact['phone'] }}" class="tm-contact-link">
                        <i class="fas fa-phone tm-contact-icon"></i>{{ $contact['phone'] }}
                    </a>
                    <a href="mailto:{{ $contact['email'] }}" class="tm-contact-link">
                        <i class="fas fa-envelope tm-contact-icon"></i>{{ $contact['email'] }}
                    </a>
                    <div class="tm-contact-social">
                        <a href="https://fb.com/templatemo" class="tm-social-link"><i
                                class="fab fa-facebook tm-social-icon"></i></a>
                        <a href="#" class="tm-social-link"><i class="fab fa-twitter tm-social-icon"></i></a>
                        <a href="#" class="tm-social-link"><i class="fab fa-instagram tm-social-icon"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below
-->
    <!-- <div class="tm-container-inner-2 tm-map-section">
        <div class="row">
            <div class="col-12">
                <div class="tm-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11196.961132529668!2d-43.38581128725845!3d-23.011063013218724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bdb695cd967b7%3A0x171cdd035a6a9d84!2sAv.%20L%C3%BAcio%20Costa%20-%20Barra%20da%20Tijuca%2C%20Rio%20de%20Janeiro%20-%20RJ%2C%20Brazil!5e0!3m2!1sen!2sth!4v1568649412152!5m2!1sen!2sth"
                        frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div> -->
</main>
<script>
$(document).ready(function() {
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
});
</script>

@endsection