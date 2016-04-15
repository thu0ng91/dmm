<?php include VIEWPATH . "header.php" ?>

<div class="col-md-2 pull-right">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">最新更新</h3>
        </div>

        <table class="table">
            <?php foreach ($update as $u): ?>
                <tr>
                    <td>
                        <a href="<?= SITEPATH ?>/story/<?= $u['story_id'] ?>"><?= $u['story_title'] ?></a>
                    </td>
                    <td class="text-right"><?= date('Y-m-d',$u['time']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>

<div class="col-md-10">
    <div id="story_list">
        <?php foreach ($storys as $s): ?>
            <div class="story-list pull-left">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>">
                            <img src="<?= SITEPATH ?>/<?= $s['image'] ? $s['image'] : 'books/default.jpg' ?>" width="160px" height="200px" title="<?= $s['desc'] ?>"/>
                        </a>

                        <p>
                            <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>">
                                <b><?= $s['title'] ?></b>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include VIEWPATH . "footer.php" ?>
