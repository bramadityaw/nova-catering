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
                        <div class="swiper-slide slide-2" style="background: url(/images/home2.jpeg);">
                        </div>
                        <div class="swiper-slide slide-3" style="background: url(/images/home3.png);">
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
            <p>Kami menawarkan dua pilihan utama: Paket Nasi Kotak yang praktis dan lezat, serta Prasmanan dengan berbagai hidangan lengkap yang memanjakan selera. Sesuaikan dengan kebutuhan acara Anda!</p>
        </div>
        <div class="section-wrapper">
            <div class="row">
            </div>
        </div>
        <div class="text-center" style="margin-top: 40px;">
            <a href="/nasikotak" class="food-btn style-2"><span>Lihat Semua</span></a>
        </div>
    </div>
</section>

<!-- Testimonial / Review Section Start Here -->
<!-- Testimonial / Review Section Start Here -->
<section class="testimonial style-2 padding-tb">
    <div class="container">
        <div class="section-header">
            <h2>Apa kata customer?</h2>
            <p>Lihat langsung tanggapan dari pelanggan kami yang puas dengan rasa, kualitas, dan layanan katering yang kami berikan.</p>
        </div>
        <div class="section-wrapper">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper" id="testimonial-container">
                    <!-- Testimonial items will be injected here by JavaScript -->
                </div>
                <!-- Swiper navigation buttons -->
                <div class="swiper-button-next" style="color: #F136DB;"></div>
                <div class="swiper-button-prev" style="color: #F136DB;"></div>
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
                        <a href="https://www.google.com/maps/place/Jl.+Tatapakan+IV+No.20,+RT.01%2FRW.10,+Tegal+Gundil,+Kec.+Bogor+Utara,+Kota+Bogor,+Jawa+Barat+16152/@-6.5834302,106.8119151,17z/data=!4m6!3m5!1s0x2e69c42b8801082d:0xb1ba7bcbec201660!8m2!3d-6.5834302!4d106.8119151!16s%2Fg%2F11kzjmjl5b?entry=ttu&g_ep=EgoyMDI0MTEwNi4wIKXMDSoASAFQAw%3D%3D" class="food-btn style-2"><span>Lihat Peta</span></a>
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
            <p style="text-align: center;">Kami bangga bekerja sama dengan lembaga-lembaga terkemuka, bukti komitmen kami pada layanan katering berkualitas tinggi.</p>
            <div class="sponsor-slider">
                <div class="swiper-wrapper" id="sponsor-container">
                    <!-- Konten sponsor akan dimuat melalui JS -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const apiUrl = "{{ url('/api/partners') }}"; // Ini akan menghasilkan URL penuh dari API Laravel
</script>
<script src="{{ asset('js/getPartnerUser.js') }}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nextButton = document.querySelector('.swiper-button-next');
        const prevButton = document.querySelector('.swiper-button-prev');

        let inactivityTimer;

        function setArrowInactive() {
            nextButton.classList.add('inactive');
            prevButton.classList.add('inactive');
        }

        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            nextButton.classList.remove('inactive');
            prevButton.classList.remove('inactive');

            // Restart the timer
            inactivityTimer = setTimeout(setArrowInactive, 5000); // 5 seconds
        }

        // Add event listeners to reset the inactivity timer on any user interaction
        nextButton.addEventListener('mouseenter', resetInactivityTimer);
        prevButton.addEventListener('mouseenter', resetInactivityTimer);

        // Set initial inactivity timer
        inactivityTimer = setTimeout(setArrowInactive, 5000); // 5 seconds
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Fetch reviews from the API
        fetch('/api/reviews') // Replace with your actual API endpoint
            .then(response => response.json())
            .then(data => {
                const latestReviews = data.slice(0, 3); // Take only the latest 3 reviews
                displayReviews(latestReviews);

                // Initialize Swiper after reviews have been loaded
                new Swiper('.swiper-container', {
                    loop: true, // Enable continuous loop mode
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    autoplay: {
                        delay: 5000, // Delay between slides (5 seconds)
                        disableOnInteraction: false, // Keep autoplay after user interaction
                    },
                });
            })
            .catch(error => {
                console.error('Error fetching reviews:', error);
            });
    });

    function displayReviews(reviews) {
        const ulasanContainer = document.getElementById('testimonial-container');

        if (!ulasanContainer) {
            console.error('ulasanContainer is not found');
            return;
        }

        ulasanContainer.innerHTML = ''; // Clear any existing content

        reviews.forEach(review => {
            const reviewSlide = document.createElement('div');
            reviewSlide.classList.add('swiper-slide'); // Swiper slide class

            reviewSlide.innerHTML = `
            <div class="testi-item">
                <div class="quite-icon"><i class="icofont-quote-left"></i></div>
                <div class="ulasan-content">
                    <p>${review.content}</p>
                </div>
                <h6>${review.reviewer_name} <span>${review.job}</span></h6>
                <div class="rating">
                    ${generateStars(review.rating)}
                </div>
            </div>
        `;

            ulasanContainer.appendChild(reviewSlide);
        });
    }

    function generateStars(rating) {
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            starsHtml += i <= rating ?
                '<i class="icofont-star"></i>' // Filled star
                :
                '<i class="icofont-star-alt"></i>'; // Empty star
        }
        return starsHtml;
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Replace with the actual API URL
        const apiUrl = '/api/paket/naskot/limited'; // Assuming you're on the same domain as your backend

        // Function to format the category name
        function formatCategoryName(kategori) {
            return kategori
                .split('_') // Split by underscore
                .map(word => word.charAt(0).toUpperCase() + word.slice(1)) // Capitalize each word
                .join(' '); // Join with spaces
        }

        // Function to format the price
        function formatPrice(price) {
            if (price >= 1000000) {
                return `${(price / 1000).toFixed(0)}k`; // Format for 1,000,000 and above
            } else if (price >= 1000) {
                return `${(price / 1000).toFixed(0)}k`; // Format for 1,000 and above
            }
            return price; // Leave as-is if below 1,000
        }

        // Function to fetch the limited nasi_kotak data
        async function fetchLimitedNasiKotak() {
            try {
                // Make a GET request to the API
                const response = await fetch(apiUrl, {
                    method: 'GET', // Explicitly set the method to GET
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                // Parse the response as JSON
                const result = await response.json();

                // Check if the response is successful
                if (result.message === 'Successfully retrieved 4 nasi_kotak items') {
                    const data = result.data;
                    const productsContainer = document.querySelector('.section-wrapper .row');

                    // Clear the existing products
                    productsContainer.innerHTML = '';

                    // Loop through each product and create HTML dynamically
                    data.forEach(paket => {
                        const productItem = document.createElement('div');
                        productItem.classList.add('col-xl-3', 'col-md-6', 'col-12');

                        const productImage = document.createElement('img');
                        productImage.src = paket.foto;
                        productImage.alt = 'food-product';

                        // Apply image styles for fill and crop
                        productImage.style.width = '100%';
                        productImage.style.height = '100%';
                        productImage.style.objectFit = 'cover'; // Ensures the image covers the container and crops excess
                        productImage.style.objectPosition = 'center'; // Ensures the image is centered within the container

                        productItem.innerHTML = `
                        <a href="#">
                            <div class="product-item">
                                <div class="product-thumb">
                                    ${productImage.outerHTML}
                                    <span class="price">${formatPrice(paket.harga)}</span>
                                </div>
                                <div class="product-content">
                                    <p>${formatCategoryName(paket.kategori)}</p>
                                    <h6>${paket.nama}</h6>
                                </div>
                            
                            </a>    
                        </div>
                        
                    `;

                        // Append the new product to the container
                        productsContainer.appendChild(productItem);
                    });
                } else {
                    console.error('Failed to fetch nasi kotak items:', result.message);
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Call the function to fetch and display the limited nasi kotak data
        fetchLimitedNasiKotak();
    });
</script>




@include('utama.partials.scrolltop')
@endsection