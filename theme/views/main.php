<?php include VIEWPATH . "header.php" ?>
<div class="col-md-8 col-md-offset-2">
    <div class="panel" >
        <div class="panel-body">
            <div class="slideshow">
                <ul class="slide-tab">
                    <?php foreach ($update as $s): ?>
                        <li>
                            <span></span>
                            <img src="<?= SITEPATH ?>/<?= $s['image'] ? $s['image'] : 'books/default.jpg' ?>" alt="<?= $s['title'] ?>"/>
                        </li>
                    <?php endforeach; ?>            
                </ul>
                <ul class="slide-con">
                    <?php foreach ($update as $s): ?>

                        <li>
                            <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>" title="<?= $s['title'] ?>" target="_blank" >
                                <img src="<?= SITEPATH ?>/<?= $s['image'] ? $s['image'] : 'books/default.jpg' ?>" class="pic" />                                
                            </a>     
                            <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>" title="<?= $s['title'] ?>" target="_blank" >
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
</div>
<script type="text/javascript">

    $(function () {
        $(".slideshow .slide-con li:eq(0)").show();
        $(".slideshow .slide-tab li:eq(0)").addClass("on");
        focusSwitch('.slideshow', '.slide-con', '.slide-tab', 5000);
        $('[data-toggle="tooltip"]').tooltip({html: true, container: 'body'});
        //$("img.lazy").lazyload();
    });
</script>

<?php include VIEWPATH . "footer.php" ?>