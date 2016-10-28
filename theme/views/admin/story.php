<?php include VIEWPATH . "admin/iframe_header.php" ?>


<div class="panel panel-default" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel-heading" id="headingTwo">
        <div class="btn-group">
            <button class="btn btn-primary" openDialog="<?= site_url('/admin/story/edit/') ?>" title="发布新小说">
                <i class="icon-plus-sign-alt icon-large"></i>
                发布新小说
            </button>
            <a role="button" class="btn btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                aria-expanded="false" aria-controls="collapseTwo">
                <i class="icon-upload-alt icon-large"></i>
                上传文本文件
            </a>
        </div>
        <div class="pull-right" style="width:100px;">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" id="selectCategoryName">
                    选择分类 <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="selectCategory">
                    <?php foreach ($categorys as $c): ?>
                    <li id="<?= $c['id'] ?>"><a href="#"><?= $c['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>            
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
            <p>
                <i class="icon-warning-sign"></i>
                上传文本文件，自动将文件名作为小说名称，如果文件名中包含（作者：）字样，将从文件名中取出作者名，否则为上传用户名，文本文件自动分开章节。<b>只允许上传txt文件。</b><br/>
                <i class="icon-book"></i>
                文件名示范: 《我是小说》作者：123.txt 《我是小说》.txt<br/>
                <i class="icon-list-alt"></i>
                章节示范： <br/>
                内容简介: XXXXXXXXX <br/>
                第××章 XXXXXX &lt;回车&gt;<br/>
                &nbsp;&nbsp;XXXXXXXXXX
            </p>

            <p>&nbsp;</p>

            <form class="form-horizontal" action="<?= site_url('/admin/story/upload') ?>" method="post"
                enctype="multipart/form-data" id="addTxt">

                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" id="selectCategoryName">
                            选择分类 <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="selectCategory">
                            <?php foreach ($categorys as $c): ?>
                                <li id="<?= $c['id'] ?>"><a href="#"><?= $c['title'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <input id="fileLoad" class="form-control" type="text"/>
                    <input class="form-control" type="file" name="story" style="display: none" id="lefile"/>
                    <input class="form-control" type="hidden" name="category" id="category"/>
                    <span class="input-group-btn">
                        <button type="button" class="bg-primary btn" id="selectFile">选择文件</button>
                        <button type="submit" class="btn-success btn">上传文件</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">

    <table class="table table-striped table-hover" width="100%" id="story_list_table">
        <thead>
        <tr>
            <th width="40%">书名</th>
            <th>类别</th>
            <th>作者</th>
            <th>创建时间</th>
            <th>最后更新</th>
            <th width="82px">操作</th>
        </tr>
        </thead>
    </table>
</div>


<link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/dataTables.bootstrap.min.css"/>

<script src="<?= THEMEPATH ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= THEMEPATH ?>/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(function () {
        var table=$('#story_list_table').DataTable({
            language: {
                'url': '<?=THEMEPATH?>/js/dataTables.zh-CN.json'
            },
            "processing": true,
            "serverSide": true,
            "order": [[4, "desc"]],
            "ajax": "<?= site_url('/admin/story/datatable/'.$category_id) ?>",
            "columns": [
                {"data": "title"},
                {"data": "category_title"},
                {"data": "author"},
                {"data": "time"},
                {"data": "last_update"},
                {"data": "action"}
            ]
        });

        //打开新增小说窗口
        $('#addStory').click(function () {
            BootstrapDialog.show({
                title: '发布新小说',
                message: $('<div></div>').load('<?= site_url('/admin/story/edit/') ?>')
            });
        });
        //上传文本小说
        $('#selectFile').click(function () {
            $('input[id=lefile]').click();
        });

        $('#lefile').change(function () {
            $('#fileLoad').val($(this).val());
        });
        //选择分类
        $('#selectCategory a').click(function () {
            var id = $(this).parent('li').attr('id');
            $('#category').val(id);
            $('#selectCategoryName').html($(this).text() + ' <span class="caret"></span>');
        });

        //编辑小说
        $('body').on('click', '.editStory', function () {
            var id = $(this).parents('tr').attr('id');
            ajax_dialog('编辑小说', '<?= site_url('/admin/story/edit/') ?>/' + id)
        });
        //删除小说
        $('body').on('click', '.deleteStory', function () {
            if (!confirm('删除小说将同时删除所有章节！\r\n是否确认删除？')) return;
            var id = $(this).parents('tr').attr('id');

            $.get('<?= site_url('/admin/story/delete/') ?>/' + id, function (data) {
                if (data) {
                    show_error(data);
                } else {
                    table.row('#'+id).remove().draw(false);
                }
            })
        });
        //增加章节
        $('body').on('click', '.addChapter', function () {
            var id = $(this).parents('tr').attr('id');
            var chapter_btn = parent.$(window.parent.document).find("a[data-addtab='chapter']");//触发父窗口按钮
            $(window.parent.document).find('#tab_tab_chapter').remove();
            $(window.parent.document).find('#tab_chapter').remove();
            chapter_btn.attr("url", '<?= site_url('/admin/chapter/') ?>/' + id);
            chapter_btn.trigger("click");
        });
        //打开章节列表
        $('body').on('click', '.listChapter', function () {
            var id = $(this).parents('tr').attr('id');
            var chapter_btn = parent.$(window.parent.document).find("a[data-addtab='chapter_list']");//触发父窗口按钮
            $(window.parent.document).find('#tab_tab_chapter_list').remove();
            $(window.parent.document).find('#tab_chapter_list').remove();
            chapter_btn.attr("url", '<?= site_url('/admin/chapter/list/') ?>/' + id);
            chapter_btn.trigger("click");
        });
        //更新小说
        $('body').on('click', '.updateStory', function () {
            var id = $(this).parents('tr').attr('id');
            var chapter_btn = parent.$(window.parent.document).find("a[data-addtab='capture_book']");//触发父窗口按钮
            $(window.parent.document).find('#tab_tab_capture_book').remove();
            $(window.parent.document).find('#tab_capture_book').remove();
            chapter_btn.attr("url", '<?= site_url('/admin/collect/get/') ?>/' + id);
            chapter_btn.trigger("click");
        });
        //双击打开小说
        $('body').on('dblclick', 'tr', function () {
            var id = $(this).attr('id');
            window.open('<?= site_url('/story/') ?>/' + id);
        });
    });
</script>

<?php include VIEWPATH . "admin/iframe_footer.php" ?>