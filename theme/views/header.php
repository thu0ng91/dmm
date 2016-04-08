<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <title><?=$title?></title>


    <link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/custom.css"/>

    <script src="<?= THEMEPATH ?>/js/jquery.min.js"></script>
    <script src="<?= THEMEPATH ?>/js/bootstrap.min.js"></script>
    <script src="<?= THEMEPATH ?>/js/custom.js"></script>

    <!--[if lt IE 9]>
    <script src="<?=THEMEPATH?>/js/html5shiv.min.js"></script>
    <script src="<?=THEMEPATH?>/js/respond.min.js"></script>
    <script src="<?=THEMEPATH?>/css/font-awesome-ie7.min.js"></script>
    <![endif]-->


</head>
<body>
<!-- Header -->
<div class="navbar navbar-inverse navbar-fixed-top header-back">
    <div class="navbar-header">
        <a class="navbar-brand" href="#"><img src="<?= THEMEPATH ?>/images/index.png" width="20px"/></a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li><a href="/Novel">首页</a></li>
            <li><a target="_blank" href="/bbs2/">论坛交流</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <?php if ($user) { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="<?= THEMEPATH ?>/images/avater/<$user['avater']>" alt="..." width="20px" class="img-circle">
                        <?= $user['name'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#loginModal" data-whatever='{"title":"修改密码","url":"<?=SITEPATH?>/users/modify"}'><i class="glyphicon glyphicon-pencil"></i> 修改密码</a>
                        </li>
                        <li><a href="#"><i class="glyphicon glyphicon-wrench"></i> 我的属性</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-inbox"></i> 我的消息</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?=SITEPATH?>/logout"><i class="glyphicon glyphicon-off"></i> 退出登陆</a></li>
                    </ul>
                </li>

            <?php } else { ?>
                <li><a href='<?=SITEPATH?>/login'>登陆</a></li>
                <li><a href='<?=SITEPATH?>/register'>注册</a></li>
            <?php } ?>
            <li><a href="#"></a></li>
        </ul>

    </div>

</div>
<!-- End Header -->


<!-- Main -->
<div class="main">
