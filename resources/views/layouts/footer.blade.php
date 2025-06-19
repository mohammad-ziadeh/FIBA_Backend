<section class="mainBody" style="margin-top: 20px">
    <br>
    <br>
    <footer class="footer">
        <div class="footer-content">

            <div class="footer-section">
                <h4 style="font-size: x-large; font-style: normal;">Navigate</h4>
                <ul>
                        <li><a style="text-decoration: none;" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a style="text-decoration: none;" href="{{ route('profile.edit') }}">Home</a></li>
                        <li><a style="text-decoration: none;" href="/spinner">Spinner</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <li><a style="text-decoration: none;" :href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a></li>
                        </form>

                </ul>
            </div>

            <div class="footer-section">
                <h4 style="font-size: x-large; font-style: normal;">Links</h4>
                <ul>
                        {{-- <li><a href="{{ route('users.index') }}">******</a></li> --}}
                        <li><a style="text-decoration: none;" href="">******</a></li>
                        <li><a style="text-decoration: none;" href="">******</a></li>
                        <li><a style="text-decoration: none;" href="">******</a></li>

                </ul>
            </div>

            <div class="footer-section">
                <h4 style="font-size: x-large; font-style: normal;">Support</h4>
                <ul>
                    <li><a style="text-decoration: none;" href="https://orange.jo/en/corporate/about-us" target="_blank">Terms and Conditions</a></li>
                    <li><a style="text-decoration: none;" href="https://orange.jo/en/pages/legal" target="_blank">Privacy Policy</a></li>
                    <li>
                        <a style="text-decoration: none;" href="https://wa.me/+962791318735" target="_blank" class="whatsapp-button">
                            Contact US &nbsp; <i class="fa-brands fa-whatsapp" style="font-size: large"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="social-media">
            <a href="https://www.facebook.com/OrangeJordan/" class="fac" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/OrangeJordan" class="X" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://orange.jo/en" target="_blank"><i class="fab fa-google"></i></a>
            <a href="https://www.instagram.com/orangejo" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com/company/orange-jordan" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </footer>

    <div class="copyright">
        &copy; 2025 Copyright: <a href="#">FIBA</a>
    </div>
</section>
