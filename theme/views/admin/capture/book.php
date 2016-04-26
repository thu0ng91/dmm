<?php include VIEWPATH . "admin/iframe_header.php" ?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $book['title'] ?>
        </h3>
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
            $('.capture').append(ch.title + ' ====> ' + html);
            i++;
        })
    });
</script>
<?php include VIEWPATH . "admin/iframe_footer.php" ?>
