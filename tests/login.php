<?php
/*
 * login.php
 *
 * Copyright 2019 Xavier Humbert <xavier.humbert@ac-nancy-metz.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */


session_start();

require_once "config.php";

$userErr = $pwdErr = $rememeberErr = "";
$user = $pwd = $remember = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	print "Stored user is $userName";
	$user = test_input($_POST["user"]);
	$pwd = test_input($_POST["pwd"]);
	$remember =  test_input($_POST["remember"]);

	if ( !empty($_POST["user"]) && !empty($_POST["pwd"])){
		if(validPassword($user, $pwd)) {
			$_SESSION ['user'] = $user;
			header("Status: 301 Moved Permanently", false, 301);
			header('Location: redir.php');









		}

	}
}

function validPassword($u, $p) {
	if ($u != $userName) {
		print "Bad username $u != $userName";
		return false;
	}else if (password_verify ($p, $passwordHash )) {
		return true;
	} else {
		return false;
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
	margin:auto;
	padding:10;
	width:630px;
	line-height: 1.5em;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	background: #ffffff;
	font-family: Arial, Helvetica, sans-serif;
}

form {
	border: 3px solid #f1f1f1;
}


input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color:img_avatar2.png white;
  paddinimg_avatar2.pngg: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align:img_avatar2.png center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
  background: #ffffff;
  border: 1px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<form action="/testgui/login.php" method="post">
  <div class="imgcontainer">
    <img src="ZFSbanner2.jpg" alt="logo" class="logo">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="user" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pwd" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>
</html>
