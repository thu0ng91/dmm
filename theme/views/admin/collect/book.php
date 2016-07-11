<?php include VIEWPATH . "admin/iframe_header.php" ?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $book['title'] ?>
        </h3>

        <div class="btn-group-xs btn-group">
            <a class="btn btn-primary" href="<?= SITEPATH ?>/admin/collect/get">
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
        <div class="collect">

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        var data = <?=$chapter_list?>;
        var i = 0;
        $.each(data, function (key, ch) {
            html = $.ajax({
                url: '<?=SITEPATH?>/admin/collect/get_chapter',
                async: false,
                dataType: 'text',
                type: 'POST',
                data: {
                    url: '<?=$collect_url?>/' + ch.url,
                    title: ch.title,
                    collect_id: <?=$collect_id?>,
                    story_id: '<?=$book['id']?>',
                    order: ch.order ? ch.order : parseInt(<?=$order?>) + i
                }
            }).responseText;
            if (html=='失败') {
                $('.collect').append($('<s>',{style:'color:red;'}).append(ch.title + ' ====> ' + html + '&nbsp;&nbsp;'));
            } else {
                $('.collect').append(ch.title + ' ====> ' + html + '&nbsp;&nbsp;');
            }
            $('.collect').scrollTop($('.collect')[0].scrollHeight);
            i++;
        })
    });
</script>
<?php include VIEWPATH . "admin/iframe_footer.php" ?>
