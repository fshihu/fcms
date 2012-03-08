<?php
/**
 * User: fu
 * Date: 12-3-5
 * Time: 下午4:30
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

                <form action="<?php echo $_SERVER['REQUEST_URI']; ?> " method="post">
                    <div class="info">
                        <?php echo $actinfo;?>
                    </div>
                    <?php
                    foreach ($filedarr as $filedval) {
                        if(in_array($filedval['filed_type'],Filed::$filetypespec)){
                            $fileddet=sprintf(Filed::$filetypedet[$filedval['filed_type']],
                                $filedval['filed_name'],$curtablearr[0][$filedval['filed_desc']],$filedval['filed_name']);
                        }else{
                            $fileddet=sprintf(Filed::$filetypedet[$filedval['filed_type']],
                                $filedval['filed_name'],$curtablearr[0][$filedval['filed_desc']]);
                        }


                        printf('<div class="line"><label>%s</label>%s</div>', $filedval['filed_desc'],$fileddet);
                    }

                    ?>

                    <div  class="line"><input type="submit" value="修改"></div>
                </form>

            </div>
        </div>
        <?php include 'mod_footer.php'; ?>
    </div>
</div>


</body>
</html>