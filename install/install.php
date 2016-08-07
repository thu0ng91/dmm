<?php

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('INSTALLPATH', dirname($_SERVER["SCRIPT_FILENAME"]) . '/');
define('BASEPATH', str_ireplace('install/', '', INSTALLPATH));
define('SITEURL', str_ireplace('install/', '', $_SERVER["HTTP_REFERER"]));

if (!isset($_GET['step'])) {
    echo "";
    exit;
}

switch ($_GET['step']) {
    default :
    case 1:
        check_system();
        break;
    case 2:
        set_database();
        break;
    case 3:
        import_database();
        break;
    case 4:
        finish_install();
        break;
    case 5:
        set_config();
        break;
    case 6:
        test_database_connect();
        break;
}

function check_system() {
    $directorys = array(
        'app/cache',
        'app/logs',
        'app/config/config.php',
        'app/config/database.php',
        'books',
        'books/uploads'
    );

    $premit = TRUE;

    echo '<div class="well">将下列目录/文件设置成可写。</div>';

    foreach ($directorys as $dir) {
        $prem = check_write(BASEPATH . $dir);

        if ($prem) {
            $check = 'icon-ok';
        } else {
            $check  = 'icon-remove text-danger';
            $premit = FALSE;
        }

        $str = '<div class="row"><div class="col-md-5">' . $dir . '</div>' . '<div class="col-md-5">..........................................</div>' . '<div class="col-md-1"><i class="' . $check . '"></i></div>' . '</div>';
        echo $str;
    }
    echo '<br />';
    if (!$premit) {
        echo '<button type="button" class="btn btn-warning" onclick="getStep(1);">重新检测</button>';
    } else { ?>
        <form id="database" role="form">
            <div class="input-group">
                <span class="input-group-addon">网站地址</span>
                <input type="text" class="form-control" id="siteurl" value="<?php echo SITEURL; ?>">
            </div>
            <br/>

            <div class="pull-right">
                <button type="button" class="btn btn-success" onclick="getStep(2);">下一步</button>
            </div>
        </form>
    <?php }
}

function check_write($directory) {
    if (is_dir($directory) && $fp = @fopen($directory . '/test.txt', 'w+')) {
        fwrite($fp, 'test');
        fclose($fp);
        unlink($directory . '/test.txt');
        return TRUE;
    } elseif (is_writable($directory)) {
        return TRUE;
    }
    return FALSE;
}

function set_config() {
    $siteurl = $_POST['siteurl'];
    $config  = file_get_contents(BASEPATH . 'app/config/config.php');
    $config  = preg_replace("/config\['base_url'\]\s*=\s*'.*'/i", "config['base_url'] = '{$siteurl}'", $config);
    file_put_contents(BASEPATH . 'app/config/config.php', $config);
}

function set_database() {
    ?>
    <form id="database" role="form">
        <div class="input-group">
            <span class="input-group-addon">数据库地址</span>
            <input type="text" class="form-control" id="db_host" value="localhost">
        </div>
        <br/>

        <div class="input-group">
            <span class="input-group-addon">数据库名称</span>
            <input type="text" class="form-control" id="db_name" value="dmnovel">
        </div>
        <br/>

        <div class="input-group">
            <span class="input-group-addon">管理员名称</span>
            <input type="text" class="form-control" id="db_user" value="root">
        </div>
        <br/>

        <div class="input-group">
            <span class="input-group-addon">管理员密码</span>
            <input type="text" class="form-control" id="db_pass" VALUE="123456">
        </div>
        <br/>

        <div class="checkbox">
            <label>
                <input type="checkbox" id="db_cover"> 覆盖原表（如果表存在，将删除原表，重新建立)
            </label>
        </div>
    </form>
    <br/>
    <div class="pull-right">
        <button type="button" class="btn btn-primary" onclick="getStep(1);">上一步</button>
        <button type="button" class="btn btn-success" onclick="getStep(3);">下一步</button>
    </div>
    <?php
}

function test_database_connect() {
    $db_host = $_POST['db_host'];
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_pass = $_POST['db_pass'];

    $db = new mysqli($db_host, $db_user, $db_pass) or die("不能连接到数据库，请检查用户名、密码是否输入错误！");

    $table = $db->select_db($db_name);
    if (!$table) {
       $db->query('CREATE DATABASE '.$db_name);
    }

    $config = file_get_contents(BASEPATH . 'app/config/database.php');
    $config = preg_replace("/'hostname'\s*=>\s*'.*'/i", "'hostname'=>'{$db_host}'", $config);
    $config = preg_replace("/'username'\s*=>\s*'.*'/i", "'username'=>'{$db_user}'", $config);
    $config = preg_replace("/'password'\s*=>\s*'.*'/i", "'password'=>'{$db_pass}'", $config);
    $config = preg_replace("/'database'\s*=>\s*'.*'/i", "'database'=>'{$db_name}'", $config);
    file_put_contents(BASEPATH . 'app/config/database.php', $config);
}

function import_database() {
    $db_cover = $_GET['db_cover'];
    require_once BASEPATH . 'app/config/database.php';

    $sqlstr = file_get_contents(BASEPATH . '/install/install.sql');

    $sqls = explode(';', $sqlstr);

    if (!$database =new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'])) {
        echo "不能连接到数据库，请检查是否输入错误！";
        exit();
    }

    if (!$database->select_db($db['default']['database'])) {
        echo "数据库 {$db['default']['database']} 不存在！";
        exit();
    }
    $database->set_charset('utf8');

    header("Content-Type:text/html;charset=utf8;");

    ob_start();

    foreach ($sqls as $sql) {
        if (preg_match('/(CREATE|insert).*`(' . $db['default']['dbprefix'] . '\w+)`/i', $sql, $match)) {
            echo str_pad('', 4096) . "\n";
            switch (strtolower($match[1])) {
                case 'create':
                    echo '创建表：';
                    if ($db_cover == 1) {
                        $str = "DROP TABLE IF EXISTS {$match[2]} ;";
                        $database->query($str) or die($database->error);
                    }
                    break;
                case 'insert':
                    echo '插入表数据:';
                    break;
            }
            echo $match[2] . '<br />';
            ob_flush();
            flush();
            $database->query($sql) or die($database->error);
        }
    }
    ob_end_clean();
    ?>
    <div class="pull-right">
        <button type="button" class="btn btn-primary" onclick="getStep(2);">上一步</button>
        <button type="button" class="btn btn-success" onclick="getStep(4);">下一步</button>
    </div>
    <?php
}

function finish_install() {
    ?>
    <h2>恭喜：）  已经完成安装。</h2>
    <div class="well">
        <h4>
            <li><a href="<?=SITEURL?>">首页</a></li>
            <li><a href="<?=SITEURL?>admin">后台</li>
        </h4>
    </div>
<?php
}