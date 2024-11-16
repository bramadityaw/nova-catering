@extends('admin.layouts.main')

@section('main')
<!-- CONTENT -->
<section id="content">
    <nav>
        <i class="bx bx-menu"></i>
        <h3 class="profile">Welcome, <span id="admin_name"></span></h3>
    </nav>
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Nasi Kotak List</h1>
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="/dashboard" style="color: blue;">Dashboard</a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li>
                        <a class="active" href="#" style="cursor: default;">Nasi Kotak</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="button_postingan">
            <a href="/admin/edit/naskot" id="addResepLink"><button><i class="bx bx-plus" id="add_artikel"></i>Tambah</button></a>
        </div>



        <ul class="box-info">
            <li>
                <i class="bx bxs-bowl-rice" style="color: #FF9500; background:#FFD69D;"></i>
                <span class="text">
                    <h3 id="totalNaskot">0</h3>
                    <p>Jumlah Nasi Kotak</p>
                </span>
            </li>
        </ul>

        <section class="article-container">
            <!-- Resep cards will be dynamically generated here -->
        </section>
    </main>
</section>
<!-- CONTENT -->



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const apiEndpoint = '/api/pakets'; // API endpoint URL

        async function fetchPaketData() {
            try {
                const response = await fetch(apiEndpoint);
                const data = await response.json(); // Parse JSON response
                let resepList = [];

                data.forEach(paket => {
                    // Hanya menampilkan paket dengan kategori nasi_kotak
                    if (paket.kategori.toLowerCase() === 'nasi_kotak') {
                        let formattedId = paket.id;

                        formattedId = formattedId.replace(/NasiKotak/gi, "Nasi Kotak ");
                        formattedId = formattedId.replace(/Prasmanan/gi, "Prasmanan ");

                        // Format harga ke mata uang Indonesia (IDR)
                        // Format harga ke mata uang Indonesia (IDR) tanpa spasi dan desimal
                        const formattedHarga = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0 // Menghilangkan desimal
                        }).format(paket.harga).replace(/\s/g, ''); // Menghilangkan spasi

                        const resep = {
                            id: formattedId, // Using formatted ID with specific spacing
                            id_origin: paket.id_origin, // Original ID from API
                            judul_naskot: paket.nama,
                            harga: formattedHarga, // Gunakan harga yang sudah diformat
                            gambar_nasi_kotak: paket.foto,
                            deskripsi_singkat: paket.deskripsi,
                            menu: paket.items.map(item => item.nama).join(', ')
                        };
                        resepList.push(resep);
                    }
                });

                document.getElementById("totalNaskot").innerText = resepList.length; // Set total count
                displayResepCards(resepList); // Display the cards
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }

        function displayResepCards(resepList) {
            const articleContainer = document.querySelector('.article-container');
            articleContainer.innerHTML = ''; // Clear existing cards

            resepList.forEach((resep, index) => {
                const newArticleCard = document.createElement('div');
                newArticleCard.classList.add('card');

                newArticleCard.innerHTML = `
            <div class="img-container">
                <img src="${resep.gambar_nasi_kotak}" alt="Gambar Nasi Kotak" />
            </div>
            <div class="card-title">
                <p id="judul_naskot">${resep.judul_naskot}</p>
                <div class="title">
                    <p><span style="font-weight: bold; color: gray;">Id Naskot:</span> <span id="id_naskot">${resep.id}</span></p>
                    <p><span style="font-weight: bold; color: gray;">Harga:</span> ${resep.harga}</p>
                    <p><span style="font-weight: bold; color: gray;">Deskripsi:</span> ${resep.deskripsi_singkat}</p>
                    <p><span style="font-weight: bold; color: gray;">Menu:</span> ${resep.menu}</p>
                </div>
            </div>
            <div class="card-content">
                <div class="action-buttons">
                    <button class="btn-edit" data-id="${resep.id_origin}">Ubah</button>
                    <button class="btn-delete" data-id="${resep.id_origin}">Hapus</button>
                </div>
            </div>
        `;

                articleContainer.appendChild(newArticleCard);
            });

            // Tambahkan event listener untuk tombol edit
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', (event) => {
                    const paketId = event.target.getAttribute('data-id'); // Ambil ID asli
                    const editUrl = `/admin/edit/naskot?id=${paketId}`; // Route dengan parameter terenkripsi

                    // Arahkan ke halaman edit dengan ID terenkripsi
                    window.location.href = editUrl;
                });
            });

            // Tambahkan event listener untuk tombol hapus
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', async (event) => {
                    const paketId = event.target.getAttribute('data-id');
                    await deletePaket(paketId); // Panggil fungsi hapus paket
                });
            });
        }

        async function deletePaket(paketId) {
            const accessToken = sessionStorage.getItem('access_token');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Ambil CSRF token dari meta tag

            if (!accessToken) {
                console.error("Access token tidak ditemukan atau telah kadaluarsa");
                return;
            }

            // Tampilkan konfirmasi SweetAlert
            const result = await Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            });

            if (result.isConfirmed) {
                try {
                    // Tampilkan SweetAlert loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu beberapa saat',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const deleteEndpoint = `${apiEndpoint}/${paketId}`;
                    const response = await fetch(deleteEndpoint, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': `Bearer ${accessToken}`, // Menyertakan token akses
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken // Menyertakan CSRF token jika diperlukan
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`Gagal menghapus data. Status: ${response.status}`);
                    }

                    // Tampilkan pesan sukses setelah berhasil menghapus
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil dihapus.',
                        icon: 'success',
                        timer: 2000, // Tutup otomatis setelah 2 detik
                        showConfirmButton: false
                    });

                    fetchPaketData(); // Refresh data setelah menghapus
                } catch (error) {
                    console.error("Error menghapus paket:", error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal menghapus data. Silakan coba lagi.',
                        icon: 'error'
                    });
                }
            }
        }


        fetchPaketData(); // Fetch API data on page load
    });
</script>




@endsection