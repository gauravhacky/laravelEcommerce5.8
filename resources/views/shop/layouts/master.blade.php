@include('shop.layouts.header')
@yield('content')
<body>
<!-- End copyright  -->
    @include('shop.layouts.footer')
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="{{asset('front_assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('front_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('front_assets/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('front_assets/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('front_assets/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('front_assets/js/inewsticker.js')}}"></script>
    <script src="{{asset('front_assets/js/bootsnav.js')}}"></script>
    <script src="{{asset('front_assets/js/images-loded.min.js')}}"></script>
    <script src="{{asset('front_assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('front_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front_assets/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('front_assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('front_assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('front_assets/js/custom.js')}}"></script>
    @yield('js')
</body>

</html>