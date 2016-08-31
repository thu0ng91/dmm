(function ($) {
    $.fn.extend({
        MyPagination: function (options) {

            var options = $.extend({
                width:  400,
                height: '400px',
                fadeSpeed: 200,
                fontSize: '20px',
                lineHeight: '30px'
            }, options || {});

            var $content = $(this);


            var lastPage;
            var cPage = 1;

            setContent = function () {
                $content.addClass('mycontent');
                $content.css("font-size", options.fontSize);
                $content.css("line-height", options.lineHeight);

                lastPage = Math.ceil($content.outerHeight() / (options.height-30));
                $content.height(options.height);
                $content.css("column-width", options.width + 'px');
                $content.css("-moz-column-width", options.width + 'px');
                $content.css("-webkit-column-width", options.width + 'px');
                //lastPage=Math.ceil($('#offset').position().left / (options.width+14));

            };


            showPage = function (page) {
                if (page < 1) {
                    window.location.href = $('#prev_url').attr('href');
                }
                if (page > lastPage) {
                    window.location.href = $('#next_url').attr('href');
                }

                cPage = page;

                var scrollLeft = (page - 1) * (options.width + 20);

                $content.animate({
                    scrollLeft: scrollLeft
                }, options.fadeSpeed);

                $("#cPage").html(page + '/' + lastPage);
            };

            setContent();
            showPage(1);

            // and binding 2 events - on clicking to Prev
            $('#prev').mousedown(function () {
                showPage(cPage - 1);
            });

            $(document).keyup(function (e) {
                var key = e.which;
                if (key === 37 || key === 38) {
                    showPage(cPage - 1);
                } else if (key === 39 || key === 40) {
                    showPage(cPage + 1);
                }
            });

            // and Next
            $('#next').mousedown(function () {
                showPage(cPage + 1);
            });

            $('.pagination').on("swipeleft",'dd',function(){
                alert(1);
                showPage(cPage + 1);
            });
            $('.pagination').on("swiperight",'dd',function(){
                showPage(cPage - 1);
            });
        }
    });
})(jQuery);


