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
                <h1>Ulasan List</h1>
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="/dashboard" style="color: blue;">Dashboard</a>
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
        <!-- Kontainer untuk menampilkan ulasan -->
        <section class="article-container">
            <!-- Ulasan akan ditampilkan di sini -->
        </section>
    </main>
</section>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const apiEndpoint = '/api/reviews/index';

        async function fetchReviewsData() {
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

                const ulasanList = await response.json();
                document.getElementById("totalUlasan").innerText = ulasanList.length;
                displayUlasanCards(ulasanList);
            } catch (error) {
                console.error("Error fetching reviews data:", error);
            }
        }

        function displayUlasanCards(ulasanList) {
            const articleContainer = document.querySelector('.article-container');
            articleContainer.innerHTML = '';

            const displayedContainer = document.createElement('div');
            displayedContainer.classList.add('displayed-reviews');
            displayedContainer.innerHTML = `<h3 style="margin-left: 0px; margin-top: 50px;">Data Tertampil</h3>`;

            const hiddenContainer = document.createElement('div');
            hiddenContainer.classList.add('hidden-reviews');
            hiddenContainer.innerHTML = `<h3 style="margin-left: 0px; margin-top: 50px;">Data Tersembunyi</h3>`;

            ulasanList.forEach((ulasan) => {
                const newArticleCard = document.createElement('div');
                newArticleCard.classList.add('card');

                const stars = Array.from({
                    length: ulasan.rating
                }, () => '<i class="bx bxs-star" style="color:#F570E6;"></i>').join('');
                const buttonText = ulasan.public ? "Sembunyikan" : "Tampilkan";

                newArticleCard.innerHTML = `
            <div class="card-title">
                <p id="nama_pembeli">${ulasan.reviewer_name}</p>
                <div class="title">
                    <div class="stars">${stars}</div>
                    <p><span id="pekerjaan">${ulasan.job}</span></p>
                    <p>${ulasan.content}</p>
                </div>
            </div>
            <div class="action-buttons">
                <div class="card-content">
                    <div class="action-buttons">
                        <button class="btn-edit" data-id="${ulasan.id}" data-public="${ulasan.public}">${buttonText}</button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="action-buttons">
                        <button class="btn-delete" data-id="${ulasan.id}">Hapus</button>
                    </div>
                </div>
            </div>
            `;

                if (ulasan.public) {
                    displayedContainer.appendChild(newArticleCard);
                } else {
                    hiddenContainer.appendChild(newArticleCard);
                }
            });

            articleContainer.appendChild(displayedContainer);
            articleContainer.appendChild(hiddenContainer);

            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', handleEditButtonClick);
            });

            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', handleDeleteButtonClick);
            });
        }

        async function handleEditButtonClick(event) {
            const button = event.target;
            const reviewId = button.getAttribute('data-id');
            const isPublic = button.getAttribute('data-public') === '1';
            const newStatusEndpoint = isPublic ? `/api/review/${reviewId}/hide` : `/api/review/${reviewId}/show`;

            try {
                const accessToken = sessionStorage.getItem('access_token');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch(newStatusEndpoint, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    alert(`Review ${isPublic ? 'hidden' : 'shown'} successfully.`);
                    location.reload();
                } else {
                    throw new Error(`Failed to update review status. Status: ${response.status}`);
                }
            } catch (error) {
                console.error("Error updating review status:", error);
            }
        }

        async function handleDeleteButtonClick(event) {
            const button = event.target;
            const reviewId = button.getAttribute('data-id');
            const deleteEndpoint = `/api/review/${reviewId}`;

            try {
                const accessToken = sessionStorage.getItem('access_token');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch(deleteEndpoint, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    alert("Review deleted successfully.");
                    location.reload();
                } else {
                    throw new Error(`Failed to delete review. Status: ${response.status}`);
                }
            } catch (error) {
                console.error("Error deleting review:", error);
            }
        }

        fetchReviewsData();
    });
</script>




@endsection