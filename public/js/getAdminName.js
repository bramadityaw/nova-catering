// Function to get the access token from session storage
function getAccessToken() {
    return sessionStorage.getItem('access_token');
}

// Function to get the user_id from session storage
function getUserId() {
    return sessionStorage.getItem('user_id');
}

// Check for access token on page load
window.onload = function() {
    const accessToken = getAccessToken();

    // Redirect to login if token is not found
    if (!accessToken) {
        window.location.href = '/login'; // Redirect if token is not found
    } else {
        // If access token exists, fetch user name
        fetchUserName();
    }
};

// Function to fetch user name using the user ID
function fetchUserName() {
    const userId = getUserId(); // Get the user_id from session storage
    const accessToken = getAccessToken(); // Get the access token

    if (!userId) {
        console.error('User ID is not available in session storage');
        return;
    }

    fetch('/api/user/name', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${accessToken}`, // Access token as Bearer token
            'user_id': userId // Include user_id in headers
        }
    })
    .then(response => {
        if (!response.ok) {
            console.error('Failed to fetch user name with status:', response.status);
            return response.text().then(text => {
                console.error('Response body:', text);
                throw new Error('Request failed');
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('User name fetched successfully:', data);
        // Update the span with ID admin_name with the fetched user name
        const adminNameElement = document.getElementById('admin_name');
        if (adminNameElement) {
            adminNameElement.textContent = data.name;
        } else {
            console.error('Element with ID "admin_name" not found');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Fungsi untuk mendapatkan nilai cookie berdasarkan nama
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

// Fungsi logout
function logout() {
    const accessToken = getAccessToken();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/api/logout', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${accessToken}`,
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error('Logout failed');
    })
    .then(data => {
        console.log('Logout successful:', data);
        sessionStorage.removeItem('access_token');
        sessionStorage.removeItem('token_type');
        sessionStorage.removeItem('user_id');  
        
        Swal.fire({
            title: 'Logout Berhasil',
            text: 'Anda telah berhasil logout dari sistem.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/login';
        });
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Logout Gagal',
            text: 'Terjadi kesalahan saat logout. Silakan coba lagi.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
}
// Tambahkan event listener pada tombol logout
document.getElementById('logoutButton').addEventListener('click', function(e) {
    e.preventDefault(); // Cegah aksi default
    logout(); // Panggil fungsi logout
});
