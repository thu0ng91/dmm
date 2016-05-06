<?php include VIEWPATH . "admin/iframe_header.php" ?>


<div class="panel panel-default" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel-heading" id="headingTwo">
        <div class="btn-group">
            <button class="btn btn-primary" id="addStory">
                <i class="icon-plus-sign-alt icon-large"></i>
                发布新小说
            </button>
            <a role="button" class="btn btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <i class="icon-upload-alt icon-large"></i>
                上传文本文件
            </a>
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

            <form class="form-horizontal" action="<?= SITEPATH ?>/admin/story/upload" method="post" enctype="multipart/form-data" id="addTxt">

                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="selectCategoryName">
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


<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>书名</th>
        <th>作者</th>
        <th>创建时间</th>
        <th>最后更新</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($storys as $s): ?>
        <tr id="<?= $s['id'] ?>">
            <td><?= $s['id'] ?></td>
            <td>
                [<?= $s['category_title'] ?>]
                <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>" target="_blank">
                    <?= $s['title'] ?>
                </a>
            </td>
            <td><?= $s['author'] ?></td>
            <td><?= $s['time'] ?></td>
            <td><?= $s['last_update'] ?></td>
            <td>
                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <button type="button" class="btn btn-warning listChapter" title="章节列表">
                        <i class="icon-list-alt"></i>
                    </button>
                    <button type="button" class="btn btn-default addChapter" title="增加章节">
                        <i class="icon-plus"></i>
                    </button>
                    <button type="button" class="btn btn-primary editStory" title="编辑">
                        <i class="icon-edit"></i>
                    </button>
                    <button type="button" class="btn btn-success deleteStory" title="删除">
                        <i class="icon-trash"></i>
                    </button>
                    <button type="button" class="btn btn-info updateStory" title="更新">
                        <i class="icon-cloud-download"></i>
                    </button>
                </div>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<div class="text-right">
    <?= $pages ?>
</div>


<script type="text/javascript">
    $(function () {
        //打开新增小说窗口
        $('#addStory').click(function() {
            BootstrapDialog.show({
                title: '发布新小说',
                message: $('<div></div>').load('<?=SITEPATH?>/admin/story/edit/')
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
        })

        //编辑小说
        $('.editStory').click(function () {
            var id = $(this).parents('tr').attr('id');
            BootstrapDialog.show({
                title: '编辑小说',
                message: $('<div></div>').load('<?=SITEPATH?>/admin/story/edit/' + id)
            });
        });
        //删除小说
        $('.deleteStory').click(function () {
            if (!confirm('删除小说将同时删除所有章节！\r\n是否确认删除？')) return;
            var id = $(this).parents('tr').attr('id');

            $.get('<?=SITEPATH?>/admin/story/delete/' + id, function (data) {
                if (data) {
                    show_error(data);
                } else {
                    window.location.href = '<?=SITEPATH?>/admin/story';
                }
            })
        });
        //增加章节
        $('.addChapter').click(function () {
            var id = $(this).parents('tr').attr('id');
            var chapter_btn = parent.$(window.parent.document).find("a[data-addtab='chapter']");//触发父窗口按钮
            $(window.parent.document).find('#tab_tab_chapter').remove();
            $(window.parent.document).find('#tab_chapter').remove();
            chapter_btn.attr("url", '<?=SITEPATH?>/admin/chapter/' + id);
            chapter_btn.trigger("click");
        });
        //打开章节列表
        $('.listChapter').click(function () {
            var id = $(this).parents('tr').attr('id');
            var chapter_btn = parent.$(window.parent.document).find("a[data-addtab='chapter_list']");//触发父窗口按钮
            $(window.parent.document).find('#tab_tab_chapter_list').remove();
            $(window.parent.document).find('#tab_chapter_list').remove();
            chapter_btn.attr("url", '<?=SITEPATH?>/admin/chapter/list/' + id);
            chapter_btn.trigger("click");
        });
        //更新小说
        $('.updateStory').click(function(){
            var id = $(this).parents('tr').attr('id');
            var chapter_btn = parent.$(window.parent.document).find("a[data-addtab='capture_book']");//触发父窗口按钮
            $(window.parent.document).find('#tab_tab_capture_book').remove();
            $(window.parent.document).find('#tab_capture_book').remove();
            chapter_btn.attr("url", '<?=SITEPATH?>/admin/capture/get/' + id);
            chapter_btn.trigger("click");
        })
    });
</script>

<?php include VIEWPATH . "admin/iframe_footer.php" ?>
