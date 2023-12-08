<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <title>Login</title>
</head>

<body style="background-color: #FB4F4F;">
    <div class="container p-3">
        <div class="row justify-content-md-center">
            <div class="col-6 d-flex justify-content-center p-5">
                <img src="assets/img/login-tel.png" alt="login Image" class="img-fluid">
            </div>
            <div class="col-6 align-self-center ">
                <!-- <div class="d-flex align-items-center"> -->
                <div class="card " style="border-radius: 40px;">
                    <div class="card-body m-4">
                        <h1>Selamat Datang!</h1>
                        <p class="mb-5 mt-1">Masukkan email dan password anda</p>
                        <?php if (session()->getFlashdata('msg')) : ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                        <?php endif; ?>
                        <form action="/login/auth" method="post">
                            <div class="input-group mb-3 ">
                                <!-- <label for="InputForEmail" class="form-label">Email address</label> -->
                                <input type="email" name="email" placeholder="Email address" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
                                <span class="input-group-text" id="basic-addon2">@example.com</span>
                            </div>
                            <div class="input-group mb-5">
                                <!-- <label for="InputForPassword" class="form-label">Password</label> -->
                                <input type="password" name="password" placeholder="Password" class="form-control" id="InputForPassword">
                            </div>
                            <div class="d-flex justify-content-center p-0 mb-0">

                                <p class="">Belum punya akun? <a href="/register" class="text-decoration-none">Daftar</a></p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-danger rounded-pill" style="width: 100px; font-weight: 700;">LOG IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>

    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>