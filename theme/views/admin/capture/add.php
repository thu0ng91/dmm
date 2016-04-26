<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    查看规则
                    <i class="icon-hand-left"></i>
                </a>
            </h4>
            填写规则时，尽量保证唯一性、简短。每个规则不能超出２５５个字符。
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <ul>
                    <li>:book_id 小说ID号 </li>
                    <li>:s　空格或回车</li>
                    <li>() 采集的内容</li>
                    <li>:cn 中文，包括英文字母、数字、下划线</li>
                    <li>:en 英文字母、数字、下划线</li>
                    <li>:num 数字</li>
                    <li>:char 所有字符，包括换行符</li>
                    <li>:cr 换行符</li>
                    <li>:page /1/2.html或.php.htm</li>
                    <li>+ 在与:s和:cr联合时代表多个空格或换行</li>
                    <li>支持直接写入正则表达式，正则中/前不要加\，正则表达式前后不要加/</li>
                </ul>      
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel-body">
        <form action="<?=SITEPATH?>/admin/capture/add" method="post">

            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">站点设置</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">小说信息</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">章节内容</a></li>                    
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="form-group">
                            <label for="titleLabel">站点标题</label>
                            <input type="text" class="form-control" id="site_title" name="site_title" placeholder="Title" value="<?= isset($capture) ? $capture['site_title'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">站点地址</label>
                            <input type="text" class="form-control" id="site_url" name="site_url" placeholder="Site URL" value="<?= isset($capture) ? $capture['site_url'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">小说地址</label>
                            <input type="text" class="form-control" id="book_url" name="book_url" placeholder="Book URL" value="<?= isset($capture) ? $capture['book_url'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">搜索地址</label>
                            <input type="text" class="form-control" id="search_url" name="search_url" placeholder="Book URL" value="<?= isset($capture) ? $capture['search_url'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">搜索小说地址规则</label>
                            <textarea class="form-control" name="search_book_url"><?= isset($capture) ? htmlspecialchars($capture['search_book_url']) : '' ?></textarea>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="form-group">
                            <label for="titleLabel">小说标题</label>
                            <textarea class="form-control" name="book_title"><?= isset($capture) ? htmlspecialchars($capture['book_title']) : '' ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">小说作者</label>
                            <textarea class="form-control" name="book_author"><?= isset($capture) ? htmlspecialchars($capture['book_author']) : '' ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">小说描述</label>
                            <textarea class="form-control" name="book_desc"><?= isset($capture) ? htmlspecialchars($capture['book_desc']) : '' ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">小说图片</label>
                            <textarea class="form-control" name="book_img"><?= isset($capture) ? htmlspecialchars($capture['book_img']) : '' ?></textarea>
                        </div>                        

                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        <div class="form-group">
                            <label for="titleLabel">章节列表地址</label>
                            <textarea class="form-control" name="chapter_list_url"><?= isset($capture) ? htmlspecialchars($capture['chapter_list_url']) : '' ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">章节地址及标题</label><br>同时取出地址及标题，一般情况下第一个为地址，第二个为标题。
                            <textarea class="form-control" name="chapter_url_title"><?= isset($capture) ? htmlspecialchars($capture['chapter_url_title']) : '' ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">章节内容地址</label><br>章节内容地址，一般不需要修改。
                            <textarea class="form-control" name="chapter_url"><?= isset($capture) ? htmlspecialchars($capture['chapter_url']) : '' ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="titleLabel">章节内容</label>
                            <textarea class="form-control" name="chapter_content"><?= isset($capture) ? htmlspecialchars($capture['chapter_content']) : '' ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="titleLabel">测试书号ID</label>
                            <input type="text" class="form-control" id="test_id" name="test_id" placeholder="Book URL" value="<?= isset($capture) ? $capture['test_id'] : '' ?>">
                        </div>
                    </div>

                </div>

            </div>
            
            <div class="col-sm-offset-2 col-sm-10 btn-group" role="group">
                <?php if (isset($capture)):?>
                <input type="hidden" name="id" value="<?=$capture['id']?>"/>
                <?php endif;?>
                <button type="submit" class="btn btn-success">提交</button>
                <button type="reset" class="btn btn-info" onclick="BootstrapDialog.closeAll();">取消</button>
            </div>
            
        </form>
    </div>
</div>
