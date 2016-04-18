<?php include VIEWPATH . "admin/iframe_header.php" ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5">
                    <h4>
                        <i class="icon-book"></i>
                        <?= $story['title'] ?>
                    <button type="submit" class="bg-info btn" id="addChapter" title="增加新章节" data-story-id="<?=$story['id']?>">
                        <i class="icon-plus-sign-alt"></i>
                        增加新章节
                    </button>
                    </h4>
                </div>

                <div class="col-md-5 pull-right">
                    <h4>
                    <form action="<?= SITEPATH ?>/admin/chapter/list/<?= $story['id'] ?>/0" method="get">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="selectSearchType">
                                    ID
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" id="selectSearch">
                                    <li id="id"><a href="#">ID</a></li>
                                    <li id="title"><a href="#">标题</a></li>
                                </ul>
                            </div>
                            <!-- /btn-group -->
                            <input type="hidden" name="type" value="id" id="type"/>
                            <input type="text" class="form-control" name="search" placeholder="搜索章节 ID">
                            <span class="input-group-btn">
                                <button type="submit" class="bg-primary btn" id="selectFile">
                                    <i class="icon-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    </h4>
                    <!-- /input-group -->
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($chapters as $c): ?>
            <tr id="<?= $c['id'] ?>">
                <td><?= $c['id'] ?></td>
                <td><?= $c['title'] ?></td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-primary editChapter" title="编辑">
                            <i class="icon-edit"></i>
                        </button>
                        <button class="btn btn-success deleteChapter" title="删除">
                            <i class="icon-trash"></i>
                        </button>

                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="text-right">
        <?= $pages ?>
    </div>


    <script type="text/javascript">
        $(function () {
            //选择搜索类型
            $("#selectSearch a").click(function () {
                var id = $(this).parent('li').attr('id');
                var title = $(this).text();
                $('input[name=search]').attr('placeholder', '搜索章节 ' + title);
                $('#type').val(id);
                $('#selectSearchType').html($(this).text() + ' <span class="caret"></span>');
            })

            //增加章节
            $('#addChapter').click(function () {
                var id = $(this).attr('data-story-id');
                var chapter_btn = parent.$(window.parent.document).find("a[data-addtab='chapter']");//触发父窗口按钮
                chapter_btn.attr("url", '<?=SITEPATH?>/admin/chapter/' + id);
                chapter_btn.trigger("click");
            });

            //编辑章节
            $('.editChapter').click(function () {
                var chapter_id=$(this).parents('tr').attr('id');
                var chapter_title=$(this).parents('td').prev('td').text();
                var url='<?=SITEPATH?>/admin/chapter/<?=$story['id']?>/'+chapter_id;
                BootstrapDialog.show({
                    title: chapter_title,
                    message: $('<div></div>').load(url)
                });
            })
        })
    </script>
<?php include VIEWPATH . "admin/iframe_footer.php" ?>