@extends('admin.layouts.main')

@section('main')
    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class="bx bx-menu"></i>
            <h3 class="profile">Welcome, <span id="admin_name"></span></h3>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="box-info">

                <li>
                    <i class="bx bxs-bowl-rice"></i>
                    <span class="text">
                        <h3 id="totalNaskot">0</h3>
                        <p>Jumlah Nasi Kotak</p>
                    </span>
                </li>
                <li>
                    <i class="bx bxs-bowl-hot"></i>
                    <span class="text">
                        <h3 id="totalPrasmanan">0</h3>
                        <p>Jumlah Prasmanan</p>
                    </span>
                </li>
                <li>
                    <i class="bx bx-list-ul"></i>
                    <span class="text">
                        <h3 id="totalIsimenu">0</h3>
                        <p>Jumlah Isi Menu</p>
                    </span>
                </li>
                <li>
                    <i class="bx bxs-star"></i>
                    <span class="text">
                        <h3 id="totalUlasan">0</h3>
                        <p>Jumlah Ulasan</p>
                    </span>
                </li>
                <li>
                    <i class="bx bxs-user"></i>
                    <span class="text">
                        <h3 id="totalAdmin">0</h3>
                        <p>Jumlah Admin</p>
                    </span>
                </li>

            </ul>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil access token dari sessionStorage
        const accessToken = sessionStorage.getItem('access_token');

        // Pastikan token tersedia sebelum melanjutkan
        if (!accessToken) {
            console.error('Access token tidak ditemukan di sessionStorage');
            return;
        }

        // Fungsi untuk mengambil data dari endpoint dengan header Authorization
        fetch('/api/total/data', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${accessToken}`
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update elemen HTML dengan data yang diterima
            document.getElementById('totalNaskot').textContent = data.total_paket_nasi_kotak;
            document.getElementById('totalPrasmanan').textContent = data.total_paket_prasmanan;
            document.getElementById('totalIsimenu').textContent = data.total_satuan;
            document.getElementById('totalUlasan').textContent = data.total_reviews;
            document.getElementById('totalAdmin').textContent = data.total_users;
        })
        .catch(error => console.error('Error fetching data:', error));
    });
</script>


@endsection
