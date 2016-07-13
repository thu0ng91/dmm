
<form class="form-horizontal" action="<?= SITEPATH ?>/admin/story/add" method="post" id="addStory">

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">常规</a>
        </li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">封面</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <p></p>

            <div class="form-group">
                <label for="book_id" class="col-sm-2 control-label">书名：</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" id="title" value="<?= isset($story) ? $story['title'] : '' ?>" placeholder="Title">
                </div>
            </div>

            <div class="form-group">
                <label for="book_id" class="col-sm-2 control-label">作者：</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="author" id="author" value="<?= isset($story) ? $story['author'] : '' ?>" placeholder="留空为当前用户">
                </div>
            </div>

            <div class="form-group">
                <label for="category" class="col-sm-2 control-label">分类：</label>

                <div class="col-sm-10">
                    <select class="form-control" name='category'>
                        <?php foreach ($categorys as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= isset($story) ? ($story['category'] == $c['id'] ? 'selected' : '') : '' ?>><?= $c['title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="book_id" class="col-sm-2 control-label">描述：</label>

                <div class="col-sm-10">
                    <textarea class="form-control" id="desc" name="desc"><?= isset($story) ? $story['desc'] : '' ?></textarea>
                </div>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            <p></p>
            <div class="well">
                上传封面时，要先在<b>封面</b>标签页中先上传图片，然后再提交表单，否则不会上传图片。
            </div>
            <div class="form-group">
                <div class="col-sm-12" role="group">
                    <div id="kv-avatar-errors" class="center-block alert alert-block alert-danger" style="display:none"></div>
                    <input type="file" class="file-loading" name="imageUpload" id="imageUpload">
                    <input type="hidden" class="file-loading" name="image" id="image" value="<?= isset($story) ? $story['image'] : '' ?>">
                    <input type="hidden" name="id" value="<?= isset($story) ? $story['id'] : '' ?>"/>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 btn-group" role="group">
            <button type="submit" class="btn btn-success"><?= isset($story) ? '编辑' : '增加' ?></button>
            <button type="reset" class="btn btn-info" onclick="BootstrapDialog.closeAll();">取消</button>
        </div>
    </div>

</form>


<link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/redactor.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?= THEMEPATH ?>/css/fileinput.min.css"/>
<script src="<?= THEMEPATH ?>/js/redactor.js"></script>
<script src="<?= THEMEPATH ?>/js/fileinput.min.js"></script>
<script src="<?= THEMEPATH ?>/js/fileinput_locale_zh.js"></script>

<script type="text/javascript">
                $(function () {
                    $('#desc').redactor();
                    //上传封面图片
                    $('#imageUpload').fileinput({
                        'language': 'zh', //设置语言
                        'uploadUrl': "<?= SITEPATH ?>/admin/story/image",
                        maxFileSize: 500,
                        showCaption: false,
                        uploadClass: 'btn btn-success',
                        elErrorContainer: '#kv-avatar-errors',
                        defaultPreviewContent: '<img src="<?= SITEPATH ?>/<?= isset($story) ? $story['image'] : 'books/default.jpg' ?>" alt="Your Avatar" style="width:150px">',
                        allowedFileExtensions: ["jpg", "png", "gif", 'bmp']
                    });
                    $('#imageUpload').on('fileuploaded', function (event, data) {
                        console.log(data.response);
                        var file = data.response;
                        var image_url = file['path'] + '/' + file.profile['raw_name'] + file.profile['file_ext'];
                        $('#image').val(image_url);
                    });
                })
</script>