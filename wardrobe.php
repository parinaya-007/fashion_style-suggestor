<?php
echo "hello its Wardrobe";
//$db=mysqli_connect("localhost","root","root","amit") or die("Couldnt connect to databse");
include("inc/header.inc.php");
// include("header.php");
if($user)
{
//echo "Hi ".$user."!";
}
else
{
	die("you must be logged in to view this page!");
}
?>
<?php
$senddata = @$_POST['senddata'];
$old_password = @$_POST['oldpassword'];
$new_password = @$_POST['newpassword'];
$repeat_password = @$_POST['newpassword2'];

if($senddata)
{

	$password_query = mysqli_query($db,"SELECT * FROM users WHERE username='$user'");
	if($password_query)
	{
		$row_count = mysqli_num_rows($password_query);
		if($row_count != 0)
		{
			while($rowdb=mysqli_fetch_array($password_query,MYSQLI_ASSOC))
			{
				$db_password = $rowdb['password'];
				if($old_password == $db_password)
				{
					echo "password matches</br>";
					if($new_password == $repeat_password)
					{
						echo "new passwords match</br>";
						$password_update="UPDATE users SET password='$new_password' WHERE username ='$user'";
						if(mysqli_query($db,$password_update))
						{
							echo "success";
						}
						else
						{
							echo "error updating";
						}
					}
					else
					{
						echo "two new passwords dont match";
					}
				}
				else
				{
					echo "the old password is incorrect";
				}
			}
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "query didnt work";
	}
}

else
{
	//echo "Please submit some data";
  echo "<br/>";
}

//check whether a profile pic has been uploaded or not
//$profile_pic = "img/default_pic.jpg";

$check_pic=mysqli_query($db,"SELECT profile_pic FROM users WHERE username = '$user'");
$get_pic_row = mysqli_fetch_array($check_pic,MYSQLI_ASSOC);
$profile_pic_db = $get_pic_row['profile_pic'];

		if($profile_pic_db == "")
		{
			$profile_pic = "img/downloaded.png";
		}
		else
		{
			$profile_pic = "userdata/profile_pics/".$profile_pic_db;
		}


if(isset($_FILES['profilepic']))
{
	if((((@$_FILES["profilepic"]["type"])=="image/jpeg")|| (@$_FILES["profilepic"]["type"]=="image/png")|| (@$_FILES["profilepic"]["type"]=="image/gif"))&&(@$_FILES["profilepic"]["size"]<1048576))// 1 megabyte
{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$rand_dir_name = substr(str_shuffle($chars), 0,15);
	//echo $rand_dir_name;
	mkdir("userdata/profile_pics/$rand_dir_name");

	if(file_exists("userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"]))
	{
		echo @$_FILES["profilepic"]["name"]."Already exists";

	}
	else
	{
		move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"userdata/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);
		$profile_pic_name = @$_FILES["profilepic"]["name"];
		//echo "Uploaded and stored in : userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"];
		$profile_pic_sql = mysqli_query($db,"UPDATE users SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE username='$user'");
    if($profile_pic_sql)
		{
			header("Location :account_settings.php");
		}

		else
		{
			echo "error uploading dp";
		}
  }
	}
  else
  {
    echo "Invalid file! Your file should be less than 1Mb and it must be either a .jpg , .jpeg , .png , .gif";
  }
}

else
{
	//echo "Update your profile pic";
}


?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Phocus : Account Settings</title>
     <!--Favicon -->
    <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico"/>
     <!--Font Awesome-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
     <!--Bootstrap -->
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
  <section id="contact">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="title-area">
              <h2 class="title">Edit Wardrobe</h2>
              <hr/>
            </div>
         </div>
         <div class="col-md-12">
           <div class="cotact-area">
             <div class="row">

               <?php
               $senddata=@$_POST['senddata'];

               $get_info=mysqli_query($db,"SELECT * FROM users WHERE username='$user'" );
                $get_row=mysqli_fetch_array($get_info,MYSQLI_BOTH);
                $db_cloth=$get_row['cloth'];
                $db_color=$get_row['shade'];
                $db_length=$get_row['length'];
                $db_fitting=$get_row['fit'];

                echo $db_fitting;
                $cloth="";
                $color="";
                $length="";
                $fitting="";




               //submit what user types into the database
               if ($senddata) {
                # code...
                $yourname=@$_POST['pname'];
                $age=@$_POST['page'];
                $phone=@$_POST['pphone'];
                $email=@$_POST['pemail'];
                //echo $yourname;



                if (strlen($yourname)<3) {
                  # code...
                  echo "Your name must be 3 characters long";
                }
                else
                   {
                    # code...
                    //submit the form to the database
                    $update_submit_query=mysqli_query($db,"UPDATE users SET  about_me='$aboutme'  WHERE username='$user'");
                    $update_submit_query=mysqli_query($db,"UPDATE users SET  bio='$bio'  WHERE username='$user'");
                    $update_submit_query=mysqli_query($db,"UPDATE users SET  skills='$skills'  WHERE username='$user'");
                    $update_submit_query=mysqli_query($db,"UPDATE users SET  education='$education'  WHERE username='$user'");
                    //echo "Your profile has been updated:" ;
                    header("Location:home.php");
                  }

               }
               else
               {
                //Do nothing
               }
               ?>

               <div class="col-md-8">
                 <div class="contact-area-right">
                   <form action="" class="comments-form contact-form" method="post">
                    <div class="form-group">Cloth:
											<select name="cloth">
											  <option value="fshirt">Formal Shirt</option>
											  <option value="cshirt">Casual Shirt</option>
											  <option value="tshirt">T-shirt</option>
											  <option value="trouser">Trouser</option>
											  <option value="jacket">Jacket</option>
											</select>

                    </div>
                    <div class="form-group">Color:
											<select name="shade">
											  <option value="light">Light</option>
											  <option value="dark">Dark</option>
											</select>
                    </div>

                     <div class="form-group">Sleeve length:
											 <select name="length">
											   <option value="full">Full</option>
											   <option value="half">half</option>
											 </select>
                    </div>

                    <div class="form-group">Fitting:
											<select name="fit">
											  <option value="tight">Tight</option>
											  <option value="loose">Loose</option>
											</select>
                    </div>

                    <button  type="submit" name="senddata" value="Update" class="comment-btn">Add	</button>
                  </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
  </section>
  <!-- End contact section  -->


<div class="title-area">
<hr/>
              <h3 class="title">Change your password</h3>
              <hr/>
              <span class="line"></span>

            </div>

<div class="col-md-8">
                 <div class="contact-area-right" >
                   <form  action="account_settings.php" class="comments-form contact-form" method="post">
                    <div class="form-group">Yor old password:
                      <input type="password" class="form-control " name="oldpassword" placeholder="old password" id="oldpassword"
                      >
                    </div>
                    <div class="form-group">new password:
                      <input type="password" class="form-control" name="newpassword" placeholder="newpassword"  id="nwepassword"
                      >
                    </div>
                     <div class="form-group">Repeat password:
                      <input type="password" class="form-control" name="newpassword2" placeholder="repeat password" id="newpassword"
                      >
                    </div>

                    <button  type="submit" name="senddata" value="Save changes" id="senddata" class="comment-btn">Change password</button>
                  </form>
                 </div>
               </div>

             </div>
           </div>
         </div>
       </div>
     </div>


<?php
include("footer.php");
?>

</body>
</html>
