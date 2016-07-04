<?php include VIEWPATH . "header.php" ?>

<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center"><?= $story['title'] ?></h2>
        </div>
        <div class="panel-body">
            <img src="<?= SITEPATH ?>/<?= ($story['image']) ? $story['image'] : 'books/default.jpg' ?>" width="160px" align="left" class="img-thumbnail"/>

            <h4 class="text-right">作者：<?= $story['author'] ?></h4>

            <p style="margin-left: 50px;">
                <?= $story['desc'] ?>
            </p>

            <?php if(isset($last_read['id'])):?>
                <div class="pull-right">您最后阅读章节： <span id="last_read"><a href="<?=SITEPATH?>/chapter/<?=$last_read['id']?>"><?=$last_read['title']?></a> </span></div>
            <?php endif;?>
        </div>

        <!-- Table -->
        <table class="table">
            <tr>
                <?php
                $i = 0;
                foreach ($chapters as $c) {
                    ?>
                    <td>
                        <a href="<?= SITEPATH ?>/chapter/<?= $c['id'] ?>"><?= $c['title'] ?></a>
                    </td>
                    <?php
                    $i++;
                    if ($i == 5) {
                        echo '</tr><tr>';
                        $i = 0;
                    }

                }
                ?>
            </tr>
        </table>
    </div>
</div>

<?php include VIEWPATH . "footer.php" ?>
