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
                <h1>Isi Menu List</h1>
                <ul class="breadcrumb">
                    <li>
                        <a class="active" href="/dashboard" style="color: blue;">Dashboard</a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li>
                        <a class="active" href="#" style="cursor: default;">Isi Menu</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="button_postingan">
            <button id="openModalButton"><i class="bx bx-plus" id="add_artikel"></i>Tambah</button>
        </div>

        <ul class="box-info">
            <li>
                <i class="bx bx-list-ul" style="color:var(--purple-tua); background:var(--purple-muda);"></i>
                <span class="text">
                    <h3 id="totalIsimenu">0</h3>
                    <p>Jumlah Isi Menu</p>
                </span>
            </li>
        </ul>

        <section class="article-container">
            <!-- ISi stabel-->
        </section>
    </main>
</section>
<!-- CONTENT -->



<!-- Modal for adding new item -->
<div id="addItemModal" class="modal">
    <div class="modal-content">
        <h3>Tambah Item Baru</h3>
        <form id="addItemForm">
            <h3 style="margin-bottom: 16px; color:grey;">Judul Isi Menu</h3>
            <input type="hidden" id="item_id" name="item_id" /> <!-- Hidden field for item ID -->
            <div class="artikel-title">
                <input type="text" id="judul_isimenu" name="judul_isimenu" placeholder="Judul Isi Menu" required />
            </div>
            <button class="btn-simpan" type="submit">Simpan</button>
            <button class="btn-batal" type="button" id="closeModalButton">Batal</button>
        </form>

    </div>
</div>

<!-- Ensure that the CSRF token meta tag is present -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    let edit_id = null;
    document.addEventListener("DOMContentLoaded", function() {
        const apiEndpoint = '/api/satuans/index';
        const addItemApiEndpoint = '/api/satuan'; // API endpoint for adding item
        const deleteItemApiEndpoint = '/api/satuan/{id}'; // Delete API endpoint
        const modal = document.getElementById('addItemModal');
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const addItemForm = document.getElementById('addItemForm');
        const sidebar = document.getElementById('sidebar'); // Select sidebar by ID
        window.openEditModal = openEditModal;

        // Apply styles for the modal and background overlay
        function applyModalStyles() {
            const style = document.createElement('style');
            style.innerHTML = `
            /* Base modal styling */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                width: 700px;
                text-align: center;
                box-sizing: border-box;
            }

            .modal-content h3 {
                margin-top: 0;
                text-align: left;
            }

            .modal-content input,
            .modal-content button {
                width: 100%;
                margin-top: 10px;
            }

            input {
                width: 100%;
                padding: 10px;
                margin-bottom: 16px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            @media screen and (max-width: 576px) {
                .btn-simpan {
                    margin-left: 0px;
                }
            }

            /* Responsive styling for smaller screens */
            @media (max-width: 780px) {
                .modal-content {
                    width: 60%;
                    padding: 15px;
                    margin-left: 64px;
                }

                .modal-content h3 {
                    font-size: 1.2em;
                }

                input, .modal-content button {
                    padding: 8px;
                }
            }
        `;
            document.head.appendChild(style);
        }

        // Toggle modal visibility
        function openModal() {
            modal.style.display = 'flex';
            if (sidebar) sidebar.classList.add('hide'); // Add hide class to sidebar
        }

        function closeModal() {
            modal.style.display = 'none';
            if (sidebar) sidebar.classList.remove('hide'); // Remove hide class from sidebar
        }

        // Open the modal when the button is clicked
        if (openModalButton) {
            openModalButton.addEventListener('click', openModal);
        }

        // Close the modal when the close button is clicked
        if (closeModalButton) {
            closeModalButton.addEventListener('click', closeModal);
        }



        addItemForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            const judulIsiMenu = document.getElementById('judul_isimenu').value;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const accessToken = sessionStorage.getItem('access_token');

            try {
                // Tampilkan SweetAlert loading
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Silakan tunggu sebentar',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Tentukan endpoint API dan metode HTTP berdasarkan edit_id
                const apiEndpoint = edit_id ? `/api/satuan/${edit_id}` : '/api/satuan';
                const method = edit_id ? 'PUT' : 'POST';

                // Tentukan body permintaan berdasarkan metode
                const requestBody = edit_id ? {
                    nama: judulIsiMenu
                } : {
                    items: [{
                        nama: judulIsiMenu
                    }]
                };

                // Kirim permintaan ke API
                const response = await fetch(apiEndpoint, {
                    method: method,
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestBody)
                });

                if (!response.ok) {
                    const responseBody = await response.json();

                    if (response.status === 409) {
                        // Tampilkan pesan item duplikat
                        Swal.fire({
                            title: 'Item Duplikat',
                            text: responseBody.duplicate_items ?
                                `Item sudah ada: ${responseBody.duplicate_items.join(', ')}` : 'Semua item sudah ada di database.',
                            icon: 'error'
                        });
                    } else if (response.status === 207) {
                        // Tampilkan item yang berhasil disimpan dan item duplikat
                        const savedItems = responseBody.saved_items.join(', ');
                        const duplicateItems = responseBody.duplicate_items.join(', ');

                        Swal.fire({
                            title: 'Sebagian Berhasil',
                            html: `
                        <p>Item berhasil disimpan: ${savedItems}</p>
                        ${duplicateItems ? `<p>Item duplikat: ${duplicateItems}</p>` : ''}
                    `,
                            icon: 'info'
                        });
                    } else {
                        // Tampilkan kesalahan umum
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Gagal menambahkan item. Silakan coba lagi.',
                            icon: 'error'
                        });
                    }
                    return; // Keluar dari fungsi jika terjadi kesalahan
                }

                // Operasi berhasil
                fetchSatuanData(); // Refresh data
                closeModal(); // Tutup modal
                addItemForm.reset(); // Reset form

                // Tampilkan SweetAlert sukses
                Swal.fire({
                    title: edit_id ? 'Berhasil Diperbarui' : 'Berhasil Ditambahkan',
                    text: edit_id ? 'Data berhasil diperbarui!' : 'Item berhasil ditambahkan!',
                    icon: 'success',
                    timer: 2000, // Tampilkan selama 2 detik
                    showConfirmButton: false
                });

                // Reset edit_id untuk operasi berikutnya
                edit_id = null;

            } catch (error) {
                console.error(`Error ${edit_id ? 'updating' : 'adding'} item:`, error);
                Swal.fire({
                    title: 'Kesalahan',
                    text: `Gagal ${edit_id ? 'memperbarui' : 'menambahkan'} item. Silakan coba lagi.`,
                    icon: 'error'
                });
            }
        });




        // Function to delete an item
        async function deleteItem(id) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const accessToken = sessionStorage.getItem('access_token');

            // SweetAlert untuk konfirmasi penghapusan
            const confirmDelete = await Swal.fire({
                title: 'Konfirmasi Penghapusan',
                text: 'Apakah Anda yakin ingin menghapus item ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            });

            if (!confirmDelete.isConfirmed) {
                return; // Batalkan proses jika pengguna menekan tombol "Batal"
            }

            try {
                // Kirim permintaan DELETE ke API
                const response = await fetch(deleteItemApiEndpoint.replace('{id}', id), {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`Failed to delete item with ID ${id}`);
                }

                // SweetAlert untuk notifikasi berhasil
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Item berhasil dihapus.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });

                fetchSatuanData(); // Refresh data setelah penghapusan
            } catch (error) {
                console.error("Error deleting item:", error);

                // SweetAlert untuk notifikasi error
                Swal.fire({
                    title: 'Gagal',
                    text: 'Gagal menghapus item. Silakan coba lagi.',
                    icon: 'error'
                });
            }
        }


        // Make deleteItem globally accessible
        window.deleteItem = deleteItem;

        // Function to create and apply styles for the main content
        function applyStyles() {
            const style = document.createElement('style');
            style.innerHTML = `
            .card-header h3 {
                margin: 0;
                font-size: 1.5rem;
                color: #333;
            }
            .grid-container {
                width: 100%;
                padding-top: 10px;
                table-layout: fixed;
            }
            .action-link {
                margin-right: 10px;
                color: #007bff;
                cursor: pointer;
                text-decoration: underline;
            }
            .gridjs-search {
                width: 100%; /* Membuat lebar mengikuti lebar elemen parent */
                box-sizing: border-box; /* Memastikan padding tidak memengaruhi lebar total */
            }

            input.gridjs-input {
                width: 100%;
            }

               /* Tambahkan CSS agar tabel menjadi responsif */
    @media (max-width: 600px) {
      .gridjs-container {
        display: block;
      }

          /* Menyembunyikan header kolom Actions */
    .gridjs-th:nth-child(3) {
        display: none !important;
    }

    /* Menyembunyikan label data-label untuk kolom Actions pada layar kecil */
    .gridjs-td:nth-child(3)::before {
        content: '';
    }

    /* Menampilkan tombol Edit dan Delete secara vertikal */
    .gridjs-td:nth-child(3) {
        display: block;
        text-align: right;
    }
        
      td.gridjs-td{
        box-sizing: inherit;
      }

      .gridjs-table {
        border: none;
      }

      .gridjs-thead,
      .gridjs-th {
        display: none;
      }

      .gridjs-tr {
        display: block;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
      }

      .gridjs-td {
        display: flex;
        width: 100%;
        padding: 8px;
        text-align: left;
        justify-content: space-between;
        border: none;
      }

      .gridjs-td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #555;
        }
        }
        `;
            document.head.appendChild(style);
        }

        // Function to fetch data from the API
        async function fetchSatuanData() {
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const accessToken = sessionStorage.getItem('access_token');

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

                const satuanData = await response.json();
                updateTotalIsimenu(satuanData.length);
                displayGrid(satuanData);
            } catch (error) {
                console.error("Error fetching satuan data:", error);
                alert("Gagal memuat data. Silakan coba lagi.");
            }
        }

        // Function to update the total count of Isi Menu
        function updateTotalIsimenu(total) {
            const totalIsimenuElement = document.getElementById('totalIsimenu');
            totalIsimenuElement.textContent = total;
        }

        // Function to display data in a responsive grid
        function displayGrid(data) {
            const gridContainer = document.querySelector('.article-container');
            gridContainer.innerHTML = ''; // Bersihkan konten yang ada

            const card = document.createElement('div');
            card.classList.add('card');

            const cardHeader = document.createElement('div');
            cardHeader.classList.add('card-header');
            const headerTitle = document.createElement('h3');
            cardHeader.appendChild(headerTitle);

            card.appendChild(cardHeader);

            const gridContainerElement = document.createElement('div');
            gridContainerElement.classList.add('grid-container');
            card.appendChild(gridContainerElement);

            gridContainer.appendChild(card);

            new gridjs.Grid({
                columns: [{
                        name: 'ID',
                        width: '10%',
                        attributes: (cell) => ({
                            'data-label': 'ID'
                        })
                    },
                    {
                        name: 'Nama',
                        width: '70%',
                        attributes: (cell) => ({
                            'data-label': 'Nama'
                        })
                    },
                    {
                        name: 'Actions',
                        width: '20%',
                        formatter: (_, row) => gridjs.html(`
            <a href="javascript:void(0);" class="action-link" onclick="openEditModal(${row.cells[0].data})" style="color:#2980b9; font-weight:bold;">Ubah</a>
            <a href="javascript:void(0);" class="action-link" onclick="deleteItem(${row.cells[0].data})" style="color:#d64535; font-weight:bold;">Hapus</a>
          `),
                        attributes: (cell) => ({
                            'data-label': 'Actions'
                        })
                    }
                ],
                search: {
                    enabled: true,
                    placeholder: "Cari kata kunci"
                },
                pagination: {
                    limit: 10,
                    summary: true
                },
                data: data.map(item => [item.id, item.nama]),
                sort: true,
                language: {
                    search: {
                        placeholder: 'Cari kata kunci'
                    },
                    pagination: {
                        previous: 'Sebelumnya',
                        next: 'Berikutnya',
                        showing: 'Menampilkan',
                        results: () => 'data'
                    }
                }
            }).render(gridContainerElement);
        }


        // Function to open the edit modal and fetch item data
        async function openEditModal(id) {
            edit_id = id; // Store the ID of the item being edited
            modal.style.display = 'flex'; // Display the modal

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const accessToken = sessionStorage.getItem('access_token');

            try {
                const response = await fetch(`/api/satuan/${id}`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${accessToken}`,
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Failed to fetch item data');

                const itemData = await response.json();
                document.getElementById('judul_isimenu').value = itemData.nama; // Populate the form field with the fetched data

            } catch (error) {
                console.error("Error fetching item data:", error);
                alert("Gagal memuat data item. Silakan coba lagi.");
            }
        }


        // Call the functions
        applyModalStyles();
        applyStyles();
        fetchSatuanData();
    });
</script>

@endsection