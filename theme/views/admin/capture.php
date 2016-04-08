<?php include VIEWPATH . "admin/iframe_header.php" ?>

<div class="panel panel-default" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel-heading">
        <i class="icon-warning-sign icon-large"></i>
        默认采集网站为<a href="http://www.23wx.com/">顶点小说</a>
    </div>


    <div class="panel-body">
        <form class="form-horizontal" action="<?= SITEPATH ?>/admin/capture/add" method="post">

            <div class="form-group">
                <label for="book_id" class="col-sm-2 control-label">采集书号</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="book_id" id="title" placeholder="Book ID">
                </div>
            </div>
            
            <div class="form-group">
                <label for="category" class="col-sm-2 control-label">所在分类</label>
                <div class="col-sm-10">
                    <select class="form-control" name='category_id'>
                        <?php foreach ($categorys as $c):?>
                        <option value="<?=$c['id']?>"><?=$c['title']?></option>
                        <?php endforeach;?>
                    </select>
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


<?php include VIEWPATH . "admin/iframe_footer.php" ?>