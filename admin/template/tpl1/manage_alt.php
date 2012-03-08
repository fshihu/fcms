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
                <?php  $curnavarr=$manage->query($pid);?>
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?> " method="post">
                    <div class="info">
                        <?php echo $actinfo;?>
                    </div>
                    <div class="line">
                        <label>目录名称</label>
                        <input type="text" name="cname" value="<?php echo $curnavarr[0]['cat_name']?>"> *
                    </div>
                    <div class="line"><label>模板类型</label>
                        <select name="ctpl">
                            <?php
                            foreach ($table->query() as $val) {
                                 printf('<option value="%s" %s>%s</option>',
                                     $val['id'],
                                     $curnavarr[0]['cat_tpl_id']===$val['id']?'select=select':'',
                                     $val['table_desc']
                                 );
                            }
                            ?>

                        </select>
                    </div>
                    <div class="line">
                        <lable>列表文件</lable>
                        <input type="text" name="lfile" value="<?php echo $curnavarr[0]['list_flie']?>">
                    </div>
                    <div class="line">
                        <lable>列表模板</lable>
                        <input type="text" name="ltpl" value="<?php echo $curnavarr[0]['list_tpl']?>">
                    </div>
                    <div class="line">
                        <lable>文件模板</lable>
                        <input type="text" name="ftpl" value="<?php echo $curnavarr[0]['file_tpl']?>">
                    </div>
                    <div class="line">
                        <lable>命名规则</lable>
                        <input type="text" name="nrule" value="<?php echo $curnavarr[0]['name_rule']?>">
                    </div>
                    <div class="line">
                        <lable>分页</lable>
                        <input type="text" name="pnum"   value="<?php echo $curnavarr[0]['page_num']?>">
                    </div>
                    <div class="line">
                        <lable>文件上传路径</lable>
                        <input type="text" name="fpath"  value="<?php echo $curnavarr[0]['file_path']?>">
                    </div>

                    <div class="line"><input type="submit" value="修改目录"></div>
                </form>

            </div>
        </div>
        <?php include 'mod_footer.php'; ?>
    </div>
</div>


</body>
</html>
