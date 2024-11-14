function submitReview() {
    // Mendapatkan token hCaptcha
    var hcaptchaToken = hcaptcha.getResponse(); // Menggunakan hcaptcha.getResponse() untuk hCaptcha

    // Mengecek apakah token sudah diambil
    if (!hcaptchaToken) {
        Swal.fire({
            icon: 'error',
            title: 'Harap verifikasi hCaptcha',
            text: 'Pastikan Anda telah mengisi hCaptcha dengan benar.'
        });
        return;
    }

    // Mengambil data ulasan dari form
    var reviewerName = document.getElementById('reviewer_name').value;
    var reviewerJob = document.getElementById('reviewer_job').value; // Menambahkan job
    var content = document.getElementById('review_content').value;
    var rating = document.getElementById('rating').value; // Menangkap rating yang dipilih

    // Mengecek apakah input ulasan sudah diisi
    if (!reviewerName || !content || !reviewerJob || !rating) { // Pastikan rating juga terisi
        Swal.fire({
            icon: 'warning',
            title: 'Input tidak lengkap',
            text: 'Harap isi nama reviewer, pekerjaan, konten ulasan, dan rating'
        });
        return;
    }

    // Menampilkan loading spinner
    Swal.fire({
        title: 'Mengirim ulasan...',
        html: 'Tunggu sebentar...',
        didOpen: () => {
            Swal.showLoading(); // Menampilkan spinner loading
        }
    });

    // Membuat objek data untuk dikirim
    var reviewData = {
        reviewer_name: reviewerName,
        job: reviewerJob, // Menambahkan job ke data
        content: content,
        rating: parseInt(rating), // Mengirim rating dalam bentuk integer
        public: true, // Anda bisa menyesuaikan nilai ini berdasarkan kebutuhan
        hcaptcha_token: hcaptchaToken
    };

    // Mengirimkan data menggunakan fetch API
    fetch(apiUrl, {
            method: 'POST', // Metode HTTP yang digunakan
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(reviewData) // Mengubah objek menjadi JSON
        })
        .then(response => response.json())
        .then(data => {
            // Menyembunyikan loading spinner
            Swal.close();

            // Memeriksa jika sukses
            if (data.success) {
                // Menampilkan SweetAlert untuk sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Ulasan berhasil dikirim!',
                    text: `Terima kasih, ulasan oleh ${data.message.split(' ')[2]} telah berhasil disimpan.`
                }).then(() => {
                    // Menambahkan delay sebelum refresh halaman (1,5 detik)
                    setTimeout(function() {
                        location.reload(); // Refresh halaman setelah 1,5 detik
                    }, 1500);
                });

                // Reset form dan hCaptcha
                document.getElementById('reviewer_name').value = '';
                document.getElementById('reviewer_job').value = ''; // Reset job
                document.getElementById('review_content').value = '';
                document.getElementById('rating').value = '0'; // Reset rating
                hcaptcha.reset(); // Reset hCaptcha

                // Menutup modal setelah ulasan berhasil dikirim
                var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                modal.hide(); // Menutup modal
            } else {
                // Menampilkan SweetAlert untuk error
                let errorMessage = '';

                // Menyesuaikan pesan error berdasarkan respons dari server
                if (data.message === 'hCaptcha verification failed') {
                    errorMessage = 'Verifikasi hCaptcha gagal. Harap pastikan Anda telah menyelesaikan hCaptcha dengan benar.';
                } else if (data.message === 'Internal server error') {
                    errorMessage = 'Terjadi kesalahan internal saat mengirim ulasan. Silakan coba lagi nanti.';
                } else {
                    errorMessage = 'Terjadi kesalahan saat mengirim ulasan. Silakan coba lagi.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengirim ulasan',
                    text: errorMessage
                });
            }
        })
        .catch(error => {
            // Menyembunyikan loading spinner
            Swal.close();
            // Menampilkan SweetAlert untuk error jaringan
            Swal.fire({
                icon: 'error',
                title: 'Gagal mengirim ulasan',
                text: 'Terjadi kesalahan jaringan. Silakan coba lagi.'
            });
        });
}



document.addEventListener('DOMContentLoaded', function() {
    // Fetch reviews from the API
    fetch('/api/reviews') // Replace with your actual API endpoint
        .then(response => response.json())
        .then(data => {
            displayReviews(data);
        })
        .catch(error => {
            console.error('Error fetching reviews:', error);
        });
});

function displayReviews(reviews) {
    const ulasanContainer = document.querySelector('.ulasan'); // The container for reviews

    // Clear any existing reviews
    ulasanContainer.innerHTML = '';

    // Loop through the reviews and create a card for each
    reviews.forEach(review => {
        const reviewCard = document.createElement('div');
        reviewCard.classList.add('ulasan-card');

        // Construct the HTML for each review
        reviewCard.innerHTML = `
    <div class="testi-item">
        <div class="quite-icon"><i class="icofont-quote-left"></i></div>
        <div class="ulasan-content">
            <p>${review.content}</p>
        </div>
        <h6>${review.reviewer_name} <span>${review.job}</span></h6>
        <div class="rating">
            ${generateStars(review.rating)} <!-- Display stars based on the rating -->
        </div>
    </div>
`;

        // Append the card to the container
        ulasanContainer.appendChild(reviewCard);

        // Add scroll event listener to the content
        const ulasanContent = reviewCard.querySelector('.ulasan-content');

        // Initially, add the scrollable class to show the gradient by default
        ulasanContent.classList.add('scrollable');

        // Check if the content is scrollable
        ulasanContent.addEventListener('scroll', function() {
            if (ulasanContent.scrollTop === 0) {
                // If at the top, show gradient
                ulasanContent.classList.add('scrollable');
            } else {
                // If scrolled down, remove gradient
                ulasanContent.classList.remove('scrollable');
            }
        });
    });
}

function generateStars(rating) {
    let starsHtml = '';
    // Generate stars based on the rating (rating is an integer between 1 and 5)
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            starsHtml += '<i class="icofont-star"></i>'; // Filled star
        } else {
            starsHtml += '<i class="icofont-star-alt"></i>'; // Empty star
        }
    }
    return starsHtml;
}




document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        // Hover effect
        star.addEventListener('mouseover', function() {
            const value = parseInt(star.getAttribute('data-value'));
            setHoverState(value);
        });

        // Reset hover effect on mouseout
        star.addEventListener('mouseout', function() {
            const value = parseInt(ratingInput.value);
            setHoverState(value); // Reset to the selected rating
        });

        // Click to select rating
        star.addEventListener('click', function() {
            const value = parseInt(star.getAttribute('data-value'));
            ratingInput.value = value; // Store the rating in the hidden input
            setSelectedState(value); // Set the selected stars
        });
    });

    // Function to set the hover state
    function setHoverState(value) {
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-value'));
            if (starValue <= value) {
                star.classList.add('hover');
            } else {
                star.classList.remove('hover');
            }
        });
    }

    // Function to set the selected state
    function setSelectedState(value) {
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-value'));
            if (starValue <= value) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }
});