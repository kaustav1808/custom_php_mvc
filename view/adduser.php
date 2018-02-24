<?php
if(!isset($_SESSION["id"])){
    $location="Location:".php_mvc\baseurl()."/php_mvc/";
    header($location);
}
include_once "asset/header.php";
?>
<link rel="stylesheet" href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/asset/css/dashboard.css">
<link rel="stylesheet" href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/asset/css/pagination.css">
<link rel="stylesheet" href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/asset/css/usertable.css">
</head>
<?php
include_once "view/dashboardtemplate.php";
?>
<div class="container">
    <?php if(isset($this->msg)){?>
    <div class="row" style ="height: 56px; margin-top: 77px;">
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <?php echo $this->msg ;?>
        </div>
    </div>
    <?php }?>
        <div class="row">
            <legend>Add a User</legend>
            <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal" role="form" action="<?php echo php_mvc\baseurl() ;?>/php_mvc/User/addUser" method="post" enctype="multipart/form-data">
                    <fieldset>

                        <!-- Form Name -->

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="textinput">NAME</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="John Doe" name="name" class="form-control" required>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="emailinput">E_MAIL</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" placeholder="email@example.com" class="form-control" required>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="passwordinput">PASSWORD</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" placeholder="password" class="form-control" required>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="fileinput">UPLOAD A PROFILE PICS</label>
                            <div class="col-sm-8">
                                <input type="file" name="photo" placeholder="Upload a pics" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="pull-right">
                                    <a href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/User/addUserForm" type="submit" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div><!-- /.col-lg-12 -->
    </div>
</div>
</body>
<?php
include_once "asset/footer.php";
?>
</html>