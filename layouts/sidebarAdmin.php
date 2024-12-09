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
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class 
            with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="index.php?page=dashboard" class="nav-link">
                    <i class="bi bi-house nav-icon" style="font-size: 2rem; color:606C7D;"></i>
                    <p>Halaman Utama</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?page=pending" class="nav-link">
                    <i class="bi bi-envelope" style="font-size: 2rem; color:606C7D"></i>
                    <span class="badge badge-danger navbar-badge">
                        <?php
                        $query = "SELECT * FROM pelanggaran where status = 'pending'";
                        $result = $db->query($query);
                        echo $result->num_rows;
                        ?>
                    </span>
                    <p>Pending</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?page=verifikasi" class="nav-link">
                    <i class="bi bi-exclamation-circle" style="font-size: 2rem; color:606C7D"></i>
                    <span class="badge badge-danger navbar-badge">
                        <?php
                        $query = "SELECT * FROM pelanggaran where status = 'hold'";
                        $result = $db->query($query);
                        echo $result->num_rows;
                        ?>
                    </span>
                    <p>Menunggu Verifikasi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?page=riwayat" class="nav-link">
                    <i class="bi bi-clock" style="font-size: 2rem; color:606C7D"></i>
                    <p>Riwayat</p>
                </a>
            </li>
            <li class="nav-item border">
                <a href="action/auth.php?act=logout" class="nav-link">
                    <i class="bi bi-box-arrow-right" style="font-size: 2rem; color:606C7D"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>