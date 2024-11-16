<!-- resources/views/partials/sidebar.blade.php -->
<section id="sidebar">
    <a href="#" class="brand">
        <img src="{{ asset('images/nova_cathering_icon.png') }}" class="img-logo" alt="Logo" />
    </a>
    <ul class="side-menu top">
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard">
                @if(request()->is('dashboard'))
                <img src="{{ asset('images/dashboard_icon.png') }}" class="logo" alt="Dashboard Icon Active" />
                @else
                <img src="{{ asset('images/dashboard_icon_inactive.png') }}" class="logo" alt="Dashboard Icon Inactive" />
                @endif
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="{{ request()->is('admin/naskot') || request()->is('admin/add/naskot') || request()->is('admin/edit/naskot') ? 'active' : '' }}">
            <a href="/admin/naskot">
                @if(request()->is('admin/naskot') || request()->is('admin/add/naskot') || request()->is('admin/edit/naskot'))
                <img src="{{ asset('images/nasi_kotak_icon.png') }}" class="logo" alt="Nasi Kotak Icon Active" />
                @else
                <img src="{{ asset('images/nasi_kotak_icon_inactive.png') }}" class="logo" alt="Nasi Kotak Icon Inactive" />
                @endif
                <span class="text">Nasi Kotak</span>
            </a>
        </li>

        <li class="{{ request()->is('admin/prasmanan') || request()->is('admin/edit/prasmanan') ? 'active' : '' }}">
            <a href="/admin/prasmanan">
                @if(request()->is('admin/prasmanan') || request()->is('admin/edit/prasmanan'))
                <img src="{{ asset('images/prasmanan_icon.png') }}" class="logo" alt="Prasmanan Icon Active" />
                @else
                <img src="{{ asset('images/prasmanan_icon_inactive.png') }}" class="logo" alt="Prasmanan Icon Inactive" />
                @endif
                <span class="text">Prasmanan</span>
            </a>
        </li>

        <li class="{{ request()->is('admin/isimenu') ? 'active' : '' }}">
            <a href="/admin/isimenu">
                @if(request()->is('admin/isimenu'))
                <img src="{{ asset('images/isi_menu.png') }}" class="logo" alt="Isi Menu Icon Active" />
                @else
                <img src="{{ asset('images/isi_menu_inactive.png') }}" class="logo" alt="Isi Menu Icon Inactive" />
                @endif
                <span class="text">Isi Menu</span>
            </a>
        </li>

        <li class="{{ request()->is('admin/ulasan') ? 'active' : '' }}">
            <a href="/admin/ulasan">
                @if(request()->is('admin/ulasan'))
                <img src="{{ asset('images/ulasan_icon.png') }}" class="logo" alt="Ulasan Icon Active" />
                @else
                <img src="{{ asset('images/ulasan_icon_inactive.png') }}" class="logo" alt="Ulasan Icon Inactive" />
                @endif
                <span class="text">Ulasan</span>
            </a>
        </li>

        <li class="{{ request()->is('admin/account') ? 'active' : '' }}">
            <a href="/admin/account">
                @if(request()->is('admin/account'))
                <img src="{{ asset('images/admin_icon.png') }}" class="logo" alt="Admin Icon Active" />
                @else
                <img src="{{ asset('images/admin_icon_inactive.png') }}" class="logo" alt="Admin Icon Inactive" />
                @endif
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

<script>
    // Menunggu sampai DOM sepenuhnya dimuat
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');

    // Fungsi untuk mengatur visibilitas sidebar
    function checkScreenSize() {
        if (window.innerWidth <= 860) {
            sidebar.classList.add('hide'); // Menambahkan class 'hide' jika layar kecil
        } else {
            sidebar.classList.remove('hide'); // Menghapus class 'hide' jika layar lebih besar dari 600px
        }
    }

    // Memanggil fungsi saat halaman dimuat pertama kali
    checkScreenSize();

    // Memantau perubahan ukuran layar
    window.addEventListener('resize', checkScreenSize);
});

</script>


