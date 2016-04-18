<?php include VIEWPATH . "admin/header.php" ?>

<div class="row">

    <div class="col-md-2">
        <div class="list-group" id="menu">
            <a href="#" class="list-group-item active">
                <i class="icon-home"></i>
                管理首页
            </a>
            <a href="#" class="list-group-item" data-addtab="setting" url="<?=SITEPATH?>/admin/setting">
                <i class="icon-cogs"></i>
                系统设置
            </a>
            <a href="#" class="list-group-item" data-addtab="category" url="<?=SITEPATH?>/admin/category">
                <i class="icon-folder-open"></i>
                分类设置
            </a>
            <a href="#" class="list-group-item" data-addtab="story" url="<?=SITEPATH?>/admin/story">
                <i class="icon-book"></i>
                发布小说
            </a>
            <a href="#" class="list-group-item" data-addtab="chapter_list" url="<?=SITEPATH?>/admin/chapter/list">
                <i class="icon-list-alt"></i>
                章节列表
            </a>
            <a href="#" class="list-group-item" data-addtab="chapter" url="<?=SITEPATH?>/admin/chapter">
                <i class="icon-file-text-alt"></i>
                发布章节
            </a>
            <a href="#" class="list-group-item" data-addtab="capture" url="<?=SITEPATH?>/admin/capture">
                <i class="icon-cloud-download"></i>
                采集小说
            </a>
        </div>
    </div>

    <div class="col-md-10">

        <div id="addtabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active" id="adminHomeTab">
                    <a href="#adminHome"  aria-controls="home" role="tab" data-toggle="tab">
                        <i class="icon-home"></i>
                        管理首页
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="adminHome">...</div>
            </div>

        </div>

    </div>

</div>

<script src="<?= THEMEPATH ?>/js/bootstrap-addtabs.js"></script>

<script type="text/javascript">
    $(function () {

        $('#menu a').click(function () {
            $('#menu').find('a.active').removeClass('active');
            $(this).addClass('active');
        });

        $('#addtabs').addtabs({monitor:'#menu'});

        //点击首页显示
        $('#menu a:first').click(function(){
            $('.nav-tabs').find('li.active').removeClass('active');
            $('.tab-content').find('div.active').removeClass('active');
            $('#adminHome').addClass('active');
            $('#adminHomeTab').addClass('active');
        })

    });

</script>

<?php include VIEWPATH . "footer.php" ?>
