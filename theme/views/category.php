<div class="col-md-8 col-md-offset-2">
    <?php foreach ($stories as $s): ?>
        <div class="story-list">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>">
                        <img src="<?= SITEPATH ?>/<?= $s['image'] ? $s['image'] : 'books/default.jpg' ?>" width="160px" title="<?= $s['desc'] ?>"/>
                    </a>

                        <span>
                            <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>">
                                <b><?= $s['title'] ?></b> - <?= $s['author'] ?>
                            </a>
                        </span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<div class="col-md-8 col-md-offset-2 text-center" width="100%">
    <?= $pages ?>
</div>
