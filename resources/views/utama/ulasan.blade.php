
@extends('utama.layouts.main')

@section('main')
    <!-- CTA ulasan -->
    <a href="#exampleModal" class="float" target="_blank" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="icofont-plus"></i>
    </a>
    <!-- AKHIR CTA ulasan -->

    <!-- modal ulasan -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLabel">Tulis Ulasan Anda Tentang <span
                            style="color:#F136DB"> Kami </span></span></h5>
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 mt-3">
                            <input type="text" placeholder="Nama Anda" class="form-control" required>
                        </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 mt-3">
                            <input type="text" placeholder="Pekerjaan Anda" class="form-control" required>
                        </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea placeholder="Ulasan Anda" class="form-control" rows="5" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="banner-btn style-2">Kirim Ulasan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir modal ulasan -->
    <!-- Page Header Section Start Here -->
    <section class="page-header style-2">
        <div class="container">
            <div class="page-title text-center">
                <h3 style="color:#F136DB;">Ulasan</h3>
                <ul class="breadcrumb">
                    <li><a href="beranda.html">Beranda</a></li>
                    <li>Ulasan</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->

    <!-- Ulasan Section Start Here -->
    <section class="testimonial style-2 padding-tb">
        <div class="container">
            <div class="section-header" style="margin-bottom: 80px;">
                <h3>Apa Kata Customer?</h3>
                <p>Lihat langsung tanggapan dari pelanggan kami yang puas dengan rasa, kualitas, dan layanan katering
                    yang kami berikan.</p>
            </div>
            <div class="ulasan">
                <div class="ulasan-card">
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
                <div class="ulasan-card">
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
                <div class="ulasan-card">
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
                <div class="ulasan-card">
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
                <div class="ulasan-card">
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
                <div class="ulasan-card">
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
            </div>
        </div>
    </section>

@endsection

