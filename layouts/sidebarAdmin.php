<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .nav-link {
            display: flex;
            /* Elemen menjadi fleksibel */
            align-items: center;
            gap: 10px;
            /* Memberikan jarak antar elemen */
            color: #606C7D;
            text-decoration: none;
            padding: 10px 15px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class 
            with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="adminIndex.php?page=dashboard" class="nav-link">
                        <i class="bi bi-house nav-icon" style="font-size: 2rem; color:606C7D;"></i>
                        <p>Halaman Utama</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="adminIndex.php?page=pending" class="nav-link">
                        <i class="bi bi-envelope" style="font-size: 2rem; color:606C7D"></i>
                        <p>Pending</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="adminIndex.php?page=verifikasi" class="nav-link">
                        <i class="bi bi-exclamation-circle" style="font-size: 2rem; color:606C7D"></i>
                        <p>Verifikasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="adminIndex.php?page=riwayat" class="nav-link">
                        <i class="bi bi-clock" style="font-size: 2rem; color:606C7D"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
                <li class="nav-item border">
                    <a href="../action/auth.php?act=logout" class="nav-link">
                        <i class="bi bi-box-arrow-right" style="font-size: 2rem; color:606C7D"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</body>

</html>