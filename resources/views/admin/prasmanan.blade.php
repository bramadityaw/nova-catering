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
</head>

<body>
     <!-- SIDEBAR -->
     <section id="sidebar">
        <a href="#" class="brand">
            <img src="images/nova_cathering_icon.png" class="img-logo" alt="" />
        </a>
        <ul class="side-menu top">
            <li>
                <a href="admin_dashboard.html">
                    <img src="images/dashboard_icon_inactive.png" class="logo" alt="" />
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admin_naskot.html">
                    <img src="images/nasi_kotak_icon_inactive.png" class="logo" alt="" />
                    <span class="text">Nasi Kotak</span>
                </a>
            </li>
            <li class="active">
                <a href="admin_prasmanan.html">
                    <img src="images/prasmanan_icon.png" class="logo" alt="" />
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

    <!-- CONTENT -->
    <section id="content">
        <nav>
            <i class="bx bx-menu"></i>
            <h3 class="profile">Welcome, <span id="admin_name"></span></h3>
        </nav>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Prasmanan List</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="admin_dashboard.html?id=" style="color: blue;">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="#" style="cursor: default;">Prasmanan</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="button_postingan">
                <a href="admin_add_prasmanan.html" id="addResepLink"><button><i class="bx bx-plus" id="add_artikel"></i>Tambah</button></a>
            </div>

            

            <ul class="box-info">
                <li>
                    <i class="bx bxs-bowl-hot" style="color: #FFD69D; background:#FF9500;"></i>
                    <span class="text">
                        <h3 id="totalPrasmanan">0</h3>
                        <p>Jumlah Prasmanan</p>
                    </span>
                </li>
            </ul>
        </main>
    </section>
    <!-- CONTENT -->

    <section id="content" class="article-container">
        <!-- Resep cards will be dynamically generated here -->
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const csvFilePath = 'prasmanan.csv'; // Path to your CSV file
    
            async function fetchCSVData() {
                const response = await fetch(csvFilePath);
                const data = await response.text();
                const rows = data.split('\n').slice(1); // Skip the header row
                let resepList = [];
    
                rows.forEach(row => {
                    const columns = row.split(',');
                    if (columns.length > 1) { // Check if the row has valid data
                        const resep = {
                            id: columns[0],
                            nama_prasmanan: columns[1],
                            harga: columns[2],
                            gambar_prasmanan: columns[3],
                            deskripsi_singkat: columns[4].replace(/"/g, ''), // Remove quotes
                            menu: columns[5].replace(/"/g, '').split(';') // Split menu items
                        };
                        resepList.push(resep);
                    }
                });
    
                document.getElementById("totalPrasmanan").innerText = resepList.length; // Set total count
                displayResepCards(resepList); // Display the cards
            }
    
            function displayResepCards(resepList) {
                const articleContainer = document.querySelector('.article-container');
                articleContainer.innerHTML = ''; // Clear existing cards
    
                resepList.forEach((resep, index) => {
                    const newArticleCard = document.createElement('div');
                    newArticleCard.classList.add('card');
    
                    newArticleCard.innerHTML = `
                        <div class="img-container">
                            <img src="${resep.gambar_prasmanan}" alt="Gambar Prasmanan" />
                        </div>
                        <div class="card-title">
                            <p id="judul_prasmanan">${resep.nama_prasmanan}</p>
                            <div class="title">
                                <p>Id Prasmanan: <span id="id_prasmanan">${resep.id}</span></p>
                                <p>Harga: ${resep.harga}</p>
                                <p>Deskripsi: ${resep.deskripsi_singkat}</p>
                                <p>Menu: ${resep.menu.join(', ')}</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="action-buttons">
                                <button class="btn-edit">Ubah</button>
                                <button class="btn-delete">Hapus</button>
                            </div>
                        </div>
                    `;
    
                    articleContainer.appendChild(newArticleCard);
                });
            }
    
            fetchCSVData(); // Fetch CSV data on page load
        });
    </script>
    
</body>

</html>
