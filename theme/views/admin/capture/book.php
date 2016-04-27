<?php include VIEWPATH . "admin/iframe_header.php" ?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $book['title'] ?>
        </h3>

        <div class="btn-group-xs btn-group">
            <a class="btn btn-primary" href="<?= SITEPATH ?>/admin/capture/get">
                <i class="icon-cloud-download"></i>
                继续采集
            </a>
            <a class="btn btn-success" href="#" onclick="location.reload();">
                <i class="icon-refresh"></i>
                刷新失败
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="capture">

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        var data = <?=$chapter_list?>;
        var i = 0;
        $.each(data, function (key, ch) {
            html = $.ajax({
                url: '<?=SITEPATH?>/admin/capture/get_chapter',
                async: false,
                dataType: 'text',
                type: 'POST',
                data: {
                    url: '<?=$capture_url?>/' + ch.url,
                    title: ch.title,
                    story_id: '<?=$book['id']?>',
                    order: ch.order ? ch.order : parseInt(<?=$order?>) + i
                }
            }).responseText;
            $('.capture').append(ch.title + ' ====> ' + html + '&nbsp;&nbsp;');
            $('.capture').scrollTop($('.capture')[0].scrollHeight);
            i++;
        })
    });
</script>
<?php include VIEWPATH . "admin/iframe_footer.php" ?>
