<?php include VIEWPATH . "header.php" ?>
<div class="col-md-8 col-md-offset-2">
    <div class="panel" >
        <div class="panel-body">
            <div class="slideshow">
                <ul class="slide-con">
                    <?php foreach ($update as $s): ?>

                        <li>
                            <a href="<?= SITEPATH ?>/story/<?= $s['id'] ?>" title="<?= $s['title'] ?>" target="_blank" class="pic">
                                <img src="<?= SITEPATH ?>/<?= $s['image'] ?>" alt="<?= $s['title'] ?>" data-toggle="tooltip" data-placement="right" title="<?=$s['desc']?>"/>
                                <h3><?= $s['title'] ?></h3>
                            </a>                            
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="slide-tab">
                    <?php foreach ($update as $s): ?>
                        <li>
                            <span></span>
                            <img src="<?= SITEPATH ?>/<?= $s['image'] ?>" alt="<?= $s['title'] ?>"/>
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
        focusSwitch('.slideshow', '.slide-con', '.slide-tab', 2500);
        $('[data-toggle="tooltip"]').tooltip({html:true,container: 'body'});
        //$("img.lazy").lazyload();
    });
</script>

<?php include VIEWPATH . "footer.php" ?>