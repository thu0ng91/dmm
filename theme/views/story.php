<?php include VIEWPATH . "header.php" ?>

<div class="stories">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center"><?= $story['title'] ?></h2>
        </div>
        <div class="panel-body">
            <img src="<?= site_url('/'.($story['image']) ? $story['image'] : 'books/default.jpg') ?>" width="160px" align="left" class="img-thumbnail"/>

            <h4 class="text-right">作者：<?= $story['author'] ?></h4>

            <p style="margin-left: 50px;">
                <?= $story['desc'] ?>
            </p>

            <?php if (isset($last_read['id'])): ?>
                <div class="pull-right">您最后阅读章节：
                    <span id="last_read"><a href="<?= site_url('/chapter/'.$last_read['id']) ?>"><?= $last_read['title'] ?></a> </span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Table -->
        <ul class="list-inline chapter-list">
            <?php foreach ($chapters as $c): ?>
                <li>
                    <a href="<?= site_url('/chapter/'.$c['id']) ?>"><?= $c['title'] ?></a>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</div>

<?php include VIEWPATH . "footer.php" ?>
