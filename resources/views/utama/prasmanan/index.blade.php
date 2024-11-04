
@extends('utama.layouts.main')

@section('main')

    <!-- Page Header Section Start Here -->
    <section class="page-header style-2">
        <div class="container">
            <div class="page-title text-center">
                <h3 style="color:#F136DB;">Menu Prasmanan</h3>
                <ul class="breadcrumb">
                    <li><a href="/">Beranda</a></li>
                    <li>Prasmanan</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->

    <!-- Food Product Section Style 2 Start here -->
    <section class="menu padding-tb">
        <div class="container">
            <div class="section-header" style="margin-bottom: 80px;">
                <h3>Menu Prasmanan Indonesia</h3>
                <p>Completely network impactful users whereas next-generation applications engage out thinking via
                    tactical action.</p>
            </div>
            <div class="menu-prasmanan">
                <div class="menu-card">
                    <a href="detail-prasmanan.html">
                        <div class="menu-image">
                            <img src="assets/images/paketA.png" alt="Prasmanan A">
                        </div>
                        <h3>Prasmanan A</h3>
                        <p>Paket Sederhana</p>
                        <p>Menu simpel dengan hidangan khas Nusantara seperti rendang, ayam semur manis, dan sup mutiar
                        </p>
                        <p class="price">Rp65.000</p>
                    </a>
                </div>

                <div class="menu-card">
                    <a href="#">
                        <div class="menu-image">
                            <img src="assets/images/paketB.png" alt="Prasmanan B">
                        </div>
                        <h3>Prasmanan B</h3>
                        <p>Paket Serundeng</p>
                        <p>Menampilkan pilihan ayam serundeng dan ikan dengan berbagai varian sambal serta sayur khas
                            tradisional</p>
                        <p class="price">Rp65.000</p>
                    </a>
                </div>

                <div class="menu-card">
                    <a href="#">
                        <div class="menu-image">
                            <img src="assets/images/paketD.png" alt="Prasmanan C">
                        </div>
                        <h3>Prasmanan C</h3>
                        <p>Paket Empal</p>
                        <p>Paket lengkap dengan empal, ikan bumbu rica, dan kerupuk sebagai pelengkap tradisional</p>
                        <p class="price">Rp70.000</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Food Product Section Style 2 Ending here -->

    @include('utama.partials.scrolltop')
@endsection
