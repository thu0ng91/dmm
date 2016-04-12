<?php include VIEWPATH . "header.php" ?>

<div class="row">

    <div class="col-md-10">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=SITEPATH?>">分类</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php foreach ($categorys as $c): ?>
                            <li class='<?= isset($id) && ($id == $c['id']) ? 'active' : '' ?>'>
                                <a href="<?= SITEPATH ?>/category/<?= $c['id'] ?>"><?= $c['title'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <div id="story_list">
            <?php foreach ($story as $s): ?>
                <div class="story-list">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>">
                                <img src="<?=SITEPATH?>/<?= $s['image'] ? $s['image'] : 'books/default.jpg' ?>" width="160px" height="200px" title="<?= $s['desc'] ?>"/>
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

    <div class="col-md-2">
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
                        <td class="text-right"><?= $u['time'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>

</div>


<?php include VIEWPATH . "footer.php" ?>
