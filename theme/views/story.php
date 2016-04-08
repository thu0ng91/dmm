<?php include VIEWPATH . "header.php" ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="text-center"><?= $story['title'] ?></h2>
    </div>
    <div class="panel-body">
        <img src="<?= SITEPATH ?>/<?= ($story['image']) ? $story['image'] : 'books/default.jpg' ?>" height="200px" align="left" />

        <h3 class="text-right">作者：<?= $story['author'] ?></h3>

        <h4>
            <?= $story['desc'] ?>
        </h4>
    </div>

    <!-- Table -->
    <table class="table">
        <tr>
            <?php
            $i = 0;
            foreach ($chapters as $c) {
                $i++;
                if ($i == 6) {
                    echo '</tr><tr>';
                    $i=0;
                } else {
                    ?>
            <td>
                <a href="<?=SITEPATH?>/chapter/<?=$c['id']?>"><?=$c['title']?></a>
            </td>
                    <?php
                }
            }
            ?>
        </tr>
    </table>
</div>

<?php include VIEWPATH . "footer.php" ?>
