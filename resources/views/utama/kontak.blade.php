@extends('utama.layouts.main')
@section('main')
    <!-- Page Header Section Start Here -->
    <section class="page-header style-2">
        <div class="container">
            <div class="page-title text-center">
                <h3 style="color: #F136DB;">Kontak</h3>
                <ul class="breadcrumb">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li>Kontak</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->


    <!-- Contact Us Section Start Here -->
    <section class="contact-information padding-tb pb-xl-0">
        <div class="container">
            <div class="section-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h5 style="margin-bottom: 35px;">Informasi Kontak</h5>
                        <div class="post-item">
                            <div class="post-thumb">
                                <img src="" alt="contact">
                            </div>
                            <div class="post-content">
                                <h6>Alamat Katering</h6>
                                <p>Jl. Tatapakan IV No.20 RT.01/RW.10, Tegal Gundil, Kecamatan Bogor Utara, Kota Bogor,
                                    Jawa Barat 16152</p>
                            </div>
                        </div>
                        <div class="post-item">
                            <div class="post-thumb">
                                <img src="" alt="contact">
                            </div>
                            <div class="post-content">
                                <h6>Nomor Handphone</h6>
                                <p>+62 856-9569-0555</p>
                            </div>
                        </div>
                        <div class="post-item">
                            <div class="post-thumb">
                                <img src="" alt="contact">
                            </div>
                            <div class="post-content">
                                <h6>Email</h6>
                                <p>loremipsum@dolor.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <h5>Kirim Pesan ke Kami</h5>
                        <form action="#" method="POST" class="d-flex flex-wrap justify-content-between">
                            <input type="text" placeholder="Nama Anda" required>
                            <input type="text" placeholder="Subjek/Pertanyaan" required>
                            <textarea placeholder="Pesan Anda" rows="5" required></textarea>
                            <button type="submit" class="banner-btn style-2">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us Section Ending Here -->


    <!-- G-Map Section Start Here -->
    <div class="gmaps-section">
        <div class="map-area">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5093557221885!2d106.80934017453603!3d-6.583424864355263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c42b8801082d%3A0xb1ba7bcbec201660!2sJl.%20Tatapakan%20IV%20No.20%2C%20RT.01%2FRW.10%2C%20Tegal%20Gundil%2C%20Kec.%20Bogor%20Utara%2C%20Kota%20Bogor%2C%20Jawa%20Barat%2016152!5e0!3m2!1sen!2sid!4v1729892065148!5m2!1sen!2sid"
                style="border:0" allowfullscreen></iframe>

        </div>
    </div>
    <!-- G-Map Section Ending Here -->
    @include('utama.partials.scrolltop')
@endsection
