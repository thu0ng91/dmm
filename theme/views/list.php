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