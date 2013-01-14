<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <title><?php echo $title ?></title>

    <link href="/static/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }
    </style>


</head>

<body>

<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/tasklist">Webpomodoro</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li <?php if(!empty($_SESSION['active_menu']) & $_SESSION['active_menu'] == 'tasklist') echo "class='active'"; ?>><a href="/tasklist">Tasks</a></li>
                    <li <?php if(!empty($_SESSION['active_menu']) & $_SESSION['active_menu'] == 'statistics') echo "class='active'"; ?>><a href="/statistics">Statistics</a></li>
                    <li><a href="/tasklist?quit">Logout <?php if(!empty($_SESSION['logged_in_user'])) echo '('.$_SESSION['logged_in_user'].')'; ?></a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">

   <script src="/static/js/jquery.js"></script>
   <script src="/static/js/bootstrap.min.js"></script>
   <?php echo $content.PHP_EOL ?>

</div> <!-- /container -->

<script src="//loginza.ru/js/widget.js" type="text/javascript"></script>

<?php //var_dump($_SESSION); ?>

</body>
</html>