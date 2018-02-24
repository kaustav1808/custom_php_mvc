<?php
 include_once "asset/header.php";
?>
<link rel="stylesheet" href="<?php echo php_mvc\baseurl()."/php_mvc"; ?>/asset/css/error.css">
</head>
<body>
<hr>
<?php
echo $this->msg;
?>
<div class="error">
    <div class="error-code m-b-10 m-t-20">404 <i class="fa fa-warning"></i></div>
    <h3 class="font-bold">We couldn't find the page..</h3>

    <div class="error-desc">
        Sorry, but the page you are looking for was either not found or does not exist. <br/>
        Try refreshing the page or click the button below to go back to the Homepage.
        <div>
            <a class=" login-detail-panel-button btn" href="<?php echo php_mvc\baseurl();?>/php_mvc/Index/show">
                <i class="fa fa-arrow-left"></i>
                Go back to Homepage
            </a>
        </div>
    </div>
</div>
</body>
<?php
  include_once "asset/footer.php";
?>
</html>