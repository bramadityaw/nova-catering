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
            <li>
                <a href="admin_prasmanan.html">
                    <img src="images/prasmanan_icon_inactive.png" class="logo" alt="" />
                    <span class="text">Prasmanan</span>
                </a>
            </li>
            <li class="active">
                <a href="admin_ulasan.html">
                    <img src="images/ulasan_icon.png" class="logo" alt="" />
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
                    <h1>Ulasan List</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="admin_dashboard.html?id=" style="color: blue;">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="#" style="cursor: default;">Ulasan</a>
                        </li>
                    </ul>
                </div>
            </div>            

            <ul class="box-info">
                <li>
                    <i class="bx bxs-star" style="color: #377DFF; background:#D6E4FF;"></i>
                    <span class="text">
                        <h3 id="totalUlasan">0</h3>
                        <p>Jumlah Ulasan</p>
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
            const csvFilePath = 'ulasan.csv'; // Path to your CSV file
    
            async function fetchCSVData() {
                const response = await fetch(csvFilePath);
                const data = await response.text();
                const rows = data.split('\n').slice(1); // Skip the header row
                let ulasanList = [];
    
                rows.forEach(row => {
                    // Trim the row to remove any leading or trailing whitespace
                    row = row.trim();
    
                    // Skip empty rows
                    if (row === '') return;
    
                    // Using regex to match CSV values correctly
                    const columns = row.match(/(?:\"([^\"]*)\"|([^\",]+))/g);
    
                    // Check if columns were found and have the correct length
                    if (columns && columns.length === 5) {
                        const ulasan = {
                            id: columns[0].replace(/\"/g, '').trim(),
                            isi_ulasan: columns[1].replace(/\"/g, '').trim(),
                            nama_pembeli: columns[2].replace(/\"/g, '').trim(),
                            pekerjaan: columns[3].replace(/\"/g, '').trim(),
                            bintang: parseInt(columns[4].replace(/\"/g, '').trim()) // Convert to integer
                        };
                        ulasanList.push(ulasan);
                    }
                });
    
                document.getElementById("totalUlasan").innerText = ulasanList.length; // Set total count
                displayUlasanCards(ulasanList); // Display the cards
            }
    
            function displayUlasanCards(ulasanList) {
                const articleContainer = document.querySelector('.article-container');
                articleContainer.innerHTML = ''; // Clear existing cards
    
                ulasanList.forEach((ulasan) => {
                    const newArticleCard = document.createElement('div');
                    newArticleCard.classList.add('card');
    
                    // Create star icons based on the rating using Boxicons
                    const stars = Array.from({ length: ulasan.bintang }, () => '<i class="bx bxs-star"></i>').join('');
    
                    newArticleCard.innerHTML = `
                        <div class="card-title">
                            <p id="nama_pembeli">${ulasan.nama_pembeli}</p>
                            <div class="title">
                                <div class="stars">${stars}</div>
                                <p><span id="pekerjaan">${ulasan.pekerjaan}</span></p>
                                <p>${ulasan.isi_ulasan}</p>
                            
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="action-buttons">
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
