@extends('utama.layouts.main')

@section('main')
    <!-- Banner Section start here -->
    <section class="banner style-2">
        <div class="banner-area">
            <div class="left-side">
                <div class="section-wrapper">
                    <div class="banner-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide slide-1" style="background: url(/images/home1.png);"></div>
                            <div class="swiper-slide slide-2" style="background: url(/images/banner/bg/01.jpg);">
                            </div>
                            <div class="swiper-slide slide-3" style="background: url(/images/banner/bg/01.jpg);">
                            </div>
                        </div>
                        <div class="banner-pagination"></div>
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="banner-content">
                    <div class="section-header">
                        <span class="sub-title">Cita Rasa Nusantara di Setiap Sajian</span>
                        <h2>Hadirkan kelezatan khas Indonesia dengan berbagai pilihan menu Nusantara</h2>
                        <p>Kami menawarkan hidangan autentik yang disiapkan dengan bahan-bahan berkualitas dan bumbu
                            tradisional, memberikan pengalaman kuliner yang kaya dan berkesan untuk setiap tamu.</p>
                        <a href="#" class="banner-btn style-2"><span>Jelajahi Menu</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section ending here -->


    <!-- About Section Start here -->
    <section class="about padding-tb">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <div class="about-thumb">
                        <img src="/images/homeabout.png" alt="about-food">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-content">
                        <div class="section-header">
                            <span>Lorem Ipsum Dolor</span>
                            <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam tristique
                                sollicitudin.</h3>
                        </div>
                        <div class="section-wrapper">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam tristique
                                sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section Ending here -->

    <!-- Produk Menu Catering Section Start here -->
    <section class="product padding-tb">
        <div class="container">
            <div class="section-header">
                <h2>Paket Menu</h2>
                <p>Kami menawarkan dua pilihan utama: Paket Nasi Kotak yang praktis dan lezat, serta Prasmanan berbagai hidangan lengkap yang memanjakan selera. Sesuaikan dengan kebutuhan acara Anda!</p>
            </div>
            <div class="section-wrapper">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <a href="#">
                            <div class="product-item">
                                    <div class="product-thumb">
                                        <img src="/images/paketA.png" alt="food-product">
                                        <span class="price">70k</span>
                                    </div>
                                    <div class="product-content">
                                        <p>Prasmanan</p>
                                        <h6>Paket A</h6>
                                    </div>
                            </div>
                        </a>
                </div>
            <div class="col-xl-3 col-md-6 col-12">
                <a href="#">
                    <div class="product-item">
                            <div class="product-thumb">
                                <img src="/images/paketA.png" alt="food-product">
                                <span class="price">70k</span>
                            </div>
                            <div class="product-content">
                                <p>Prasmanan</p>
                                <h6>Paket A</h6>
                            </div>
                        </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <a href="#">
                    <div class="product-item">
                        <div class="product-thumb">
                            <img src="/images/paketA.png" alt="food-product">
                            <span class="price">70k</span>
                        </div>
                        <div class="product-content">
                            <p>Prasmanan</p>
                            <h6>Paket A</h6>
                        </div>
                    </div>
                </a>
        </div>
        <div class="col-xl-3 col-md-6 col-12">
            <a href="#">
                <div class="product-item">
                    <div class="product-thumb">
                        <img src="/images/paketA.png" alt="food-product">
                        <span class="price">70k</span>
                    </div>
                    <div class="product-content">
                        <p>Prasmanan</p>
                        <h6>Paket A</h6>
                    </div>
                </div>
            </a>
        </div>
        </div>
        <div class="text-center" style="margin-top: 40px;">
            <a href="#" class="food-btn style-2"><span>Lihat Semua</span></a>
        </div>
        </div>
        </div>
    </section>
    <!-- Food Product Section Ending here -->

    <!-- Testimonial / Review Section Start Here -->
    <section class="testimonial style-2 padding-tb">
        <div class="container">
            <div class="section-header">
                <h2>Apa kata customer?</h2>
                <p>Lihat langsung tanggapan dari pelanggan kami yang puas dengan rasa, kualitas, dan layanan katering
                    yang kami berikan.</p>
            </div>
            <div class="section-wrapper">
                <div id="demo" class="carousel slide vert">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testi-item">
                                <div class="quite-icon"><i class="icofont-quote-left"></i></div>
                                <p>Pesanan katering ini luar biasa! Makanannya lezat, porsinya pas, dan disajikan dengan
                                    rapi. Pelayanan yang cepat dan profesional membuat acara saya berjalan lancar. Saya
                                    pasti akan memesan lagi untuk acara berikutnya!</p>
                                <h6>Samuel Haritanu <span>Pembeli</span></h6>
                                <div class="rating">
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testi-item">
                                <div class="quite-icon"><i class="icofont-quote-left"></i></div>
                                <p>Extend Accurate Services Long Term High Impact Experiences Interactiv Streamline Team
                                    Compelingly Simplify Solutions Before Technicaly Sound Leadership Skills Creative
                                    Holstic Process Improvements Proactively Streamline Alternative Niche Markets Forwor
                                    Resource Conveniently cultivate pandemic technology and corporate.</p>
                                <h6>Somrat Islam <span>(UI Designer)</span></h6>
                                <div class="rating">
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testi-item">
                                <div class="quite-icon"><i class="icofont-quote-left"></i></div>
                                <p>Extend Accurate Services Long Term High Impact Experiences Interactiv Streamline Team
                                    Compelingly Simplify Solutions Before Technicaly Sound Leadership Skills Creative
                                    Holstic Process Improvements Proactively Streamline Alternative Niche Markets Forwor
                                    Resource Conveniently cultivate pandemic technology and corporate.</p>
                                <h6>Somrat Islam <span>(UI Designer)</span></h6>
                                <div class="rating">
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-indicators">
                        <div data-bs-target="#demo" data-bs-slide-to="0" class="item active">
                            <img src="/images/testi1.png" alt="">
                        </div>
                        <div data-bs-target="#demo" data-bs-slide-to="1" class="item">
                            <img src="/images/testi2.png" alt="">
                        </div>
                        <div data-bs-target="#demo" data-bs-slide-to="2" class="item">
                            <img src="/images/testi1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section Ending Here -->


    <!-- MAPS Section Start Here -->
    <section class="blog-section overflow-hidden padding-tb" style="background-color: #ffff">
        <div class="container">
            <div class="section-header">
                <h2>Temui Langsung</h2>
                <p>Kunjungi kami langsung untuk bertanya terkait menu dan pemesanan.</p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <div class="maps-section">
                        <div class="maps-area">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5093557221885!2d106.80934017453603!3d-6.583424864355263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c42b8801082d%3A0xb1ba7bcbec201660!2sJl.%20Tatapakan%20IV%20No.20%2C%20RT.01%2FRW.10%2C%20Tegal%20Gundil%2C%20Kec.%20Bogor%20Utara%2C%20Kota%20Bogor%2C%20Jawa%20Barat%2016152!5e0!3m2!1sen!2sid!4v1729892065148!5m2!1sen!2sid"
                                style="border:0" allowfullscreen></iframe>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-content">
                        <div class="section-header">
                            <h3 style="text-align: left;">Alamat</h3>
                        </div>
                        <div class="section-wrapper">
                            <p>Jl. Tatapakan IV No.20 RT.01/RW.10, Tegal Gundil, Kecamatan Bogor Utara, Kota Bogor, Jawa
                                Barat 16152</p>
                            <a href="#" class="food-btn style-2"><span>Lihat Peta</span></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="sponsor-section">
        <div class="container">
            <div class="section-wrapper">
                <h2 style="text-align: center;">Kerja Sama</h2>
                <p style="text-align: center;">Kami bangga bekerja sama dengan lembaga-lembaga terkemuka, bukti komitmen
                    kami pada layanan katering berkualitas tinggi.</p>
                <div class="sponsor-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <div class="sponsor-thumb">
                                    <a href="#"><img src="/images/mitra.png" alt="food-sopnsor"></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <div class="sponsor-thumb">
                                    <a href="#"><img src="/images/sponsor/02.png" alt="food-sopnsor"></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <div class="sponsor-thumb">
                                    <a href="#"><img src="/images/sponsor/03.png" alt="food-sopnsor"></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <div class="sponsor-thumb">
                                    <a href="#"><img src="/images/sponsor/04.png" alt="food-sopnsor"></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <div class="sponsor-thumb">
                                    <a href="#"><img src="/images/sponsor/05.png" alt="food-sopnsor"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('utama.partials.scrolltop')
@endsection
