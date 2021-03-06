<?php
    session_start();
    if(isset($_SESSION["username"])){
    }else{
        echo "<script>alert('请登录！');location.href='login.php';</script>";
    }
?>
<?php
  header("Content-type:text/html;charset=utf8;");
  $pdo = new PDO("mysql:local=localhost;dbname=db_ph","root","root");
  $pdo -> query("set names utf8;");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
  <div class="topbar-wrap white">
      <div class="topbar-inner clearfix">
          <div class="topbar-logo-wrap clearfix">
              <h1 class="topbar-logo none"><a href="index.php" class="navbar-brand">后台管理</a></h1>
              <ul class="navbar-list clearfix">
                  <li><a class="on" href="index.php">首页</a></li>
              </ul>
          </div>
          <div class="top-info-wrap">
              <ul class="top-info-list clearfix">
                  <li><a href="#"><?php echo $_SESSION['username']; ?></a></li>
                  <li><a href="resetpassword.php?id=<?php echo $_SESSION['id']; ?>">修改密码</a></li>
                  <li><a href="logout.php">退出</a></li>
              </ul>
          </div>
      </div>
  </div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="table.php"><i class="icon-font">&#xe008;</i>订单管理</a></li>
                        <li><a href="sender.php"><i class="icon-font">&#xe005;</i>配送人员管理</a></li>
                        <li><a href="user.php"><i class="icon-font">&#xe006;</i>用户管理</a></li>
                        <li><a href="admin.php"><i class="icon-font">&#xe004;</i>管理员管理</a></li>
                        <li><a href="advertisement.php"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.php"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="cleancache.php"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="backup.php"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="restore.php"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">配送人员管理</span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post" action="conn_admin/DoSenderDeleteSomes.php">
                <div class="result-title">
                    <div class="result-list">
                        <a href="senderadd.php"><i class="icon-font"></i>新增配送人员</a>
                        <a id="batchDel" onclick="document.getElementById('myform').submit();"><i class="icon-font" ></i>批量删除</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>ID</th>
                            <th>姓名</th>
                            <th>联系方式</th>
                            <th>工作态度</th>
                            <th>操作</th>
                        </tr>
                        <?php
                          $res_s = $pdo -> query("select * from tb_worker");
                          $count = $pdo -> query("select count(*) from tb_worker");
                          foreach ($res_s as $key => $show) {
                            $show_id = $show['id'];
                            echo "<tr>
                               <td class=\"tc\"><input name=\"id_".$show_id."\" value=\"".$show_id."\" type=\"checkbox\"></td>
                               <td>".$show['id']."</td>
                               <td>".$show['name']."</td>
                               <td>".$show['phone']."</td>
                               <td>".$show['cred']."</td>
                               <td>
                                   <a class=\"link-update\" href=\"senderalt.php?id=".$show_id."\">修改</a>
                                   <a class=\"link-del\" href=\"conn_admin/DoSenderDelete.php?del_id=".$show_id."\">删除</a>
                               </td>
                           </tr>";
                          }
                         ?>
                    </table>
                    <?php
                      $count_show = $count -> fetch();
                     ?>
                    <div class="list-page"> <?php echo $count_show[0]; ?> 条 1/1 页</div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
