<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <!-- Using Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/nova_cathering_tab_icon.png" type="image/x-icon" sizes="32x32" />
    <!-- My CSS -->
    <link rel="stylesheet" href="style/admin_dashboard.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Nova Cathering Admin</title>
    <style>
        textarea {
    width: 100%;         /* Full width of the container */
    max-width: 100%;     /* Prevents it from expanding beyond container */
    height: 100px;       /* Fixed height */
    resize: none;        /* Disable manual resizing */
    overflow: auto;      /* Adds a scrollbar if content overflows */
    padding: 10px;       /* Adds padding inside the textarea */
    font-size: 16px;     /* Sets a readable font size */
    border: 1px solid #ccc; /* Optional: a border for better visibility */
    border-radius: 5px;  /* Optional: rounded corners */
}

    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="images/nova_cathering_icon.png" class="img-logo" alt="" />
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="admin_dashboard.html">
                    <img src="images/dashboard_icon.png" class="logo" alt="" />
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admin_naskot.html">
                    <img src="images/nasi_kotak_icon_inactive.png" class="logo" alt="" />
                    <span class="text">Nasi Kotak</span>
                </a>
            </li>
            <li>
                <a href="admin_prasmanan.html">
                    <img src="images/prasmanan_icon_inactive.png" class="logo" alt="" />
                    <span class="text">Prasmanan</span>
                </a>
            </li>
            <li>
                <a href="admin_ulasan.html">
                    <img src="images/ulasan_icon_inactive.png" class="logo" alt="" />
                    <span class="text">Ulasan</span>
                </a>
            </li>
            <li>
                <a href="admin_account.html">
                    <img src="images/admin_icon_inactive.png" class="logo" alt="" />
                    <span class="text">Admin</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout" id="logoutButton">
                    <i class="bx bxs-log-out-circle"></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <section id="content">
        <nav>
            <i class="bx bx-menu"></i>
        </nav>
        <div class="content2">
            <div class="card-artikel">
                <h2>Tambah Prasmanan</h2>
            </div>
        </div>
    </section>
    <section id="content">
        <form class="postingan" id="prasmananForm" method="post" action="">
            <div class="card-artikel">
                <div class="artikel-title">
                    <input type="text" id="id" name="id" placeholder="ID (e.g., Prasmanan A)" required />
                </div>
            </div>
    
            <div class="card-artikel">
                <div class="artikel-title">
                    <input type="text" id="nama_prasmanan" name="nama_prasmanan" placeholder="Nama Prasmanan (e.g., Paket Sederhana)" required />
                </div>
            </div>
    
            <div class="card-artikel">
                <div class="artikel-title">
                    <input type="number" id="harga" name="harga" placeholder="Harga Prasmanan (e.g., 65000)" required />
                </div>
            </div>
    
            <div class="card-artikel">
                <div class="artikel-title">
                    <input type="url" id="gambar_prasmanan" name="gambar_prasmanan" placeholder="Link Gambar Prasmanan (e.g., images/prasmanan.jpeg)" required />
                </div>
            </div>
    
            <div class="card-artikel">
                <div class="artikel-title">
                    <textarea id="deskripsi_singkat" name="deskripsi_singkat" placeholder="Deskripsi Singkat (e.g., Paket sederhana cocok untuk acara kecil.)" required></textarea>
                </div>
            </div>
    
            <div class="card-artikel">
                <div class="artikel-title">
                    <textarea id="menu" name="menu" placeholder="Daftar Menu (e.g., Nasi Putih; Ayam Goreng; Sambal; Tahu; Tempe)" required></textarea>
                </div>
            </div>
    
            <div class="kanan">
                <div class="button-artikel" style="margin-top:10px;">
                    <div class="buttons" style="flex-direction: row; margin-bottom:1rem;">
                        <button type="submit" class="btn-simpan">
                            <img src="images/floppy-disk.png" alt="Save Icon" class="button-icon" />
                            <p>Simpan</p>
                        </button>
                        <button type="reset" class="btn-batal" style="margin-left: 1.5rem;">
                            <img src="images/delete-left.png" alt="Reset Icon" class="button-icon" />
                            <p>Batal</p>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const batalButton = document.querySelector(".btn-batal");

            batalButton.addEventListener("click", function() {
                window.location.href = 'admin_prasmanan.html';
            });
        });
    </script>

    <script src="js/admin_dashboard.js" type="text/javascript"></script>
</body>

</html>
