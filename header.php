<?php
$db=mysqli_connect("localhost","root","","fashion_style") or die("Couldnt connect to database");
//include("./inc/header.inc.php");
?>

<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!--<title>Phocus : Home</title>-->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico"/>
    <!-- Font Awesome -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css"/>
    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css"/>
    <!-- Progress bar  -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-progressbar-3.3.4.css"/>
     <!-- Theme color -->
    <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">

    <!-- Main Style -->
    <link href="style.css" rel="stylesheet">

    <!-- Fonts -->

    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Lato for Title -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <!-- BEGAIN PRELOADER -->
  <!--<div id="preloader">
    <div id="status">&nbsp;</div>
  </div>-->
  <!-- END PRELOADER -->

  <!-- SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header -->
  <header id="header">
    <!-- header top search -->

    <div class="header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-sm-5 col-xs-5">
            <form action="" method="post">
              <div class="headersearch" id="headersearch">

            </div>
            </form>
          </div>

          <?php
          if(!$user){
          echo '<div class="col-md-6 col-sm-6 col-xs-6">
            <div class="header-login">
              <a class="login modal-form" data-target="#login-form" data-toggle="modal" href="#">Login / Sign Up</a>
            </div>
          </div>';
          }
          else
          {
            echo '<div class="col-md-6 col-sm-6 col-xs-6">
                <div class="header-login">
                  <a class="login modal-form" href="wardrobe.php">Wardrobe</a>
                </div>
              </div>';
          }
          ?>
        </div>
      </div>
    </div>
  </header>
  <!-- End header -->

  <?php
$user_log='';
$password_log='';
$user_log=@$_POST['user_login'];
$password_log=@$_POST['password_login'];
if($user_log!='' && $password_log!='')
{
  echo "data has been entered";
  $sql="SELECT id FROM users WHERE username='$user_log' AND password='$password_log' LIMIT 1";
  if($selectid=mysqli_query($db,$sql))
  {
    $userCount=mysqli_num_rows($selectid);
    //echo "num of rows=".$userCount;
    if($userCount == 1)
    {
      $resu=mysqli_query($db,$sql);
      while($rows= mysqli_fetch_array($resu,MYSQLI_BOTH))
      {
        $id=$rows["id"];
        //echo "IDDDDDDDDDDDDD=".$id;
        //echo "username:".$user_log;

      }
      $_SESSION['user_log'] = $user_log;

      //echo "sessiong==".$_SESSION['user_log'];
      header("Location: home.php");
      //exit();

      //echo "string";

      $new="SELECT email FROM users WHERE username='$user_log' AND password='$password_log' ";
      $result = $db->query($new);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  " - Email: " . $row["email"] ;
    }
} else {
    //header("Location: index.php");
    echo "0 results";
}
$db->close();

    }
    else
    {
      header("Location: index.php");
      echo 'That information is incorrect,try again';
      exit();
    }
  }
    echo "logged in";
}
?>
  <!-- Start login modal window -->
  <div aria-hidden="false" role="dialog" tabindex="-1" id="login-form" class="modal leread-modal fade in">
    <div class="modal-dialog">
      <!-- Start login section -->
      <div id="login-content" class="modal-content">
        <div class="modal-header">
          <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><i class="fa fa-unlock-alt"></i>Login</h4>
        </div>
        <div class="modal-body">
          <form  method="POST">
            <div class="form-group">
              <input type="text" name="user_login" placeholder="User name" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password_login" placeholder="Password" class="form-control">
            </div>
             <div class="loginbox">
              <label><input type="checkbox"><span>Remember me</span></label>
              <input type="submit" name="login" value="sign in">
            </div>
          </form>
        </div>
        <div class="modal-footer footer-box">
          <a href="#">Forgot password ?</a>
          <span>No account ? <a id="signup-btn" href="#">Sign Up.</a></span>
        </div>
      </div>
<?php
$reg=@$_POST['reg'];
$name = "";
$un = "";
$em = "";
$pswd = "";
$pswd2 = "";
$d = "";
$u_check = "";

$name = strip_tags(@$_POST['name']);
$un = strip_tags(@$_POST['username']);
$em = strip_tags(@$_POST['email']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("Y-m-d");


     if($reg)
     {

    //echo "HELLO";
    $query= "SELECT username FROM users WHERE username='$un'";
    mysqli_query($db,$query);
    $res=mysqli_query($db,$query);
    $row=mysqli_fetch_array($res);
    //echo "anything :";
    //echo "hello".$row['username'];
//    $query=mysqli_query("$db","SELECT username FROM users WHERE username='$un'") or die("error querying");
///   echo "query=";
///   echo $query;
    //$res=mysqli_query($db,$query);
    //$row=mysqli_fetch_array($res);
    //$check = mysqli_num_rows($res);
    //echo $res;
    if(empty($row['username'])==TRUE)
    {
       if($name&&$un&&$em&&$pswd&&$pswd2)
      {
        if($pswd==$pswd2)
        {
          if(strlen($un)>25||strlen($name)>25)
          {

            echo "<h2>the maximum limit for username/first name/last name is 25 characters!</h2>";
          }
          else
          {
            if(strlen($pswd)>30||strlen($pswd)<5)
            {

              echo "<h2>Your password must be between 5 and 30 characters long!</h2>";
            }
            else
            {
              //$pswd=md5($pswd);
              //$pswd2=md5($pswd2);


              $sq= "INSERT INTO users(username,last_name,email,password,sign_up_date) VALUES('$un','$name','$em','$pswd','$d')";
              if(mysqli_query($db,$sq))
              {

                echo '<div data-target="#login-form" data-toggle="modal" >
                <h2 >New record created succesfully</h2>
                 <h2>Now please login</h2></div>';
              }
              else
              {
                echo "error".$sq.mysqli_error($db);
              }
              //mysqli_close($db);
              //mysqli_query($db,$query) or die("error inserting");

              //$query = mysqli_query("INSERT INTO users(username,first_name,last_name,email,password,sign_up_date,activated) VALUES('$un','$fn','$ln','$em','$pswd','$d','0')");
              //die("<h2>Welcome to find friends</h2> Login to your account to get started... ");
            }
          }
        }
        else
        {
          //$error1=3;
          //header("Location:index.php");
          echo "<h2>passwords dont match</h2>";
        }
      }
      else
      {

        //$error1=4;
        //header("Location:index.php");
        echo "<h2>Please fill in all the fields</h2>";
      }
    }
    else
    {
      //$error1=5;
      //header("Location:index.php");
      echo "<h2>username already exists</h2>";
    }
}
?>

      <!-- Start signup section -->
      <div id="signup-content" class="modal-content">
        <div class="modal-header">
          <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><i class="fa fa-lock"></i>Sign Up</h4>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="form-group">
              <input type="text" placeholder="Name" name="name" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" placeholder="Username" name="username" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" placeholder="Email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" name="password" class="form-control">
            </div>
       <div class="form-group">
              <input type="password" placeholder="Password (again)" name="password2" class="form-control">
            </div>

            <div class="signupbox">
              <span>Already got account? <a id="login-btn" href="#">Sign In.</a></span>
            </div>
            <div class="loginbox">
              <label><input type="checkbox"><span>Remember me</span><i class="fa"></i></label>
              <input type="submit" name="reg" value="sign up">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End login modal window -->

  <!-- BEGIN MENU -->
  <section id="menu-area">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

          </button>
          <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" alt="logo"></a>
        </div>



        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
          <?php
if(!$user){
echo '<li><a href="index.php">Home</a></li>';
//echo '<li><a href="index.php">Profile</a></li>';
}
else
{
echo '<li><a href="home.php">Today\'s Suggestion</a></li>';

//echo '<li><a href="trending.php">Trending</a></li>';
}
?>
          </ul>
        </div>
      </div>
    </nav>
  </section>
  <!-- END MENU -->



  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!-- Bootstrap -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- Slick Slider -->
  <script type="text/javascript" src="assets/js/slick.js"></script>
 <!-- counter -->
  <script src="assets/js/waypoints.js"></script>
  <script src="assets/js/jquery.counterup.js"></script>
  <!-- Wow animation -->
  <script type="text/javascript" src="assets/js/wow.js"></script>
  <!-- progress bar   -->
  <script type="text/javascript" src="assets/js/bootstrap-progressbar.js"></script>


  <!-- Custom js -->
  <script type="text/javascript" src="assets/js/custom.js"></script>



  </body>
</html>
