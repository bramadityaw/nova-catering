@extends('admin.layouts.main')

@section('main')
<section id="content">
    <nav>
        <i class="bx bx-menu"></i>
        <h3 class="profile">Welcome, <span id="admin_name"></span></h3>
    </nav>
    <div class="content2">
        <div class="card-artikel">
            <h2>{{ request()->has('id') ? 'Edit Nasi Kotak' : 'Tambah Nasi Kotak' }}</h2>
        </div>
    </div>
</section>

<section id="content">

    <!-- Loading Spinner -->
    <div id="loadingSpinner" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <img src="{{ asset('images/loading-spinner.gif') }}" alt="Loading..." style="width: 50px; height: 50px;" />
    </div>

    
    <form class="postingan" id="nasiKotakForm" method="POST" action="{{ request()->has('id') ? route('paket.update', request('id')) : route('admin.paket.store') }}" enctype="multipart/form-data">
        @csrf
        @if(request()->has('id'))
            @method('PATCH') <!-- Add PATCH method if ID exists -->
        @endif
        <div class="card-artikel">
            <h3 style="margin-bottom: 16px; color:grey;">Judul Nasi Kotak</h3>
            <div class="artikel-title">
                <input type="text" id="judul_naskot" name="judul_naskot" placeholder="Judul Nasi Kotak" required />
            </div>
        </div>
        <div class="card-artikel">
            <h3 style="margin-bottom: 16px; color:grey;">Isi Menu</h3>
            @include('admin.partials.dropdownNaskot')
        </div>
        <div class="card-artikel">
            <h3 style="margin-bottom: 16px; color:grey;">Harga</h3>
            <div class="artikel-title">
                <input type="text" id="harga" name="harga" placeholder="Rp" required />
            </div>
        </div>
        <div class="card-artikel">
            <h3 style="margin-bottom: 16px; color:grey;">Gambar</h3>
            <div class="artikel-title">
                <input type="file" id="gambar_nasi_kotak" name="gambar_nasi_kotak" accept="image/*" />
            </div>
        </div>
        <div class="card-artikel">
            <h3 style="margin-bottom: 16px; color:grey;">Deskripsi Singkat</h3>
            <div class="artikel-title">
                <textarea id="deskripsi_singkat" name="deskripsi_singkat" placeholder="Deskripsi Singkat" required></textarea>
            </div>
        </div>

        <div class="kanan">
            <div class="button-artikel" style="margin-top:10px;">
                <div class="buttons" style="flex-direction: row; margin-bottom:1rem;">
                    <button type="submit" class="btn-simpan">
                        <img src="{{ asset('images/floppy-disk.png') }}" alt="Save Icon" class="button-icon" />
                        <p>Simpan</p>
                    </button>
                    <button type="reset" class="btn-batal" style="margin-left: 1.5rem;">
                        <img src="{{ asset('images/delete-left.png') }}" alt="Reset Icon" class="button-icon" />
                        <p>Batal</p>
                    </button>
                </div>
            </div>
        </div>
    </form>
</section>

<script>
function getAccessToken() {
    return sessionStorage.getItem('access_token');
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("nasiKotakForm");
    const accessToken = getAccessToken();
    const csrfToken = getCsrfToken();

    if (!form) {
        console.error("Form element not found.");
        return;
    }

    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id'); // Get 'id' from the URL

    if (id) {
        form.action = `/api/paket/${id}`; // Set the action for updating the specific package
        document.querySelector("button[type='submit']").textContent = "Update";

        fetch(`/api/pakets/${id}`, {
            method: "GET",
            headers: {
                'Authorization': `Bearer ${accessToken}`,
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.data) {
                document.getElementById("judul_naskot").value = data.data.nama || '';
                document.getElementById("deskripsi_singkat").value = data.data.deskripsi || '';
                document.getElementById("harga").value = formatRupiah(data.data.harga.toString()) || '';

                if (data.data.foto) {
                    const imagePreviewContainer = document.getElementById("imagePreviewContainer");
                    if (imagePreviewContainer) {
                        const imagePreview = document.createElement('img');
                        imagePreview.src = data.data.foto;
                        imagePreview.alt = "Image preview";
                        imagePreview.style.maxWidth = "200px";
                        imagePreviewContainer.appendChild(imagePreview);
                    }
                }

                selectedIds = data.data.items.map(item => item.id_satuan);
                updateSelectedOptions();
            }
        })
        .catch(error => console.error("Error fetching data:", error));
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Processing...',
            text: 'Please wait while we save your data.',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        const formData = {
            nama: document.getElementById("judul_naskot").value,
            harga: document.getElementById("harga").value.replace(/[Rp.\s]/g, ''), // Remove currency format for submission
            deskripsi: document.getElementById("deskripsi_singkat").value,
            kategori: "nasi_kotak",
            items: [],
            foto: null
        };

        const selectedItems = document.querySelectorAll('.multi-select-option.multi-select-selected');
        formData.items = Array.from(selectedItems)
            .map(item => item.getAttribute("data-value"))
            .join(',');

        const imageFile = document.getElementById("gambar_nasi_kotak").files[0];
        if (imageFile) {
            const reader = new FileReader();
            reader.onloadend = function() {
                formData.foto = reader.result.split(',')[1];
                submitFormData(formData, id);
            };
            reader.readAsDataURL(imageFile);
        } else {
            submitFormData(formData, id);
        }
    });

    function submitFormData(formData, id) {
        const method = id ? 'PATCH' : 'POST';
        const url = id ? `/api/paket/${id}` : '/api/paket';

        fetch(url, {
            method: method,
            headers: {
                'Authorization': `Bearer ${accessToken}`,
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            Swal.close(); // Close loading indicator
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Data Saved',
                text: 'Your data has been successfully saved!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/admin/naskot';
            });
        })
        .catch(error => {
            console.error("Error submitting data:", error);
            Swal.fire({
                icon: 'error',
                title: 'Save Failed',
                text: 'An error occurred while saving your data. Please try again.',
                confirmButtonText: 'OK'
            });
        });
    }

    function formatRupiah(angka, prefix = "Rp ") {
        let number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix + rupiah;
    }

    const hargaInput = document.getElementById("harga");
    if (hargaInput) {
        hargaInput.addEventListener("input", function(event) {
            let value = event.target.value.replace(/[Rp.\s]/g, '');
            event.target.value = formatRupiah(value);
        });
    }
});

function updateSelectedOptions() {
    setTimeout(() => {
        const headerElement = document.querySelector('.multi-select-header');
        const placeholderElement = headerElement.querySelector('.multi-select-header-placeholder');

        if (placeholderElement) {
            placeholderElement.style.display = 'none';
        }

        selectedIds.forEach(id => {
            const optionToSelect = document.querySelector(`.multi-select-option[data-value="${id}"]`);
            if (optionToSelect) {
                optionToSelect.classList.add('multi-select-selected');

                const headerOptionSpan = document.createElement('span');
                headerOptionSpan.classList.add('multi-select-header-option');
                headerOptionSpan.textContent = optionToSelect.querySelector('.multi-select-option-text').textContent;

                headerOptionSpan.style.marginTop = '8px';
                headerOptionSpan.style.marginRight = '8px';

                headerElement.appendChild(headerOptionSpan);
            }
        });
    }, 0);
}

</script>


@endsection
