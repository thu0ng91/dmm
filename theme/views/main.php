<?php include VIEWPATH . "header.php" ?>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
            <div class="panel-body">
                <div class="slideshow">
                    <ul class="slide-tab">
                        <?php foreach ($update as $s): ?>
                            <li>
                                <span></span>
                                <img src="<?= site_url('/') ?><?= $s['image'] ? $s['image'] : 'books/default.jpg' ?>" alt="<?= $s['title'] ?>"/>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="slide-con">
                        <?php foreach ($update as $s): ?>

                            <li>
                                <a href="<?= site_url('/story/'.$s['id']) ?>" title="<?= $s['title'] ?>">
                                    <img src="<?= site_url('/') ?><?= $s['image'] ? $s['image'] : 'books/default.jpg' ?>" class="pic"/>
                                </a>
                                <a href="<?= site_url('/story/'.$s['id']) ?>" title="<?= $s['title'] ?>">
                                    <h3><?= $s['title'] ?></h3>
                                </a>

                                <div class="text-right">
                                    <label>
                                        作者：<?= $s['author'] ?>
                                    </label>
                                </div>
                                <div class="desc">
                                    <?= $s['desc'] ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <?php foreach ($category_update as $cu): ?>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <b><?= $cu['category']['title'] ?></b>
                                <span class="pull-right">
                                    <a href="<?= site_url('/category/'.$cu['category']['id']) ?>">
                                        更多...
                                    </a>
                                </span>
                            </div>
                            <!-- List group -->
                            <ul class="list-group">
                                <?php foreach ($cu['stories'] as $cs):?>
                                <a class="list-group-item" href="<?=site_url('/story/'.$cs['id'])?>">
                                    <?=$cs['title']?>
                                </a>
                                <?php endforeach;?>
                            </ul>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(function () {
            $(".slideshow .slide-con li:eq(0)").show();
            $(".slideshow .slide-tab li:eq(0)").addClass("on");
            focusSwitch('.slideshow', '.slide-con', '.slide-tab', 5000);
            $('[data-toggle="tooltip"]').tooltip({html: true, container: 'body'});
        });
    </script>

<?php include VIEWPATH . "footer.php" ?>