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
    <div class="row">
        <?php if(isset($this->msg)){?>
            <div class="row" style ="height: 56px; margin-top: 77px;">
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $this->msg ;?>
                </div>
            </div>
        <?php }
          else{
        ?>
        <legend>Edit the User</legend>
        <div class="col-md-4 col-md-offset-4">
            <form class="form-horizontal" action='<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/User/editUser/<?php echo $this->id; ?>' method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <!-- Username -->
                        <label class="control-label"  for="name">NAME</label>
                        <div class="controls">
                            <input type="text" id="username" name="name" value="<?php echo $this->row[0]["name"];?>" class="input-xlarge">
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- E-mail -->
                        <label class="control-label" for="email">E-MAIL</label>
                        <div class="controls">
                            <input type="email" id="email" name="email" value="<?php echo $this->row[0]["username"];?>" class="input-xlarge" required>
                            <p class="help-block">Please provide your E-mail</p>
                        </div>
                    </div>

<!--                    <div class="control-group">-->
<!--                        <!-- Password-->
<!--                        <label class="control-label" for="password">PASSWORD</label>-->
<!--                        <div class="controls">-->
<!--                            <input type="password" id="password" name="password" value="" class="input-xlarge" required>-->
<!--                            <p class="help-block">Password should be alphabet or number</p>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="control-group">
                        <!-- Password -->
                        <label class="control-label"  for="photo">Upload a pic</label>
                        <div class="controls">
                            <img src="<?php php_mvc\baseurl(); ?>/php_mvc/asset/profileimage/thumbnail/<?php echo $this->row[0]["image"] ?>"
                                 alt="Girl in a jacket" style="width:100px;height:50px;border-radius: 10px;"><br><br>
                            <input type="file" id="photo" name="photo" class="input-xlarge">
                            <br>
                            <br>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Button -->
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="controls">
                                    <button class="btn btn-info" style ="background-color: #33798e;">Edit</button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="controls">
                                    <a href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/User/UserListing/0" class="btn btn-info" style ="background-color:#cccccc;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div><!-- /.col-lg-12 -->
        <?php }?>
    </div>
</div>
</body>
<?php
include_once "asset/footer.php";
?>
</html>