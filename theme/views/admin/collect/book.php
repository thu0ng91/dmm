<?php include VIEWPATH . "admin/iframe_header.php" ?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $book['title'] ?>
        </h3>

        <div class="btn-group-xs btn-group">
            <a class="btn btn-primary" href="<?= site_url('/admin/collect') ?>">
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
        <div class="collect" id="collect">

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        var data = <?=$chapter_list?>;
        var i = 0;
        $.each(data, function (key, ch) {
            html = $.ajax({
                url: '<?= site_url('/admin/collect/get_chapter') ?>',
                async: false,
                dataType: 'text',
                type: 'POST',
                data: {
                    url: '<?=$book['chapter_url']?>/' + ch.url,
                    title: ch.title,
                    collect_id: <?=$book['collect_id']?>,
                    story_id: '<?=$book['story_id']?>',
                    order: ch.order ? ch.order : parseInt(<?=$order?>) + i
                }
            }).responseText;
            if (html == '失败') {
                $('#collect').append($('<s>', {style: 'color:red;'}).append(ch.title + ' ====> ' + html + '&nbsp;&nbsp;'));
            } else {
                $('#collect').append(ch.title + ' ====> ' + html + '&nbsp;&nbsp;');
            }
            $('#collect').scrollTop($('#collect')[0].scrollHeight);
            i++;
        });
        $('#collect').append('采集完成.');
    });
</script>
<?php include VIEWPATH . "admin/iframe_footer.php" ?>
