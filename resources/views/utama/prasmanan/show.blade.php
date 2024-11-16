@extends('utama.layouts.main')

@section('main')

<!-- Page Header Section Start Here -->
<section class="page-header style-2">
    <div class="container">
        <div class="page-title text-center">
            <h3 style="color: #F136DB;">Prasmanan Detail</h3>
            <ul class="breadcrumb">
                <li><a href="/">Beranda</a></li>
                <li>Prasmanan</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- Page Header Section Ending Here -->

<!-- Detail Menu Section Start Here -->
<section class="contact-information padding-tb pb-xl-5 mb-xl-5">
    <div class="container">
        <div class="section-wrapper">
            <div class="row">
                <!-- Konten yang diisi oleh JavaScript akan muncul di sini -->
            </div>
        </div>
    </div>
</section>
<!-- Detail Menu Section Ending Here -->

@include('utama.partials.scrolltop')

<!-- Footer Section Ending Here -->

<!-- scrollToTop start here -->
<a href="#" class="scrollToTop"><i class="icofont-swoosh-up"></i></a>
<!-- scrollToTop ending here -->

<script src="assets/js/jquery.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/swiper.min.js"></script>
<script src="assets/js/lightcase.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/functions.js"></script>

<script>
    $(document).ready(function() {
        $('a[data-rel^=lightcase]').lightcase({
            transition: 'elastic',
            swipe: true,
            maxWidth: 800,
            maxHeight: 600,
            slideshow: true,
            showTitle: true,
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', async function() {
        // Function to get ID from URL parameter
        function getIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('id');
        }

        // Get the ID from the URL
        const paketId = getIdFromUrl();

        // Check if ID is present
        if (!paketId) {
            console.error('No ID found in URL');
            return;
        }

        // API endpoint
        const apiUrl = `/api/pakets/${paketId}`;

        try {
            // Fetch package details
            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            // Parse JSON response
            const paketData = await response.json();

            // Check if paket data is returned
            if (!paketData || !paketData.data) {
                console.error('No data found for the specified ID');
                return;
            }

            const paket = paketData.data;

            // Select the container for the detail section
            const detailContainer = document.querySelector('.contact-information .section-wrapper .row');

            // Format harga
            const formattedPrice = `Rp${new Intl.NumberFormat('id-ID').format(paket.harga)}`;

            // Set up HTML content for the package details
            detailContainer.innerHTML = `
            <div class="col-lg-6 col-12">
                <h5>${paket.nama}</h5>
                <h6>${formattedPrice}</h6>
                <p>${paket.deskripsi}</p>
                <div class="image-row">
                    <div class="image-placeholder">
                        <a href="${paket.foto}" data-rel="lightcase:gallery">
                            <img src="${paket.foto}" alt="${paket.nama}" class="img-fill-crop">
                        </a>
                    </div>
                </div>
                <h5>Isi Menu</h5>
                <ul>
                    ${paket.items.map(item => `<li style="list-style: disc; margin-left:16px;">${item.nama}</li>`).join('')}
                </ul>
            </div>
            <div class="col-lg-6 col-12">
                <h5>Pesan Paket Ini</h5>
                <form id="orderForm" class="d-flex flex-wrap justify-content-between">
                    <input type="text" id="namaInput" placeholder="Nama Anda" required>
                    <input type="date" id="tanggalInput" placeholder="Tanggal" required>
                    <textarea id="pesanInput" placeholder="Pesan Anda" rows="5" required></textarea>
                    <button type="submit" class="banner-btn style-2">Pesan Sekarang</button>
                </form>
            </div>
        `;

            // Add submit event listener to the form
            // Add submit event listener to the form
            document.getElementById('orderForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form from submitting traditionally

                // Get user input values
                const nama = document.getElementById('namaInput').value;
                const tanggalPesanan = document.getElementById('tanggalInput').value;
                const pesan = document.getElementById('pesanInput').value;

                // Format the WhatsApp message template
                const whatsappMessage =
                    `Assalamualaikum, Saya ${nama}.\n\n` +
                    `Saya ingin memesan:\n` +
                    `*Nama Paket: ${paket.nama}*\n` +
                    `*Untuk tanggal: ${tanggalPesanan}*\n` +
                    `----------------------\n` +
                    `Pesan: ${pesan}`;

                // WhatsApp API URL with the target phone number and encoded message
                const whatsappUrl = `https://wa.me/6285173079533?text=${encodeURIComponent(whatsappMessage)}`;

                // Open WhatsApp chat with the formatted message
                window.open(whatsappUrl, '_blank');
            });

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    });
</script>
@endsection