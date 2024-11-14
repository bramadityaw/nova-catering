<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <!-- Using Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- My CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/nova_cathering_tab_icon.png') }}" type="image/x-icon" sizes="32x32" />
    <link href="{{asset('css/MultiSelect.css')}}" rel="stylesheet" type="text/css">
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Nova Cathering Admin</title>
    <style>
        textarea {
            width: 100%;
            /* Full width of the container */
            max-width: 100%;
            /* Prevents it from expanding beyond container */
            height: 100px;
            /* Fixed height */
            resize: none;
            /* Disable manual resizing */
            overflow: auto;
            /* Adds a scrollbar if content overflows */
            padding: 10px;
            /* Adds padding inside the textarea */
            font-size: 14px;
            /* Sets a readable font size */
            border: 1px solid #ccc;
            /* Optional: a border for better visibility */
            border-radius: 5px;
            /* Optional: rounded corners */
        }

        textarea:focus{
            outline: none;
            border-color: #F136DB;
        }

    </style>
</head>