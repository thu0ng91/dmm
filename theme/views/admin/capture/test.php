<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">小说内容</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">章节列表</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">章节内容</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1><?= $book['book_title'] ?></h1>
                    <img src="<?= $book['book_img'] ?>" alt="left" class="pull-left" width="120px"/>
                    <h4>作者：<?= $book['book_author'] ?></h4><br/>
                    <?= $book['book_desc'] ?>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <div class="col-md-3">
                            <a href="<?= $book['chapter_list_url'] ?><?= $chapter_list[$i]['url'] ?>"><?= $chapter_list[$i]['title'] ?></a>
                        </div>
                    <?php endfor; ?>
                    ...
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1><?= $chapter_list[0]['title'] ?></h1>
                    <?= $chapter ?>
                    <br/>
                    ...
                </div>
            </div>
        </div>
    </div>
    <?php if ($ajax == 0): ?>
        <div class="text-center">
            <div class="btn-group">
                <a class="btn btn-primary" href="<?= SITEPATH ?>/admin/capture/get_book?title=<?= rawurlencode($book['book_title']) ?>">
                    <i class="icon-cloud-download"></i>
                    开始采集
                </a>
                <a class="btn btn-warning" href="#" onclick="history.go(-1);">
                    <i class=" icon-ban-circle"></i>
                    返回
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>