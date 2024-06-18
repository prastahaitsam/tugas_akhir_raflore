<!DOCTYPE html>
<html lang="en">

<head>

    <title>Raflore - Gift Shop</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/user/images/favicon.jpg" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/admin/css/style.css">




</head>

<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <img src="assets/admin/images/logo-dark.png" alt="" class="img-fluid mb-4">
                        <h4 class="mb-3 f-w-400">Register</h4>
                        <form action="register" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="floating-label" for="Username">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" id="Username" placeholder="">
                            </div>
                            <div class="form-group mb-3">
                                <label class="floating-label" for="Email">Email address</label>
                                <input type="text" class="form-control" name="email" id="Email" placeholder="">
                            </div>
                            <div class="form-group mb-4">
                                <label class="floating-label" for="Password">Password</label>
                                <input type="password" class="form-control" name="password" id="Password" placeholder="">
                            </div>
                            <div class="custom-control custom-checkbox  text-left mb-4 mt-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Send me the <a href="#!"> Newsletter</a> weekly.</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
                            <p class="mb-2">Already have an account? <a href="login" class="f-w-400">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="assets/admin/js/vendor-all.min.js"></script>
<script src="assets/admin/js/plugins/bootstrap.min.js"></script>
<script src="assets/admin/js/ripple.js"></script>
<script src="assets/admin/js/pcoded.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($message = Session::get('success'))
<script>
    Swal.fire({
        title: 'Sukses !',
        text: '<?= $message; ?>',
        icon: 'success',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    }).then((result) => {
        window.location.href = '/login';
    })
</script>
@endif

</body>

</html>