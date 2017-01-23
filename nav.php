<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./info_goc.php">GoC</a>
    </div>
    <ul class="nav navbar-nav">
	  <a href="./newpost.php"><button class="btn btn-danger navbar-btn navbar-left" <?php// if($_SESSION['facebook_access_token']!= ""){echo "disabled"} ?>New post</button></a>
    </ul>
	<form class="navbar-form navbar-right" style="margin-right:1%;">
      <div class="input-group">
	<form method="post">
        <input type="text" name="search" class="form-control" placeholder="Search" disabled>
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit" name="search-submit" disabled>
            <i class="glyphicon glyphicon-search"></i>
          </button>
	</form>
        </div>
      </div>
    </form>	
	<ul class="nav navbar-nav navbar-right">
	  <li <?php if(basename($_SERVER['PHP_SELF']) === 'home.php'){ echo "class='active'"; }?> ><a href="./home.php">Home</a></li>
	  <li <?php if(basename($_SERVER['PHP_SELF']) === 'account.php'){ echo "class='active'"; }else{ echo "class='dropdown'";}?> ><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['login_user']; ?> <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./my_account.php">View account</a></li>
          <li><a href="./change_info.php">Change info</a></li>
        </ul>
      </li>
	  <li><a href="logout_function.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	</ul>
  </div>
</nav>

