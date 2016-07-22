<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <title><?= $title ?></title>


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

<ol class="breadcrumb">
    <li><a href="<?= SITEPATH ?>">首页</a></li>
    <li><a href="<?= SITEPATH ?>/category/<?= $category['id'] ?>"><?= $category['title'] ?></a></li>
    <li><a href=" <?= SITEPATH . '/story/' . $prev_next['story_id'] ?>"><?= $story['title'] ?></a></li>
    <li class="active"><b><?= $chapter['title'] ?></b></li>

    <div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
        <a class="btn btn-default" href="<?= $prev_next['prev'] ? SITEPATH . '/chapter/' . $prev_next['prev'] : SITEPATH . '/story/' . $prev_next['story_id'] ?>" id="prev_url" title="上一章">
            <i class="icon-hand-left"></i>
        </a>
        <button type="button" class="btn btn-default" id="chapter_list" title="目录">
            <i class="icon-list-ul"></i>
        </button>
        <a class="btn btn-default" href="<?= $prev_next['next'] ? SITEPATH . '/chapter/' . $prev_next['next'] : SITEPATH . '/story/' . $prev_next['story_id'] ?>" id="next_url" title="下一章">
            <i class="icon-hand-right"></i>
        </a>
    </div>
</ol>

<div class="chapter-list">
    <div class="panel panel-default">
        <div class="list-group">
            <?php foreach ($chapters as $c): ?>
                <a href="<?= SITEPATH ?>/chapter/<?= $c['id'] ?>" class="list-group-item <?= $c['id'] == $chapter['id'] ? 'active' : '' ?>"><?= $c['title'] ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="chapter">
    <div class="panel panel-default">
        <div class="panel-body">
            <div id="content">
                <?= $chapter['content'] ?>
            </div>
            <div class="pagination">
                <dd id="prev"></dd>
                <dd id="cent"></dd>
                <dd id="next"></dd>
            </div>
        </div>
        <div id="cPage" class="text-right"></div>

    </div>
</div>

<link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/MyPagination.css"/>
<script src="<?= THEMEPATH ?>/js/MyPagination.js"></script>

<script type="text/javascript">
    $(function () {
        var height = parseInt($(window).height()) - 86;
        var width = parseInt($(window).width()) > 980 ? 980 : parseInt($(window).width());
        $('.chapter-list').height(height - 52);
        $('.chapter').width(width);
        $('.pagination').width(width);
        $('#content').MyPagination({height: height, width: width});

        var container = $('.chapter-list'),
            scrollTo = $('.chapter-list .active');

        container.css('height', height);
        container.scrollTop(
            scrollTo.offset().top - container.offset().top + container.scrollTop()
        );

        $('#chapter_list,#cent').click(function () {
            var chapter_list = $('.chapter-list');
            if (chapter_list.offset().left < 0) {
                chapter_list.animate({left: '10px'});
            } else {
                chapter_list.animate({left: '-250px'});
            }
        });

    });
</script>
<?php include VIEWPATH . "footer.php" ?>
