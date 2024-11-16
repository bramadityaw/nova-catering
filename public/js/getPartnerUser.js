document.addEventListener("DOMContentLoaded", function() {
    const sponsorContainer = document.getElementById('sponsor-container');

    // Mengambil data partners menggunakan fetch API
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Untuk memeriksa struktur data yang diterima

            data.forEach(partner => {
                const swiperSlide = document.createElement('div');
                swiperSlide.classList.add('swiper-slide');

                const sponsorItem = document.createElement('div');
                sponsorItem.classList.add('sponsor-item');

                const sponsorThumb = document.createElement('div');
                sponsorThumb.classList.add('sponsor-thumb');

                const anchor = document.createElement('a');
                anchor.setAttribute('href', '#');

                const img = document.createElement('img');
                img.setAttribute('src', partner.logo); // Gunakan URL logo dari API
                img.setAttribute('alt', partner.nama);

                // Atur gaya gambar secara langsung untuk rasio 75% dan posisi tengah
                img.style.width = '65%';
                img.style.height = 'auto'; // Menjaga rasio gambar
                img.style.display = 'block'; // Mengubah display untuk pengaturan margin auto
                img.style.margin = '0 auto'; // Memastikan gambar berada di tengah

                // Menyusun elemen
                anchor.appendChild(img);
                sponsorThumb.appendChild(anchor);
                sponsorItem.appendChild(sponsorThumb);
                swiperSlide.appendChild(sponsorItem);
                sponsorContainer.appendChild(swiperSlide);
            });

            // Pengaturan Swiper
            const swiperOptions = {
                loop: data.length > 1, 
                slidesPerView: 1,
                spaceBetween: 20,
                autoplay: data.length > 1 ? { delay: 3000 } : false,
            };
            new Swiper('.sponsor-slider', swiperOptions);
        })
        .catch(error => {
            console.error('Error fetching partner data:', error);
        });
});
