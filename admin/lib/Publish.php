<?php
/**
 * User: onwer
 * Date: 11-11-28
 * Time: 下午11:41
 */
include_once 'Table.php';
class Publish extends DB
{

    /**
     * 添加数据
     * @param  $catid int 目录ID
     * @param  $param array 对应的键值
     * @return bool
     */
    public function add($catid, $param)
    {
        $filed = '';
        $value = '';

        foreach ($param as $k => $v) {
            $v = $this->safefilter($v);
            $filed .= sprintf(' ,`%s`', $k);
            $value .= sprintf(' , %s', $v);
        }

        $curcatarr=$this->query(-1,$catid);
        $curtable=new Table();
        $curtablearr=$curtable->query('',$curcatarr[0]['cat_tpl_id']);

        $sql = sprintf('INSERT INTO  `fcms`.`%s` (
                    `id` ,
                    `cat_id`
                    %s
                    )
                    VALUES ( NULL ,  %d %s )',
                $curtablearr[0]['table_name'],$filed, $catid, $value);
        $r = $this->pdo->exec($sql);

        $this->errorinfo = $this->pdo->errorInfo();
        if ($r === false) {
            return false;
        }
        return true;

    }

    /**
     * @param  int $catid 管理表ID
     * @param   int $id
     * @return array
     */
    public function query($catid=-1,$id=-1)
    {
        if($catid===-1){
            $sql=sprintf('SELECT * FROM  `f_system_manage`  WHERE  `id` =%d  ',$id);
            $sth = $this->pdo->query($sql);
            $r0 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $this->errorinfo = $sth->errorInfo();
            return $r0;
        }
        //查找表ID
        $sql = sprintf('SELECT * FROM  `f_system_manage` WHERE  `id` =  %d LIMIT 0 , 1', $catid);
        $sth = $this->pdo->query($sql);
        $r1 = $sth->fetch(PDO::FETCH_ASSOC);
        $this->errorinfo = $sth->errorInfo();
        //查找表名
        $sql = sprintf('SELECT * FROM  `f_system_table` WHERE  `id` =  %d LIMIT 0 , 1', $r1['cat_tpl_id']);
        $sth = $this->pdo->query($sql);
        $r2 = $sth->fetch(PDO::FETCH_ASSOC);
        $this->errorinfo = $sth->errorInfo();
        $tablename =  $r2['table_name'];
        //没有这个表？
        if(!$tablename){
            return array();
        }
        //查找可显示的字段
        $filed = new Filed();
        $r3 = $filed->query($r1['cat_tpl_id']);
        //所有的字段
        $showfiled = 'id,';
        foreach ($r3 as $v) {
            $showfiled .= sprintf('%s as %s,',$v['filed_name'],$v['filed_desc']);
        }

        $showfiled = substr($showfiled, 0, -1);
        $sql = sprintf('SELECT %s FROM  `%s` WHERE  cat_id=%d', $showfiled, $tablename,$catid);
        $sth = $this->pdo->query($sql);
        $r4 = $sth->fetchAll(PDO::FETCH_ASSOC);
        $this->errorinfo = $sth->errorInfo();
        return $r4;
    }
}
