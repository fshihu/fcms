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
           <div class="prinavw">
               <?php include  'mod_prinav.php' ?>
           </div>
           <div class="pricont">

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?> " method="post">
                <div class="info">
                    <?php echo $actinfo;?>
                </div>
                <div  class="line"><label>字段名</label><input type="text" name="fname"> *</div>
                <div  class="line"><label>字段描述</label> <input type="text" name="fdesc"> *</div>
                <div  class="line"><label>字段类型</label>
                    <select name="ftype">
                        <?php
                        foreach (Filed::$filetype as $k => $v) {
                            printf('<option value="%s">%s</option>',$k,$k);
                         }
                        ?>
                    </select>
                </div>
                <div  class="line"><input type="submit" value="添加字段"></div>
            </form>
           </div>
       </div>
       <?php include 'mod_footer.php'; ?>
   </div>
</div>


</body>
</html>
