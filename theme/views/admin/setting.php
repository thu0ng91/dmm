<?php include VIEWPATH . "admin/iframe_header.php" ?>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <h4>配置列表</h4>
        </div>
        <div class="panel-body">
            新建、修改配置，不可删除，双击配置值、描述可进行编辑。可使用右键菜单。<b>请谨慎操作。</b>

            <div class="btn-group pull-right" role="group" aria-label="...">
                <button type="button" class="btn btn-default btn-warning" title="全部保存"
                    id="save_modify"><i
                        class="glyphicon glyphicon-floppy-disk"></i>
                    全部保存
                </button>
                <button type="button" class="btn btn-default btn-primary" openDialog="<?= SITEPATH ?>/admin/setting/create" title="新建配置项"
                    id="create_menu"><i
                        class="glyphicon glyphicon-plus"></i>
                    新建配置项
                </button>
            </div>

        </div>
        <table class="table table-striped table-hover" id="setting_table">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>描述</th>
                <th>值</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($settings as $s): ?>
                <tr id="<?= $s['id'] ?>">
                    <td><?= $s['id'] ?></td>
                    <td><?= $s['title'] ?></td>
                    <td id="desc"><?= $s['desc'] ?></td>
                    <td id="value"><?= $s['value'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class="pull-right">
        <?= $pagination ?>
    </div>


    <script type="text/javascript">
        $(function () {
            //双击td进行修改
            $('td[id]').dblclick(function () {
                if ($(this).find('div').length >= 1) {
                    return;
                }

                id = $(this).parent('tr').attr('id');
                field = $(this).attr('id');
                value = $(this).text();
                //将td内容换成输入框
                str = '<div class="input-group" id="' + id + '"><input type="text" id="input_' + id + '" class="form-control" name="' + field + '" value="' + value + '" />' +
                    '<span class="input-group-btn"><button class="btn  btn-warning" id="submit_modify_' + id + '">' +
                    '<i class="glyphicon glyphicon-ok" /></button><button class="btn btn-warning cancel"><i class="glyphicon glyphicon-remove"></button> </span></div>';
                $(this).html(str);
                $('#input_' + id).focus().select();
                tdObj = $(this);
                //提交输入框内容
                $('#submit_modify_' + id).click(function () {
                    //获取td对象
                    $value = $(this).parent('span').prev('input').val();//获取修改后值
                    $.post('setting/edit', {
                        id: id,//修改项的ID
                        field: field,//修改列的名称
                        value: $value//修改后的值
                    }, function (data) {
                        if (data) {
                            alert(data);
                        } else {
                            tdObj.html($value);
                        }
                    });
                });
                $('td').on('click', '.cancel', function () {
                    tdObj.html(value);
                })
            });


            //点击全部保存进行修改
            $('#save_modify').click(function () {
                $('.input-group').each(function () {
                    tdObj = $(this).parent('td');
                    id = $(this).attr('id');
                    field = $(this).children('input').attr('name');
                    value = $(this).children('input').val();
                    $.ajax({
                        type: "post",
                        url: "<?=SITEPATH?>/admin/setting/edit",
                        data: {
                            id: id,//修改项的ID
                            field: field,//修改列的名称
                            value: value//修改后的值
                        },
                        async: false,
                        success: function (data) {
                            if (data) {
                                alert(data);
                            } else {
                                tdObj.html(value);
                            }
                        }
                    });
                });
            });
        });
    </script>
<?php include VIEWPATH . "admin/iframe_footer.php" ?>