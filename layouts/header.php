<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .user-panel .info .d-block {
            font-weight: bold;
            color: white;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-grey navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <img src="https://siakad.polinema.ac.id/assets/admin/layout/img/header2.png" alt="siakadLogo.png">

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['name']; ?></a>
                    </div>
                    <div class="image">
                        <img src="src/sadPP.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
