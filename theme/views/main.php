<?php include VIEWPATH . "header.php" ?>

<div class="row">

    <div class="col-md-10">

    </div>

    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">最新更新</h3>
            </div>

            <table class="table">
                <?php foreach ($update as $u): ?>
                    <tr>
                        <td>
                            <a href="<?=SITEPATH?>/story/<?=$u['story_id']?>"><?=$u['story_title']?></a>
                        </td>
                        <td><?=$u['time']?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>

</div>


<?php include VIEWPATH . "footer.php" ?>
