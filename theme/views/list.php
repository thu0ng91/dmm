<?php foreach ($stories as $s): ?>
    <div class="box">

        <div class="text-center">
            <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>">
                <img src="<?= SITEPATH ?>/<?= $s['image'] ? $s['image'] : 'books/default.jpg' ?>" width="160px" title="<?= $s['desc'] ?>"/>
            </a><br/>
            <span class="">
            <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>">
                <b><?= $s['title'] ?></b> - <?= $s['author'] ?>
            </a>
            </span>
        </div>


    </div>
<?php endforeach; ?>