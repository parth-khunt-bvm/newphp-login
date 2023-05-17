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
            /*background-position: center center;*/
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
            background: rgba(90, 90, 90, .5);
        }

        li {
            float: left;
        }

        li a {
            display: inline-block;
            color: orange;
            text-decoration: none;
            text-align: center;
            font-size: 20px;
            padding: 12px 98px;
            text-transform: uppercase;
            /*font-size: 16px;*/
        }

        .active, li a {
            color: white;
        }

        .active, li a:hover {
            background: orange;
            color: white;
            transition: all .6s;
        }

        .user-form input {
            width: 100%;
            display: block;
            margin: 8px 18px;
            padding: 10px 12px;
            font-size: 16px;
            border: 1px solid white;
            height: auto;
            background-color: rgba(237, 235, 250, .1);
            color: #fff;
            box-sizing: border-box;
            /*-webkit-transition: 0.5s;*/
            /*transition: 1s;*/
        }

        input:focus {
            outline: none !important;
            border-color: orange;
            color: white;
        }

        .user-form input[type=submit] {
            border: 2px solid orange;
            background: rgba(0, 0, 0, .8);
            color: orange;
            font-size: 18px;
            padding: 15px 40px;
            transition: all .6s;
            height: auto;
            text-transform: uppercase;
            background-color: rgba(237, 235, 250, .1);
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

        .tab-content > div:last-child {
            display: none;
        }

    </style>
</head>
<body>
<?php

@include "db.php";
session_start();

if (isset($_REQUEST['signup'])) {

    $sql = "insert into user(first_name,last_name,email,phone_number,password) values('" . $_REQUEST['fname'] . "','" . $_REQUEST['lname'] . "', '" . $_REQUEST['email'] . "', '" . $_REQUEST['number'] . "', '" . md5($_REQUEST['password']) . "')";

    if ($conn->query($sql) === TRUE) {
        echo "Record successfully inserted";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
//    header("location: registration.php");
}
?>

<?php

if (isset($_REQUEST['login'])) {

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
        <li class="active tab"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
    </ul>

    <div class="tab-content">

        <div id="signup">
            <div class="text">
                <h1>Sign Up</h1>
            </div>
            <form class="user-form" id="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <div class="grid">
                        <input type="text" name="fname" id="fname" placeholder="First Name">
                        <input type="text" name="lname" id="lname" placeholder="Last Name">
                    </div>
                    <br>
                    <div class="grid-block">
                        <input type="email" name="email" id="email" placeholder="Your Email"><br>

                        <input type="number" name="number" id="number" placeholder="Your Phone"><br>

                        <input type="password" name="password" id="password" placeholder="Password"><br>

                        <input type="submit" value="Sign Up" name="signup">
                    </div>
                    <br>
                </div>
            </form>
        </div>

        <div id="login">
            <div class="text">
                <h1>Log In FOR FREE</h1>
            </div>
            <form class="user-form" id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="grid-block">
                    <input type="email" name="email" id="email" placeholder="Your Email"><br>

                    <input type="password" name="password" id="password" placeholder="Password"><br>

                    <input type="submit" value="Log In" name="login">
                </div>
                <br>
                <!--        <div class="links">-->
                <!--            <a href="">Forgot password</a>-->
                <!--            <a href="index.php">Register</a>-->
                <!--        </div>-->
            </form>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

    $('.tab a').on('click', function (e) {
        e.preventDefault();

        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');

        target = $(this).attr('href');
        console.log(target);

        $('.tab-content > div').not(target).hide();

        $(target).fadeIn(600);

        jQuery(document).ready(function () {
            signup.init()
        });
    });
</script>
</body>
</html>