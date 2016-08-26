<?php include VIEWPATH . "admin/iframe_header.php" ?>

    <div class="panel panel-default" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel-heading">
            <i class="icon-warning-sign icon-large"></i>
            采集小说 - <span id="site"><a href="<?=$collects[0]['site_url']?>"><?=$collects[0]['site_title']?></a></span>
        </div>


        <div class="panel-body">
            <form class="form-horizontal" action="<?= SITEPATH ?>/admin/collect_setting/test" method="post">

                <div class="form-group">
                    <label for="book_id" class="col-sm-2 control-label">采集书号</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="book_id" id="title" placeholder="Book ID" value="<?=isset($collect_book)?$collect_book['book_id']:''?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">所在分类</label>

                    <div class="col-sm-10">
                        <select class="form-control" name='category_id'>
                            <?php foreach ($categories as $c): ?>
                                <option value="<?= $c['id'] ?>" ><?= $c['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">采集站点</label>

                    <div class="col-sm-10">
                        <select class="form-control" name='collect_id' id="collect_id">
                            <?php foreach ($collects as $c): ?>
                                <option value="<?= $c['id'] ?>" url='<?= $c['site_url'] ?>' <?=isset($collect_book)?($collect_book['collect_id']==$c['id']?'selected':''):''?>><?= $c['site_title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">采集</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#collect_id').change(function () {
                var title = $(this).find('option:selected').text();
                var url = $(this).find('option:selected').attr('url');
                $('#site').html($('<a>',{href:url,text:title,target:"_Blank"}))
            });
        });
    </script>

<?php include VIEWPATH . "admin/iframe_footer.php" ?>