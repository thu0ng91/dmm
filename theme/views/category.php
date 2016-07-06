<div class="col-md-8 col-md-offset-2" id="story_list">
    <input type="hidden" name="start_page" value="<?= $per_page ?>" autocomplete="off" />
    <input type="hidden" name="all_page" value="<?= $all ?>" autocomplete="off" />
    <?php include VIEWPATH . "list.php" ?>
</div>

<script src="<?= THEMEPATH ?>/js/masonry.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#story_list').masonry({
            itemSelector: '.story-list',
            columnWidth: 20
        });

        $(window).scroll(function () {
            if ($(document).height() - $(window).height() - $(document).scrollTop() < 1) {
                var start = $('input[name=start_page]').val();
                var all = $('input[name=all_page]').val();
                if (start < all) {
                    ajax_load_story(start);
                }
            }
        });

        var ajax_load_story = function (start) {
            $('input[name=start_page]').val(parseInt(start) + <?=$per_page?>);
            $.get('<?=SITEPATH?>/category/page/<?=$category_id?>/' + start, function (data) {
                var str = $(data);
                $('#story_list').append(str).masonry('appended', str).masonry();
            });
        }
    })
</script> 