<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            margin-left: 220px; /* Offset for fixed sidebar */
        }
        .sidebar {
            height: 100vh;
            width: 200px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .sidebar h3, .sidebar ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .content-container {
            flex: 1;
            padding: 20px;
        }
        .navbar {
            background-color: #f8f9fa;
            padding: 10px 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
        }
        .sidebar ul ul {
            display: none;
            padding-left: 15px;
        }
        .sidebar ul li:hover > ul {
            display: block;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <ul>
    <li>
        <a href="#" onclick="toggleDropdown(event)">Dashboard</a>
        <ul style="display: none;">
            <li><a href="#">Overview</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Reports</a></li>
        </ul>
    </li>
    <li>
        <a href="#" onclick="toggleDropdown(event)">Users</a>
        <ul style="display: none;">
            <li><a href="{{ url('/show') }}">All Users</a></li>
            @can('role-edit')
            <li><a href="{{ url('/user') }}">Add New User</a></li>
            @endcan
            <li><a href="#">User Roles</a></li>
        </ul>
    </li>
    <li>
        <a href="#" onclick="toggleDropdown(event)">Products</a>
        <ul style="display: none;">
            <li><a href="#">All Products</a></li>
            <li><a href="#">Add New Product</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">Inventory</a></li>
        </ul>
    </li>
    <li>
        <a href="#" onclick="toggleDropdown(event)">Settings</a>
        <ul style="display: none;">
            <li><a href="#">General</a></li>
            <li><a href="#">Security</a></li>
            <li><a href="#">Notifications</a></li>
            <li><a href="#">API Settings</a></li>
        </ul>
    </li>
</ul>

<script>
    function toggleDropdown(event) {
        event.preventDefault();  // Prevent default link behavior
        const dropdown = event.target.nextElementSibling;
        dropdown.style.display = (dropdown.style.display === 'none' || !dropdown.style.display) ? 'block' : 'none';
    }
</script>

    </div>  

    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content-container">
            @yield('content')
        </div>

        <footer class="footer">
            <p>&copy; 2024 Your Company</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

