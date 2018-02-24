<?php
include_once "asset/header.php";
?>
<link rel="stylesheet" href="<?php echo php_mvc\baseurl()."/php_mvc"; ?>/asset/css/login.css">
</head>
<body>
<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">

    <?php if(isset($this->msg)){?>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <?php echo $this->msg?>
    </div>
    <?php }?>

    <?php if(isset($this->msg2)){?>
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <?php echo $this->msg2?>
        </div>
    <?php }?>

    <form class="form-signin" action="<?php echo php_mvc\baseurl();?>/php_mvc/Index/login" method="post">
        <h1 class="form-signin-heading text-muted">Sign In</h1>
        <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
        <small>(*password must be number and alphabets)</small>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Sign In
        </button>
        <a class="btn btn-lg btn-primary btn-block" href="<?php echo php_mvc\baseurl()."/php_mvc"; ?>/Index/showRegistration">Register</a>
    </form>


</div>
</body>
<?php
include_once "asset/footer.php";
?>
</html>