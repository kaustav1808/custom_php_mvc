<?php
include_once "asset/header.php";
?>
<link rel="stylesheet" href="<?php echo php_mvc\baseurl()."/php_mvc"; ?>/asset/css/registration.css">
</head>
<body>
<div class="container">
    <form class="form-horizontal" role="form" method="POST" action="<?php echo php_mvc\baseurl()."/php_mvc"; ?>/Index/register" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Register New User</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">Name</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text" name="name" class="form-control" id="name"
                               placeholder="John Doe" required autofocus>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put name validation error messages here -->
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="email">E-Mail Address</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                        <input type="email" name="email" class="form-control" id="email"
                               placeholder="you@example.com" required autofocus>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put e-mail validation error messages here -->
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Password</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <input type="password" name="password" class="form-control" id="password"
                               placeholder="Password" required>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
<!--                            <i class="fa fa-close"> Example Error Message</i>-->
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Upload profile pics</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-picture-o"></i></div>
                        <input type="file" name="photo" class="form-control" id="photo"
                               placeholder="upload your pics">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
<!--                            <i class="fa fa-close"> Example Error Message</i>-->
                        </span>
                </div>
            </div>
        </div>
<!--        <div class="row">-->
<!--            <div class="col-md-3 field-label-responsive">-->
<!--                <label for="password">Confirm Password</label>-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--                <div class="form-group">-->
<!--                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">-->
<!--                        <div class="input-group-addon" style="width: 2.6rem">-->
<!--                            <i class="fa fa-repeat"></i>-->
<!--                        </div>-->
<!--                        <input type="password" name="password-confirmation" class="form-control"-->
<!--                               id="password-confirm" placeholder="Password" required>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <small>(*password must be number and alphabets)</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>

            <div class="clearfix">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success"><i class="fa fa-user-plus"></i> Register</button>
                </div>
                <div class="col-md-2">
                    <a href="<?php echo php_mvc\baseurl()."/php_mvc"; ?>/Index/show" class="btn btn-info"><i class="fa fa-sign-in"></i> Login</a>
                </div>
            </div>

        </div>
    </form>
</div>
</body>
<?php
include_once "asset/footer.php";
?>
</html>