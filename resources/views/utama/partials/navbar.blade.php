<!-- Mobile Menu Start Here -->
<div class="mobile-menu">
    <nav class="mobile-header d-xl-none">
        <div class="header-logo">
            <img src="/images/logonova.png" alt="logo">
        </div>
        <div class="header-bar">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <nav class="menu">
        <div class="mobile-menu-area d-xl-none">
            <div class="mobile-menu-area-inner" id="scrollbar">
                <ul>
                    <li><a class="active" href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('nasikotak') }}">Nasi Kotak</a></li>
                    <li><a href="{{ url('prasmanan') }}">Prasmanan</a></li>
                    <li><a href="{{ url('ulasan') }}">Ulasan</a></li>
                    <li><a href="{{ url('kontak') }}">Kontak</a></li>
                    <li>
                        <a href="#" target="_blank">
                            <button
                                style="background-color: #471471; color: white; padding: 10px; border: none; border-radius: 5px;">
                                WhatsApp Us
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- Mobile Menu Ending Here -->

<!-- header / navbar section start -->
<header class="header-section header-2 d-xl-block d-none">
    <div class="container">
        <div class="header-area">
            <div class="logo">
                <img src="/images/logonova.png" alt="logo">
            </div>
            <div class="main-menu">
                <ul>
                    <li><a {!! $_SERVER["REQUEST_URI"]==='/' ? 'class="active"' : '' !!} href="/">Beranda</a></li>
                    <li><a {!! $_SERVER["REQUEST_URI"]==='/nasikotak' ? 'class="active"' : '' !!} href="/nasikotak">Nasi Kotak</a></li>
                    <li><a {!! $_SERVER["REQUEST_URI"]==='/prasmanan' ? 'class="active"' : '' !!} href="/prasmanan">Prasmanan</a></li>
                    <li><a {!! $_SERVER["REQUEST_URI"]==='/ulasan' ? 'class="active"' : '' !!} href="/ulasan">Ulasan</a></li>
                    <li><a {!! $_SERVER["REQUEST_URI"]==='/kontak' ? 'class="active"' : '' !!} href="/kontak">Kontak</a></li>
                </ul>
            </div>
            <div class="button-container">
                <a href="https://wa.me/6285173079533" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i> Hubungi Kami
                </a>

            </div>
        </div>
    </div>
</header>
<!-- header section ending -->