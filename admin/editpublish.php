<?php
/**
 * User: fu
 * Date: 12-3-5
 * Time: 上午12:21
 */
require 'lib/lib.php';
include 'islogin.php';
$act=isset($_GET['act'])?$_GET['act']:'';
$actinfo='';
$cid=isset($_GET['cid'])?$_GET['cid']:0;
$publish=new Publish();
switch ($act){
    case 'add':{
        $manage=new Manage();
        $curdirarr = $manage->query($cid);
        $filedarr=$filed->query($curdirarr[0]['cat_tpl_id']);
        if(isset($_POST[$filedarr[0]['filed_name']])){
            $param=$_POST;

            if(!empty($_FILES)){
                foreach ($_FILES as $key => $val) {
                    if($val['name']){
                        $newfile=new File($val);
                        print_r($_FILES);
                        //TODO 发布ok？等文件上传？
                    }

                }

            }
            if($publish->add($cid,$param)){
                $actinfo='发布成功';
            }else{
                $actinfo=$publish->errorinfo[2];
            }
        }

        include ADMIN_TPL_SRC . 'publish_add.php';
        break;
    }
    case 'alt':{
        $manage=new Manage();
        $curdirarr = $manage->query($cid);

        $filedarr=$filed->query($curdirarr[0]['cat_tpl_id']);
        $curtablearr = $publish->query($cid,-1,$_GET['id']);
        //TODO 修改、发布？显示$publish->query？？

        include ADMIN_TPL_SRC . 'publish_alt.php';
        break;
    }
    case 'del':{
        if( isset($_GET['confirm'])&&$_GET['confirm']==='yes'){
            if($publish->del($cid,$_GET['id'])){
                $actinfo = '删除成功';
            }else{
                $publish = $filed->errorinfo[2];
            }

        }

        include ADMIN_TPL_SRC . 'publish_del.php';
        break;
    }
    default:{
        $pu_r=$publish->query($cid);
        include ADMIN_TPL_SRC . 'publish_show.php';
    }
}

?>

