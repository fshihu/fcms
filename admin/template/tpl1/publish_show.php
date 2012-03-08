<?php
/**
 * User: fu
 * Date: 12-3-5
 * Time: 下午3:12
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <title>管理表-FCMS管理系统</title>
    <meta name="keywords" content="FCMS管理系统"/>
    <meta name="description" content="FCMS管理系统"/>
    <?php include 'mod_head.php'; ?>

</head>
<body>
<div class="wraper">
    <div class="wrap">
        <?php include  'mod_header.php' ?>

        <div class="contenter">
            <?php include  'mod_prinav.php' ?>
            <div class="pricont">
                <div class="pricnav">
                    <a href="<?php echo Fun::curcul().'&act=add'?>">新建</a>
                </div>
                <table>
                    <thead>
                    <tr>
                        <?php
                            if(!empty($pu_r)){
                                foreach ($pu_r[0] as $k=>$v) {
                                    printf('<td>%s</td>',$k);
                                }

                            }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pu_r  as $val) {
                        echo '<tr>';
                        foreach ($val as $v) {
                            printf('<td>%s</td>',$v);
                        }
                        printf('<td><a href="editpublish.php?act=del&id=%s">删除</a></td>',$val['id']) ;
                        printf('<td><a href="%s&act=alt&id=%s">修改</a></td>',Fun::curcul(),$val['id']) ;
                        echo '</tr>';
                    }

                    ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php include 'mod_footer.php'; ?>
    </div>
</div>


</body>
</html>
