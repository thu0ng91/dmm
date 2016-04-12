<?php include VIEWPATH . "admin/iframe_header.php" ?>


<div class="panel panel-default" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel-heading" id="headingOne">
        <i class="icon-plus-sign-alt icon-large"></i>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">发布新小说</a>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            <form class="form-horizontal" action="<?= SITEPATH ?>/admin/story/add" method="post">

                <div class="form-group">
                    <label for="book_id" class="col-sm-2 control-label">书名：</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                    </div>
                </div>

                <div class="form-group">
                    <label for="book_id" class="col-sm-2 control-label">作者：</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="author" id="author" placeholder="留空为当前用户">
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">分类:</label>

                    <div class="col-sm-10">
                        <select class="form-control" name='category'>
                            <?php foreach ($categorys as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= $c['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="book_id" class="col-sm-2 control-label">描述：</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="desc"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">增加</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="panel-heading" id="headingTwo">
        <i class="icon-plus-sign-alt icon-large"></i>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">上传文本文件</a>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
            <p>
                <i class="icon-warning-sign"></i>
                上传文本文件，自动将文件名作为小说名称，如果文件名中包含（作者：）字样，将从文件名中取出作者名，否则为上传用户名，文本文件自动分开章节。<b>只允许上传txt文件。</b><br/>
                <i class="icon-book"></i>
                文件名示范: 《我是小说》作者：123.txt 《我是小说》.txt<br/>
                <i class="icon-list-alt"></i>
                章节示范： 第××章 &lt;回车&gt;
            </p>

            <p>&nbsp;</p>

            <form class="form-horizontal" action="<?= SITEPATH ?>/admin/story/upload" method="post" enctype="multipart/form-data">

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
            <tr>
                <td><?= $s['id'] ?></td>
                <td>[<?=$categorys[$s['category']-1]['title']?>] <?= $s['title'] ?></td>
                <td><?= $s['author'] ?></td>
                <td><?= $s['time'] ?></td>
                <td><?= $s['last_update'] ?></td>
                <td></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

<link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/redactor.css"/>

<script src="<?= THEMEPATH ?>/js/redactor.js"></script>

<script type="text/javascript">
    $(function () {

        $('#desc').redactor();

        $('#selectFile').click(function () {
            $('input[id=lefile]').click();
        });

        $('#lefile').change(function () {
            $('#fileLoad').val($(this).val());
        });

        $('#selectCategory a').click(function () {
            var id = $(this).parent('li').attr('id');
            $('#category').val(id);
            $('#selectCategoryName').html($(this).text() + ' <span class="caret"></span>');
        })
    })
</script>

<?php include VIEWPATH . "admin/iframe_footer.php" ?>
