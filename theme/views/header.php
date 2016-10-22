<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <title><?= $title ?></title>


    <link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/custom.css"/>

    <script src="<?= THEMEPATH ?>/js/jquery.min.js"></script>
    <script src="<?= THEMEPATH ?>/js/jquery.cookie.js"></script>


    <!--[if lt IE 9]>
    <script src="<?=THEMEPATH?>/js/html5shiv.min.js"></script>
    <script src="<?=THEMEPATH?>/js/respond.min.js"></script>
    <script src="<?=THEMEPATH?>/css/font-awesome-ie7.min.js"></script>
    <![endif]-->

    <script src="<?= THEMEPATH ?>/js/bootstrap.min.js"></script>
    <script src="<?= THEMEPATH ?>/js/custom.js"></script>

    <script type="text/javascript">
        $(function () {
            $('form').submit(function () {
                var search = $('#search').val();
                if (!search) {
                    alert('请输入搜索内容');
                    return false;
                }
            });

            $('.maskLayer').height($(window).height());

            var bootstrap = $.cookie('style') ? "bootstrap/" + $.cookie('style') : "bootstrap.min";

            $("<link>").attr({
                rel: "stylesheet",
                type: "text/css",
                id: "bootstrapStyle",
                href: "<?= THEMEPATH ?>/css/" + bootstrap + ".css"
            }).insertBefore("head link:first");

            $('#bootstrapStyle').ready(function () {
                $('.maskLayer').remove();
            });

            $('#changeStyle a').click(function () {
                var style = $(this).attr('id');
                var styleUrl = "<?= THEMEPATH ?>css/bootstrap/" + style + ".css"
                if (style == '') {
                    styleUrl = "<?= THEMEPATH ?>css/bootstrap.min.css"
                }
                $('#bootstrapStyle').attr('href', styleUrl);
                $.cookie('style', style);
            })
        })
    </script>

</head>
<body>
<div class="maskLayer">
    <img src="<?=THEMEPATH?>images/loading.gif">
</div>
<!-- Header -->
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= SITEPATH ?>">
                <img src="<?= THEMEPATH ?>/images/index.png" width="20px"/>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <li><a href="<?= SITEPATH ?>">首页</a></li>
                <li><a href="<?= site_url('/admin') ?>">后台</a></li>
                <?php foreach ($categories as $c): ?>
                    <li class='<?= isset($category_id) && ($category_id == $c['id']) ? 'active' : '' ?>'>
                        <a href="<?=site_url('/category/'.$c['id'])?>"><?= $c['title'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <form class="navbar-form navbar-right" role="search" method="get" action="<?= site_url('/search/') ?>0">
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control" type="text" name="search" id='search' placeholder="搜索书名、作者" value="<?= isset($search) ? $search : '' ?>"/>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" id="searchStory" type="submit">
                                <i class="icon-search"></i>
                            </button>
                            <button class="btn btn-warning dropdown-toggle" type="button"" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-desktop"></i>
                            </button>
                            <ul class="dropdown-menu" id="changeStyle">
                                <li>
                                    <a href="#" id="">
                                        <img src="<?= THEMEPATH ?>images/style/default_thumb.png" width="60" title="Default"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="Cosmo">
                                        <img src="<?= THEMEPATH ?>images/style/cosmo_thumb.png" width="60" title="Cosmo"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="Cyborg">
                                        <img src="<?= THEMEPATH ?>images/style/cyborg_thumb.png" width="60" title="Cyborg"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="Darkly">
                                        <img src="<?= THEMEPATH ?>images/style/darkly_thumb.png" width="60" title="Darkly"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="Slate">
                                        <img src="<?= THEMEPATH ?>images/style/slate_thumb.png" width="60" title="Slate"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="Superhero">
                                        <img src="<?= THEMEPATH ?>images/style/superhero_thumb.png" width="60" title="Superhero"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="Yeti">
                                        <img src="<?= THEMEPATH ?>images/style/yeti_thumb.png" width="60" title="Yeti"/>
                                    </a>
                                </li>

                            </ul>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>

<!-- End Header -->


<!-- Main -->
<div class="main" id="main">