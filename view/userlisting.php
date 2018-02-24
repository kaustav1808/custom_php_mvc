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
<link rel="stylesheet" href="<?php echo php_mvc\baseurl() . "/php_mvc"; ?>/asset/css/searchbox.css">
</head>
<?php
include_once "view/dashboardtemplate.php";
?>
<?php
if (isset($this->msg)) {
    ?>
    <div class="container">
        <h2>OOPS!</h2>
        <div class="well"><?php
            echo $this->msg;
            ?>
        </div>
    </div>
<?php } else if (!$this->userno) {
    ?>
    <div class="container">
        <h2><i class="fa fa-user-plus" aria-hidden="true"></i>
            You first add people
        </h2>
        <div class="well">
            You did not added any people
        </div>
    </div>
    <?php
} else { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="pagination-wrap">
                    <ul class="pagination pagination-v3">
                        <?php
                        for ($i = 0, $page = 1; $i < $this->userno; $i = $i + 3) {
                            ?>

                            <li>
                                <?php if(isset($this->key)||isset($this->keyval)){ ?>
                                    <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/userlisting/<?php echo $i."/".$this->key."/".$this->keyval; ?>"><?php echo $page; ?></a>
                                <?php }
                                      else{
                                ?>
                                <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/userlisting/<?php echo $i; ?>"><?php echo $page; ?></a>
                                  <?php }?>
                            </li>

                            <?php
                            $page++;
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="search">
                    <form method="post" action="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/userSearch" >
                    <input type="text" name="search" class="form-control input-sm" id="search1" maxlength="64" value=""
                    placeholder="search"/>
                    <button type="submit" id="btn1" class="btn btn-primary btn-sm">Search</button>
                </div>
            </div>
        </div>
    </div>
<div class="container">

        <table class="table table-striped custab">
            <div class="row col-md-6 col-md-offset-2 custyle">
            <thead>
            <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/userListing/0"
               class="btn btn-primary btn-xs pull-right" title="reset sorting"><b>+</b> Reset
            </a>
             <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/addUserForm"
               class="btn btn-primary btn-xs pull-right" style="margin-right: 6px;"><b>+</b> Add new
                user
            </a>
            <tr>
                <th>NAME <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/userListing/0/name/asc">
                          <i class="fa fa-sort-asc" aria-hidden="true" title="name in ascending order"></i>
                          </a>
                         <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/userlisting/0/name/desc">
                         <i class="fa fa-sort-desc" aria-hidden="true" title="name in descending order"></i>
                         </a>
                </th>
                <th>EMAIL
                    <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/userlisting/0/username/asc">
                        <i class="fa fa-sort-asc" aria-hidden="true" title="email in ascending order"></i>
                    </a>
                    <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/userlisting/0/username/desc">
                        <i class="fa fa-sort-desc" aria-hidden="true" title="email in descending order"></i>
                    </a>
                </th>
                <th>IMAGE</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            </div>
            <?php
            while ($row = array_pop($this->userlist)) {
                ?>
                <tr>
                    <div class="row">
                        <div class="col-md-3">
                            <td><?php echo $row["name"] ?></td>
                        </div>

                        <div class="col-md-3">
                            <td><?php echo $row["username"] ?></td>
                        </div>

                        <div class="col-md-3">
                            <td><img src="<?php php_mvc\baseurl(); ?>/php_mvc/asset/profileimage/thumbnail/<?php echo $row["image"] ?>"
                                     alt="Girl in a jacket" style="width:100px;height:50px;border-radius: 10px;"></td>
                        </div>

                        <div class="col-md-3">
                            <td class="text-center">
                                <a class='btn btn-info btn-xs'
                                   href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/editUserForm/<?php echo $row["id"]; ?>">
                                    <span class="glyphicon glyphicon-edit"></span>Edit
                                </a>
                                <a href="<?php echo php_mvc\baseurl(); ?>/php_mvc/User/deleteUser/<?php echo $row["id"]; ?>"
                                   class="btn btn-danger btn-xs">
                                    <span class="glyphicon glyphicon-remove"></span> Delete
                                </a>
                            </td>
                        </div>
                    </div>
                </tr>

                <?php
            }
            }
            ?>
        </table>

</div>
</body>
<?php
include_once "asset/footer.php";
?>
</html>