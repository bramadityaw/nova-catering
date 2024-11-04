<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="shortcut icon" href="images/nova_cathering_tab_icon.png" type="image/x-icon" sizes="32x32" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-family: 'Rubik', sans-serif;
        }

        .bg-image {
            background-image: url('images/bg.png');
            height: 100%;
            background-size: cover;
            background-position: center;
            position: fixed;
            width: 100%;
            z-index: -1;
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards;
        }

        .card-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            opacity: 0;
            animation: fadeIn 1s ease-in-out 0.5s forwards;
        }

        .card {
            width: 30%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            padding: 20px;
        }

        .form-group {
            position: relative;
        }

        .input-group {
            position: relative;
        }

        .form-group label,
        .input-group label {
            opacity: 0.15;
            transition: opacity 0.3s ease-in-out;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 0 10px;
            pointer-events: none;
        }

        .form-group input,
        .input-group input {
            padding-left: 10px;
        }

        .form-group input:focus+label,
        .form-group input:not(:placeholder-shown)+label,
        .input-group input:focus+label,
        .input-group input:not(:placeholder-shown)+label {
            opacity: 0;
        }

        .input-group-text {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .form-group button,
        .form-group a {
            width: 100%;
            margin-top: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @media (max-width: 576px) {
            .card {
                width: 80%;
            }
        }

        @media (max-width: 350px) {
            .card {
                width: 100%;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .card {
                width: 60%;
            }
        }
    </style>
</head>

<body>
    <div class="bg-image"></div>

    <div class="card-container d-flex align-items-center justify-content-center">
        <div class="card p-4 shadow">
            <img src="images/logo.png" alt="Logo" style="width: 200px; height: auto; display: block; margin: auto;"><br>
            <h2 class="mb-4 text-left small">LOGIN ADMIN</h2>
            <form id="loginForm">
                <div class="form-group">
                    <input type="text" class="form-control form-control-empty" id="username" required placeholder="Username">
                    <label for="username">Username</label>
                </div>
                <div class="input-group">
                    <input type="password" class="form-control form-control-empty" id="password" required placeholder="Password">
                    <label for="password">Password</label>
                    <span class="input-group-text" onclick="togglePassword('password', 'togglePasswordBtn')">
                        <i class="fa fa-eye" aria-hidden="true" id="togglePasswordBtn"></i>
                    </span>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-success text-left">Masuk</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        function togglePassword(inputId, buttonId) {
            var passwordInput = document.getElementById(inputId);
            var toggleButton = document.getElementById(buttonId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('fa-eye');
                toggleButton.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('fa-eye-slash');
                toggleButton.classList.add('fa-eye');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            fetch('adminAccount.csv')
                .then(response => response.text())
                .then(data => {
                    const users = parseCSV(data);
                    const user = users.find(u => u.username === username && u.password === password);

                    if (user) {
                        // Store the username in localStorage
                        localStorage.setItem('username', username);
                        
                        showSweetAlert("success", "Login Berhasil", "Login berhasil!");
                        setTimeout(function() {
                            // Redirect to admin_dashboard.html or any other page
                            window.location.href = `admin_dashboard.html?username=${encodeURIComponent(username)}`;                         
                        }, 1500);
                    } else {
                        showSweetAlert("error", "Login Gagal", "Username atau password salah.");
                    }
                })
                .catch(error => {
                    console.error('Error fetching the CSV:', error);
                    showSweetAlert("error", "Login Gagal", "Gagal memuat data pengguna.");
                });
        });



        function parseCSV(data) {
            const lines = data.split('\n');
            const users = [];
            lines.forEach(line => {
                const [username, password] = line.split(',');
                if (username && password) {
                    users.push({ username: username.trim(), password: password.trim() });
                }
            });
            return users;
        }

        function showSweetAlert(icon, title, text) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>

</body>

</html>
