<body>

<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/Dashboard">
                <img src="<?php php_mvc\baseurl(); ?>/php_mvc/asset/image/mylogo.png" style="margin-top: -82px;margin-left: -62px" alt="Girl in a jacket">
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
                        <img src="<?php php_mvc\baseurl(); ?>/php_mvc/asset/profileimage/thumbnail/<?php echo $_SESSION["image"] ?>"
                             alt="Girl in a jacket" style="width:100px;height:50px;border-radius: 10px;">
                    </a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <li><a href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/Dashboard/myProfile"><i class="fa fa-user-secret"></i> My Profile</a></li>
                        <li><a href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/Dashboard/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <p style="color: ghostwhite;margin-top:16px;">WELCOME <?php echo $_SESSION["name"]; ?></p>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>

<!-- /Header -->

<!-- Main -->

<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
    <ul class="nav nav-pills nav-stacked" style="border-right:1px solid black">
        <!--<li class="nav-header"></li>-->
        <li><a href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/User/userListing/0"><i class="fa fa-users" aria-hidden="true"></i>
                User listing</a></li>
        <li><a href="<?php echo php_mvc\baseurl() ; ?>/php_mvc/User/addUserForm"><i class="fa fa-user-plus" aria-hidden="true"></i> Add user</a></li>
<!--        <li><a href="#"><i class="fa fa-history"></i> Redeem History</a></li>-->
<!--        <li><a href="#"><i class="fa fa-lock"></i> Change Password</a></li>-->

    </ul>
</div><!-- /span-3 -->
<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    <!-- Right -->

    <a href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/Dashboard"><strong><span class="fa fa-dashboard"></span> My Dashboard</strong></a>
    <hr>
</div>
