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
                <h1>Akun Admin List</h1>
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="/dashboard" style="color: blue;">Dashboard</a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li>
                        <a class="active" href="#" style="cursor: default;">Admin</a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="box-info">
            <li>
                <i class="bx bxs-user" style="color: #e46262; background:#ffd2d2;"></i>
                <span class="text">
                    <h3 id="totalAdmin">0</h3>
                    <p>Jumlah Admin</p>
                </span>
            </li>
        </ul>

        <!-- Kontainer untuk menampilkan ulasan -->
        <section class="article-container">
            <!-- Ulasan akan ditampilkan di sini -->
        </section>
    </main>
</section>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const apiEndpoint = '/api/user';

        async function fetchUserData() {
            try {
                const accessToken = sessionStorage.getItem('access_token');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch(apiEndpoint, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const userData = await response.json();
                displayUserNames(userData.names); // Pass the "names" array to display function
                updateTotalAdmin(userData.names.length); // Update the total count
            } catch (error) {
                console.error("Error fetching user data:", error);
            }
        }

        function displayUserNames(namesList) {
            const articleContainer = document.querySelector('.article-container');
            articleContainer.innerHTML = ''; // Clear existing content

            namesList.forEach((name) => {
                const nameCard = document.createElement('div');
                nameCard.classList.add('card');

                // Creating a simple card to display the user name
                nameCard.innerHTML = `
                <div class="card-content">
                    <p style="margin-bottom: 12px; font-size:30px; font-weight: bold;">Nama</p>
                    <p class="user-name" style="font-size: 24px; font-weight:500;">${name}</p>
                </div>
            `;

                articleContainer.appendChild(nameCard); // Append each name card to the main container
            });
        }

        function updateTotalAdmin(total) {
            const totalAdminElement = document.getElementById('totalAdmin');
            totalAdminElement.textContent = `${total}`;
        }

        fetchUserData(); // Fetch data from the API on page load
    });
</script>





@endsection