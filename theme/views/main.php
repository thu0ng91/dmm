<?php include VIEWPATH . "header.php" ?>
<div class="col-md-8 col-md-offset-2">
    <div class="fleft slideshow">
        <ul class="slide-con">
            <li>
                <a href="http://www.5xsk.com/book/1609.html" title="绝世邪神(邪御天娇)" target="_blank" class="pic"><img src="http://www.5xsk.com/files/article/image/1/1609/1609s.jpg" alt="绝世邪神(邪御天娇)"/></a>

                <h3><a href="http://www.5xsk.com/book/1609.html" title="绝世邪神(邪御天娇)" target="_blank">绝世邪神(邪御天娇)</a></h3>

                <p><a href="http://www.5xsk.com/book/1609.html" title="绝世邪神(邪御天娇)" target="_blank"></a></p>
            </li>
            <li>
                <a href="http://www.5xsk.com/book/672.html" title="去你妹的武侠" target="_blank" class="pic"><img src="http://www.5xsk.com/files/article/image/0/672/672s.jpg" alt="去你妹的武侠"/></a>

                <h3><a href="http://www.5xsk.com/book/672.html" title="去你妹的武侠" target="_blank">去你妹的武侠</a></h3>

                <p><a href="http://www.5xsk.com/book/672.html" title="去你妹的武侠" target="_blank"></a></p>
            </li>
            <li>
                <a href="http://www.5xsk.com/book/153.html" title="我欲封天" target="_blank" class="pic"><img src="http://www.5xsk.com/files/article/image/0/153/153s.jpg" alt="我欲封天"/></a>

                <h3><a href="http://www.5xsk.com/book/153.html" title="我欲封天" target="_blank">我欲封天</a></h3>

                <p><a href="http://www.5xsk.com/book/153.html" title="我欲封天" target="_blank"></a></p>
            </li>
            <li>
                <a href="http://www.5xsk.com/book/2696.html" title="无尽破碎" target="_blank" class="pic"><img src="http://www.5xsk.com/files/article/image/2/2696/2696s.jpg" alt="无尽破碎"/></a>

                <h3><a href="http://www.5xsk.com/book/2696.html" title="无尽破碎" target="_blank">无尽破碎</a></h3>

                <p>
                    <a href="http://www.5xsk.com/book/2696.html" title="无尽破碎" target="_blank"> 　　破碎虚空，前路何在？寰宇之外又有大千，那便叫这无尽枷锁于煌煌剑威下彻底粉碎！剑铸吾身，身临百战，跨越无数战场而不败...</a>
                </p>
            </li>
            <li>
                <a href="http://www.5xsk.com/book/361.html" title="帝御山河" target="_blank" class="pic"><img src="http://www.5xsk.com/files/article/image/0/361/361s.jpg" alt="帝御山河"/></a>

                <h3><a href="http://www.5xsk.com/book/361.html" title="帝御山河" target="_blank">帝御山河</a></h3>

                <p><a href="http://www.5xsk.com/book/361.html" title="帝御山河" target="_blank"></a></p>
            </li>
        </ul>
        <ul class="slide-tab">
            <li><span></span><img src="http://www.5xsk.com/files/article/image/1/1609/1609s.jpg" alt="绝世邪神(邪御天娇)"/></li>
            <li><span></span><img src="http://www.5xsk.com/files/article/image/0/672/672s.jpg" alt="去你妹的武侠"/></li>
            <li><span></span><img src="http://www.5xsk.com/files/article/image/0/153/153s.jpg" alt="我欲封天"/></li>
            <li><span></span><img src="http://www.5xsk.com/files/article/image/2/2696/2696s.jpg" alt="无尽破碎"/></li>
            <li><span></span><img src="http://www.5xsk.com/files/article/image/0/361/361s.jpg" alt="帝御山河"/></li>
        </ul>
    </div>
</div>
    <script type="text/javascript">
        function focusSwitch(focusBox, focusList, focusTab, speed) {
            if (!focusBox && !focusList && !focusTab) return;
            var i = 1, t = null, len = $(focusList + ' li').length;
            $(focusTab + ' li').mouseover(function () {
                i = $(focusTab + ' li').index($(this));
                addCurrent(i);
            });
            t = setInterval(init, speed);
            $(focusBox).hover(function () {
                clearInterval(t);
            }, function () {
                t = setInterval(init, speed);
            });
            function init() {
                addCurrent(i);
                i = (i + 1) % len;
            }
            function addCurrent(i) {
                $(focusTab + ' li').removeClass('on').eq(i).addClass('on');
                $(focusList + ' li').hide().eq(i).show();
            }
        }
        $(function() {
            $(".slideshow .slide-con li:eq(0)").show();
            $(".slideshow .slide-tab li:eq(0)").addClass("on");
            focusSwitch('.slideshow', '.slide-con', '.slide-tab', 2500);
            //$("img.lazy").lazyload();
        });
    </script>

<?php include VIEWPATH . "footer.php" ?>