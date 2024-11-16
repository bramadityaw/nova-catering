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
                        style="color:#F136DB"> Kami </span></h5>
                <form id="reviewForm">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3 mt-3">
                                <input type="text" id="reviewer_name" placeholder="Nama Anda" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 mt-3">
                                <input type="text" id="reviewer_job" placeholder="Pekerjaan Anda" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- Star Rating -->
                    <div class="mb-3">
                        <label for="star-rating" class="form-label">Rating</label>
                        <div id="star-rating" class="star-rating">
                            <i class="star icofont-star" data-value="1"></i>
                            <i class="star icofont-star" data-value="2"></i>
                            <i class="star icofont-star" data-value="3"></i>
                            <i class="star icofont-star" data-value="4"></i>
                            <i class="star icofont-star" data-value="5"></i>
                        </div>
                        <input type="hidden" id="rating" name="rating" value="0"> <!-- Hidden input to store selected rating -->
                    </div>

                    <div class="mb-3">
                        <textarea id="review_content" placeholder="Ulasan Anda" class="form-control" rows="5" required></textarea>
                    </div>
                    <!-- hCaptcha -->
                    <div class="mb-3">
                        <div class="h-captcha" data-sitekey="e40c9c28-0548-47e8-8ae4-1cc627603274"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="banner-btn style-2" onclick="submitReview()">Kirim Ulasan</button>
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
                <li><a href="{{ url('/') }}">Beranda</a></li>
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
        <div class="ulasan" id="reviews-container">
            <!-- Reviews will be dynamically injected here -->
        </div>
    </div>
</section>


<script src="https://js.hcaptcha.com/1/api.js?hl=id" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>   const apiUrl = "{{ url('/api/review') }}"; // Ganti dengan rute API sesuai dengan kebutuhan
</script>
<script src="{{ asset('js/ulasanUserHandler.js') }}"></script>

</script>





@endsection