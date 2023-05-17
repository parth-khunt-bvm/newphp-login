<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            /*width: auto;*/
            height: 919px;
            background-image: url("warsaw.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .container {
            /*background: #1d2124;*/
            /*padding: 8px 0px;*/
            /*background-image: url("warsaw.jpg");*/
            /*background-repeat: no-repeat;*/
            /*background-size: 100% 100%;*/
            /*opacity: 0.8;*/
            background: rgba(0, 0, 0, .8);
            width: 540px;
            /*height: auto;*/
            margin: 50px auto;
            border: 1px solid #666666;
            box-shadow: 1px 1px 1px #666;
            /*border-radius: 5px;*/
        }

        ul {
            list-style-type: none;
            overflow: hidden;
            background: rgba(90,90,90,.5);
        }

        li {
            float: left;
        }

        li a {
            display: inline-block;
            color: white;
            text-decoration: none;
            text-align: center;
            font-size: 20px;
            padding: 12px 103px;
            /*font-size: 16px;*/
        }

        .active, li a {
            color: black;
        }

        .active, li a:hover {
            background: yellow;
            color: black;
            transition: all .6s;
        }

        .user-form input {
            width: 100%;
            display: block;
            margin: 5px 18px;
            padding: 10px 12px;
            font-size: 16px;
            border: 1px solid white;
            height: auto;
            background-color: rgba(237, 235, 250, .1);
            /*color: #fff;*/
        }

        input:focus {
            outline: none !important;
            border-color: yellow;
            color: white;
        }

        .user-form input[type=submit] {
            border: 2px solid orange;
            background: black;
            color: orange;
            padding: 15px 40px;
            font-size: 18px;
            height: auto;
            background-color: rgba(237, 235, 250, .1);
            transition: all .6s;
        }

        .user-form input[type=submit]:hover {
            background: orange;
            color: black;
            font-size: 18px;
            transition: all .6s;
        }

        .links {
            display: table;
            width: 100%;
            box-sizing: border-box;
            border-top: 1px solid #c0c0c0;
            margin-bottom: 10px;
        }

        .links a {
            display: table-cell;
            /*padding-top: 10px;*/
            color: white;
            text-decoration: none;
            padding: 10px 20px;
        }

        .links a:first-child {
            text-align: left;
        }

        .links a:last-child {
            text-align: right;
        }

        .text {
            color: white;
            text-align: center;
            padding: 15px 0;
            /*font-size: 30px;*/
        }

        .user-form .grid {
            display: flex;
        }

        .user-form .grid-block {
            margin-right: 36px;
        }


    </style>
</head>
<body>
<?php

@include "db.php";

session_start();

if (isset($_REQUEST['submit'])) {

    $myusername = mysqli_real_escape_string($conn,$_POST['email']);
    $mypassword = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT id FROM user WHERE email = '$myusername' and password = '$mypassword'";
//    print_r($sql); die();
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        $_SESSION['login_user'] = $myusername;

        header("location:dashboard.php");
    }else {
        $error = "Your Login Name or Password is invalid";
    }
}

?>
<div class="container">
    <ul>
        <li><a href="index.php">Loin In</a></li>
        <li class="active"><a href="registration.php">Sign Up</a></li>
    </ul>

    <form class="user-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="text">
            <h1>SIGN UP FOR FREE</h1>
        </div>
        <div class="grid-block">
            <input type="email" name="email" id="email" placeholder="Your Email"><br>

            <input type="password" name="password" id="password" placeholder="Password"><br>

            <input type="submit" value="SIGN UP" name="submit">
        </div>
        <br>
<!--        <div class="links">-->
<!--            <a href="">Forgot password</a>-->
<!--            <a href="index.php">Register</a>-->
<!--        </div>-->
    </form>
</div>

</body>
</html>