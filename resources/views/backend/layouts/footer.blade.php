<footer class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
    <div class="footer-copyright">
        <div class="container"><span>&copy; 2020<a href="http://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT</a> All rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a href="https://pixinvent.com/">PIXINVENT</a></span></div>
    </div>
</footer>
<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins.js') }}"></script>
<script src="{{ asset('backend/js/search.js') }}"></script>
<script src="{{ asset('backend/custom/custom-script.js') }}"></script>
<script src="{{ asset('backend/scripts/customizer.js') }}"></script>
<script src="{{ asset('backend/js/kendineyazilimci.js') }}"></script>
<script src="/toastr/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@yield('js')
@toastr_render