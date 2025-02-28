@extends('utama.layouts.main')

@section('main')

    <!-- Page Header Section Start Here -->
    <section class="page-header style-2">
        <div class="container">
            <div class="page-title text-center">
                <h3 style="color:#F136DB;">Menu Nasi Kotak</h3>
                <ul class="breadcrumb">
                    <li><a href="/">Beranda</a></li>
                    <li>Nasi Kotak</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->

    <!-- Food Product Section Style 2 Start here -->
    <section class="menu padding-tb" style="background-image: url('/images/background1.png'); background-repeat: no-repeat; background-position: center; background-size: cover;">        <div class="container">
            <div class="section-header" style="margin-bottom: 80px;">
                <h3>Menu Prasmanan Indonesia</h3>
                <p>Disediakan untuk acara besar anda, kami siap memasaknya untuk anda.</p>
            </div>
            <div class="menu-prasmanan">
            </div>
        </div>
    </section>
    <!-- Fod Product Section Style 2 Ending here -->
    @include('utama.partials.scrolltop')


    <script>
document.addEventListener('DOMContentLoaded', function () {
    const apiUrl = '/api/paket/kategori/prasmanan'; // Endpoint API

    async function fetchNasiKotakData() {
        try {
            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            // Parse the response as JSON
            const result = await response.json();

            // Select the container where you want to add the menu cards
            const menuContainer = document.querySelector('.menu-prasmanan');

            // Clear the container
            menuContainer.innerHTML = '';

            // Check if data is present and create HTML structure for each item
            result.forEach(paket => {
                const menuCard = document.createElement('div');
                menuCard.classList.add('menu-card');

                // Format harga menggunakan titik setiap ribuan
                const formattedPrice = `Rp${new Intl.NumberFormat('id-ID').format(paket.harga)}`;

                // Set up the inner HTML for each menu card with a click event to send the ID
                menuCard.innerHTML = `
                    <a href="#" data-id="${paket.id_origin}" class="menu-link">
                        <div class="menu-image">
                            <img src="${paket.foto}" alt="${paket.nama}">
                        </div>
                        <h3>${paket.nama}</h3>
                        <p>${paket.kategori.replace(/_/g, ' ').replace(/\b\w/g, letter => letter.toUpperCase())}</p>
                        <p>${paket.deskripsi}</p>
                        <p class="price" style="color:F136DB;">${formattedPrice}</p>
                    </a>
                `;

                // Append each menu card to the container
                menuContainer.appendChild(menuCard);
            });

            // Add click event to each link to redirect with the id_origin as a URL parameter
            document.querySelectorAll('.menu-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const idOrigin = this.getAttribute('data-id');
                    window.location.href = `/prasmanan/detail?id=${idOrigin}`;
                });
            });
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    // Fetch and display the nasi kotak data
    fetchNasiKotakData();
});



    </script>
@endsection
