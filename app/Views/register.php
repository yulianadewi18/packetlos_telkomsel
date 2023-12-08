<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <title>Register</title>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<title>Register</title>

<body style="background-color: #FB4F4F;">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-6 d-flex justify-content-center p-5">
                <img src="assets/img/regis-tel.png" alt="login Image" class="img-fluid">
            </div>

            <div class="col-6 align-self-center">
                <div class="card p-3" style="border-radius: 40px;">
                    <div class="card-body mx-4 p-4">
                        <div class="text-center mb-3 pb-2">
                            <h1>Buat Akun Baru</h1>
                            <p>Lengkapi data diri anda!</p>
                        </div>

                        <?php if (isset($validation)) : ?>
                            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                        <?php endif; ?>
                        <form action="/register/save" method="post">
                            <div class="input-group input-group-sm mb-3">
                                <!-- <label for="InputForName" class="form-label">Name</label> -->
                                <input type="text" name="name" placeholder="Name" class="form-control" id="InputForName" value="<?= set_value('name') ?>">
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <!-- <label for="InputForEmail" class="form-label">Email address</label> -->
                                <input type="email" name="email" placeholder="Email Address" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <!-- <label for="InputForPassword" class="form-label">Password</label> -->
                                <input type="password" name="password" placeholder="Password" class="form-control" id="InputForPassword">
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <!-- <label for="InputForConfPassword" class="form-label">Confirm Password</label> -->
                                <input type="password" name="confpassword" placeholder="Confirm Password" class="form-control" id="InputForConfPassword">
                            </div>
                            <div class="input-group input-group-sm mb-4">
                                <!-- <label for="InputForKabupaten" class="form-label">Kabupaten</label> -->
                                <input type="kabupaten" name="kabupaten" placeholder="Kabupaten" class="form-control" id="InputForKabupaten">
                            </div>
                            <div class="d-flex justify-content-center p-0 mb-0">
                                <p class="">Sudah punya akun? <a href="/" class="text-decoration-none">Masuk</a></p>
                            </div>
                            <div class="d-flex justify-content-center p-0 mb-0">
                                <button type="submit" class="btn btn-danger rounded-pil" style="width: 100px; font-weight: 700;">Register</button>
                            </div>

                        </form>
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