<?php include VIEWPATH . "admin/iframe_header.php" ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="icon-plus"></i>
            增加新章节<?= isset($story['title']) ? ' - 《' . $story['title'] . '》' : '' ?>
        </h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="<?= SITEPATH ?>/admin/chapter/add" method="post">
            <?php if (!isset($story)) { ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">小说</label>

                    <div class="col-sm-10">
                        <select class="form-control" name="story_id">
                            <?php foreach ($storys as $s): ?>
                                <option value="<?= $s['id'] ?>"><?= $s['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php } else { ?>
                <input type="hidden" name="story_id" value="<?= isset($story['id']) ? $story['id'] : 0 ?>"/>
            <?php } ?>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">章节标题</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                </div>
            </div>

            <div class="form-group">
                <textarea class="form-control" id="content" name="content"></textarea>

            </div>

            <div class="form-group">
                <div class="col-sm-12 text-center btn-group">
                    <button type="submit" class="btn btn-primary">增加</button>
                    <button type="reset" class="btn btn-success">取消</button>
                </div>
            </div>
        </form>
    </div>
</div>


<link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/redactor.css"/>

<script src="<?= THEMEPATH ?>/js/redactor.js"></script>

<script type="text/javascript">
    $(function () {
        $('#content').redactor();
    });
</script>
<?php include VIEWPATH . "admin/iframe_footer.php" ?>
