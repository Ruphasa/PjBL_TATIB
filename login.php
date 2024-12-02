<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politeknik Negeri Malang Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2c3e50;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container img {
            width: 40%;
            margin-bottom: 20px;
        }
        .login-container .alert {
            background-color: rgba(255, 10, 10, 0.5);
            color: #d35400;
            padding: 10px;
            border-radius: 5px;
            width: 60%;
            margin: 0 auto;
            margin-bottom: 20px;
        }
        .login-container .btn-custom {
            background-color: #e67e22;
            color: white;
        }
        .login-container .btn-custom:hover {
            background-color: #d35400;
        }
        .login-container input[type="text"], .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }
        .login-container input[type="checkbox"] {
            margin-right: 10px;
        }
        .login-container .login-button {
            background-color: #1abc9c;
            color: white;
        }
        .login-container .forgot-password {
            display: block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
        }
        .login-container .footer {
            margin-top: 20px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="https://siakad.polinema.ac.id/assets/global/img/logo-polinema.png" alt="Politeknik Negeri Malang Logo">
        <div class="alert">Masukkan Username dan Password (Menggunakan NIM & password)</div>
        <button class="btn btn-warning btn-block mb-2" style="width: 50%; margin: 0 auto">PEMBAYARAN DAFTAR ULANG</button>
        <button class="btn btn-danger btn-block mb-4" style="width: 45%; margin: 0 auto">LIHAT MEKANISME</button>
        <form>
            <input type="text" placeholder="Username">
            <input type="password" placeholder="Password">
            <div>
                <input type="checkbox" id="show-password">
                <label for="show-password">Tampilkan Password</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
            <a href="#" class="forgot-password">Lupa Password?</a>
        </form>
        <div class="footer">
            2016 © Sistem Informasi Akademik - 3
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
