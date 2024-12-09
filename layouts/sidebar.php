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
                <a href="" class="nav-link">
                    <i class="bi bi-house nav-icon" style="font-size: 2rem; color:606C7D;"></i>
                    <p>Halaman Utama</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="bi bi-chat-left nav-icon" style="font-size: 2rem; color:606C7D;"></i>
                    <p>Pesan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="bi bi-people" style="font-size: 2rem; color:606C7D"></i>
                    <p>Umum</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="bi bi-book" style="font-size: 2rem; color:606C7D;"></i>
                    <p>Akademik</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="bi bi-cash-stack" style="font-size: 2rem; color:606C7D;"></i>
                    <p>UKT</p>
                </a>
            </li>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="bi bi-envelope" style="font-size: 2rem; color:606C7D"></i>
                    <p>Surat & Kuisoneir</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="bi bi-mortarboard-fill" style="font-size: 2rem; color:606C7D"></i>
                    <p>Tingkat Akhir</p>
                </a>
            </li>
            </li>
            <li class="nav-item">
                <a href="index.php?page=pelanggaranmu" class="nav-link">
                    <i class="bi bi-exclamation-circle" style="font-size: 2rem; color:606C7D"></i>
                    <span class="badge badge-danger navbar-badge">
                    <?php
                    $query = "SELECT * FROM pelanggaran where status = 'ongoing' or status = 'revisi'";
                    $result = $db->query($query);
                    echo $result->num_rows;
                    ?>
                    </span>
                    <p>Pelanggaran</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?page=lapor" class="nav-link">
                    <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color:606C7D"></i>
                    <p>Laporkan</p>
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