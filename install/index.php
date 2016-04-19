<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8" />
        <title>安装程序</title>

        <link rel="stylesheet" href="../theme/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="../theme/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="instsll.css" type="text/css" />
        <script src="../theme/js/jquery.min.js"></script>
        <script src="../theme/js/bootstrap.min.js"></script>
        <script src="./install.js"></script>
        <script type="text/javascript">
            $(function() {
                getStep(1);
            });
        </script>

    </head>
    <body>
        <div class="header">
            <h1>CodeStation 安装程序</h1>
        </div>
        <div class="main panel panel-primary">

            <div class="panel-heading"><h2>第 <i id="step">1</i> 步</h2></div>
            <div class="panel-body row">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%;" id="progress"> 
                       1%
                    </div>
                </div>

                <div class="col-md-4">
                    <ol id="step-list" class="nav nav-pills nav-stacked" role="tablist">
                        <li role="presentation" class="active" id="step1"><a href="javascript:void(0)" onclick="getStep(1);">1、检测环境</a></li>
                        <li role="presentation" class="disabled" id="step2"><a href="javascript:void(0)" onclick="getStep(2);">2、设定数据库</a></li>
                        <li role="presentation" class="disabled" id="step3"><a href="javascript:void(0)" onclick="getStep(3);">3、导入数据库</a></li>
                        <li role="presentation" class="disabled" id="step4"><a href="javascript:void(0)" onclick="getStep(4);">4、安装完成</a></li>
                    </ol>
                </div>
                <div class="alert alert-warning alert-dismissible warnbox" id="warning" style="display: none;" role="alert">

    </div>
                <div class="col-md-8" id="step-content">
    
                </div>
            </div>
        </div>
    </body>
</html>