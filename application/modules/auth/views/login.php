
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/favicon.png">
    <title>LOGIN - Sistem Penjualan</title>
    
    <!-- page css -->
    <link href="<?= base_url(); ?>assets/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading...</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register radius shadow" style="background-image:url(<?= base_url(); ?>assets/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material text-center" id="login-form" action="<?= base_url(); ?>auth/login/proses_login">
                    <h4><strong>LOGIN SISTEM PENJUALAN</strong></h4>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="login-condition" style="display: none">
                                <div id="login-alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" id="username" required="" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" id="password" required="" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-info btn-block text-uppercase btn-rounded" type="submit">Log In</button>
                            </div>
                            <!-- <div class="col-md-6">
                                <a href="<?= base_url(); ?>auth/registrasi" class="btn btn-success btn-block text-uppercase btn-rounded">Registrasi</a>                            
                            </div> -->
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url(); ?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url(); ?>assets/node_modules/popper/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>

    <script>
        $(function(){
            $("#login-form").submit(function(e) {
                $('#login-condition').hide();
                e.preventDefault();
                var actionurl = $(this).attr('action');
                var data = $(this).serialize(); 
                $.post(actionurl, data, function(res){
                    if (res.status == 'success') {
                        $('#login-condition').show();
                        $('#login-alert').html(res.message);

                        setTimeout(function() {
                            location.href = res.url;
                        }, 1500);
                    } else {
                        $('#login-condition').show();
                        $('#login-alert').html(res.message);
                    }
                }, 'json');
            });
        });
    </script>
    
</body>

</html>