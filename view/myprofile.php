<?php
if(!isset($_SESSION["id"])){
    $location="Location:".php_mvc\baseurl()."/php_mvc/";
    header($location);
}
include_once "asset/header.php";
?>
<link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css"
      integrity="sha384-Wrgq82RsEean5tP3NK3zWAemiNEXofJsTwTyHmNb/iL3dP/sZJ4+7sOld1uqYJtE" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/asset/css/myprofile.css">
</head>
<?php
include_once "view/dashboardtemplate.php";
?>

<section>
    <div class="container" style="margin-top: 30px;">
        <div class="profile-head">
            <div class="col-md- col-sm-4 col-xs-12">
                <img src="<?php php_mvc\baseurl(); ?>/php_mvc/asset/profileimage/thumbnail/<?php echo $this->row[0]["image"] ; ?>" class="img-responsive" />
                <h6><?php echo $this->row[0]["name"]; ?></h6>
            </div><!--col-md-4 col-sm-4 col-xs-12 close-->


            <div class="col-md-5 col-sm-5 col-xs-12">
                <h5><?php echo $this->row[0]["name"]; ?></h5>
                <ul>
                    <li><span class="glyphicon glyphicon-envelope"></span><?php echo $this->row[0]["username"]; ?></li>
                </ul>
            </div><!--col-md-8 col-sm-8 col-xs-12 close-->
        </div><!--profile-head close-->
    </div><!--container close-->


<!--    <div id="sticky" class="container">-->
<!--        <!-- Nav tabs -->
<!--        <ul class="nav nav-tabs nav-menu" role="tablist">-->
<!--            <li><a href="#change" role="tab" data-toggle="tab">-->
<!--                    <i class="fa fa-key"></i> Edit Profile-->
<!--                </a>-->
<!--            </li>-->
<!--        </ul><!--nav-tabs close-->
<!---->
<!--    </div><!--container close-->

</section><!--section close-->
</body>
<script src="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/asset/js/myprofile.js"></script>
<?php
include_once "asset/footer.php";
?>
</html>