<?php
$db=mysqli_connect("localhost","root","","fashion_style") or die("Couldnt connect to databse");
include("./inc/header.inc.php");
include("header.php");
  ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/site.css"/>
</head>

<section id='about'>
              <div class='container'>
                <div class='row'>
                  <div class='col s12'>
                    <div class='about-inner'>
                      <div class='row'>
                        <div class = 'col-md-12 col-sm-12 col-xs-12'>
                          <div class="buttons">
                            <button>Party</button>
                            <button>business</button>
                            <button>Travel</button>
                            <button>Sports</button>
                            <button>Casual</button>
                          <hr>
                          </div>
                          <div class='newsFeedPost about-inner-left'>

                            <div class="col-md-6 col-sm-6 col-xs-6">

                              <img src='$profile_pic' class='profile_pic' height='300' width='300'>
                            </div>

                            <div class='col-md-6 col-sm-6 col-xs-6'>
                              <div class='posted-by'>
                                <div class='about-inner-right'>
                                  <h3>$Top</h3>
                                  <h3>$Bottom</h4 >
                                  <p>Description</p>
                                </div>
                              </div>
                              <div>
                                <br><br>
                                <button>I'll wear it</button>
                                <button>Next</button>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>";
</html>
