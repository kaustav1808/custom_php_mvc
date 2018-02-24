<?php
if(!isset($_SESSION["id"])){
    $location="Location:".php_mvc\baseurl()."/php_mvc/";
    header($location);
}
include_once "asset/header.php";
?>
<link rel="stylesheet" href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/asset/css/dashboard.css">
</head>
<?php
include_once "view/dashboardtemplate.php";
?>
</body>
<?php
include_once "asset/footer.php";
?>
</html>