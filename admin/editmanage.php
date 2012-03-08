<?php
/**
 * User: Administrator
 * Date: 12-2-29
 * Time: 下午5:58
 */
require 'lib/lib.php';
include 'islogin.php';



$act = isset($_GET['act']) ? $_GET['act'] : '';
$actinfo='';
$pid=isset($_GET['pid'])?$_GET['pid']:0;

$manage=new Manage();
switch ($act) {
    case 'alt':{

        if(isset($_POST['cname'])&&isset($_POST['ctpl'])&&isset($_POST['lfile'])&&isset($_POST['ltpl'])
            &&isset($_POST['ftpl']) &&isset($_POST['nrule'])&&isset($_POST['pnum'])&&isset($_POST['fpath'])){
            $manage=new Manage();
            if($manage->update($_POST['cname'],$_POST['ctpl'],$_POST['lfile'],$_POST['ltpl'],$_POST['ftpl'],
                            $_POST['nrule'],$_POST['pnum'],$_POST['fpath'],$pid)){
                $actinfo='修改成功！';
            }else{
                $actinfo=$manage->errorinfo[2];
            }

        }

        include ADMIN_TPL_SRC . 'manage_alt.php';
        break;
    }
    case 'del':{
        if( isset($_GET['confirm'])&&$_GET['confirm']==='yes'){

            if($manage->del($pid)){
                $actinfo = '删除成功！';
            }else{
                $actinfo = $manage->errorinfo[2];
            }

        }

        include ADMIN_TPL_SRC . 'manage_del.php';
        break;
    }
    default:{
        if(isset($_POST['cname'])&&isset($_POST['ctpl'])&&isset($_POST['lfile'])&&isset($_POST['ltpl'])
            &&isset($_POST['ftpl']) &&isset($_POST['nrule'])&&isset($_POST['pnum'])&&isset($_POST['fpath'])){
            if($manage->create($_POST['cname'],$_POST['ctpl'],$_POST['lfile'],$_POST['ltpl'],$_POST['ftpl'],
                            $_POST['nrule'],$_POST['pnum'],$_POST['fpath'],$pid)){
                $actinfo='建立成功！';
            }else{
                $actinfo=$manage->errorinfo[2];
            }

        }
        include ADMIN_TPL_SRC . 'manage_add.php';
        break;
    }
}

?>

