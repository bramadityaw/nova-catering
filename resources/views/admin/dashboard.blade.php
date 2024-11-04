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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script> <!-- Import PapaParse -->

    <title>Nova Cathering Admin</title>
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
                    <i class="bx bxs-bowl-hot"></i>
                    <span class="text">
                        <h3 id="totalPrasmanan">0</h3>
                        <p>Jumlah Prasmanan</p>
                    </span>
                </li>
                <li>
                    <i class="bx bxs-bowl-rice"></i>
                    <span class="text">
                        <h3 id="totalNaskot">0</h3>
                        <p>Jumlah Nasi Kotak</p>
                    </span>
                </li>
                <li>
                    <i class="bx bxs-user"></i>
                    <span class="text">
                        <h3 id="totalAdmin">0</h3>
                        <p>Jumlah Admin</p>
                    </span>
                </li>
                <li>
                    <i class="bx bxs-star"></i>
                    <span class="text">
                        <h3 id="totalUlasan">0</h3>
                        <p>Jumlah Ulasan</p>
                    </span>
                </li>
            </ul>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script>
        // Fungsi untuk menghitung data dalam CSV
        function countDataFromCSV(file) {
            return new Promise((resolve, reject) => {
                Papa.parse(file, {
                    download: true,
                    header: false,
                    complete: function (results) {
                        const data = results.data.slice(1); // Mengambil semua baris kecuali header
                        let count = 0;

                        // Hitung baris yang tidak kosong
                        data.forEach(row => {
                            if (row.length > 0 && row.some(cell => cell.trim() !== "")) {
                                count++;
                            }
                        });

                        resolve(count);
                    },
                    error: function (err) {
                        console.error("Error loading the CSV file: ", err);
                        reject(err);
                    }
                });
            });
        }

        // Fungsi untuk memuat dan menghitung semua data
        async function loadData() {
            try {
                const totalPrasmanan = await countDataFromCSV('prasmanan.csv');
                const totalNaskot = await countDataFromCSV('naskot.csv');
                const totalAdmin = await countDataFromCSV('adminAccount.csv');
                const totalUlasan = await countDataFromCSV('ulasan.csv');

                // Update elements on the page
                document.getElementById("totalPrasmanan").innerText = totalPrasmanan;
                document.getElementById("totalNaskot").innerText = totalNaskot;
                document.getElementById("totalAdmin").innerText = totalAdmin;
                document.getElementById("totalUlasan").innerText = totalUlasan;

                // Check for the username from the URL
                const params = new URLSearchParams(window.location.search);
                const usernameFromURL = params.get('username');
                if (usernameFromURL) {
                    document.getElementById("admin_name").innerText = usernameFromURL;
                } else {
                    // If no username in URL, fallback to CSV
                    const username = await getUsernameFromCSV();
                    document.getElementById("admin_name").innerText = username;
                }

            } catch (error) {
                console.error("Error loading data: ", error);
            }
        }

        // Function to get username from CSV
        function getUsernameFromCSV() {
            return new Promise((resolve, reject) => {
                Papa.parse('users.csv', {
                    download: true,
                    header: false,
                    complete: function (results) {
                        const username = results.data[1][0]; // Ensure this is the correct index
                        resolve(username);
                    },
                    error: function (err) {
                        console.error("Error loading the CSV file: ", err);
                        reject(err);
                    }
                });
            });
        }

        // Memanggil fungsi loadData untuk memuat dan menghitung data
        loadData();

        // Logout functionality
        const logoutButton = document.getElementById("logoutButton");
        logoutButton.addEventListener("click", function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin ingin log out?',
                showCancelButton: true,
                confirmButtonText: `Ya, Log Out`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.html"; // Arahkan ke halaman login
                }
            });
        });
    </script>

    <script src="js/admin_dashboard.js" type="text/javascript"></script>
</body>

</html>
