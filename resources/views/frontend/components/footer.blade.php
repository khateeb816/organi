<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('frontendAssets/img/logo.png') }}" alt=""></a>
                    </div>
                    <ul>
                        <li>Address: 60-49 Road 11378 New York</li>
                        <li>Phone: +65 11.188.888</li>
                        <li>Email: support@prime.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1 mt-5">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/shop') }}">Shop</a></li>
                        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mt-5">
                <div class="footer__widget">
                    <h6>Join Our community Now</h6>
                    <p>Get our community to get awsome updates.</p>

                    <div class="footer__widget__social">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('frontendAssets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('frontendAssets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontendAssets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('frontendAssets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontendAssets/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('frontendAssets/js/mixitup.min.js') }}"></script>
<script src="{{ asset('frontendAssets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontendAssets/js/main.js') }}"></script>
</body>

</html>