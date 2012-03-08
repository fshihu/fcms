<?php
/**
 * User: onwer
 * Date: 11-11-28
 * Time: 下午11:41
 */
include_once 'Table.php';
include_once 'Manage.php';
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
    public function del($cid,$id){
        $manage=new Manage();
        $r1 = $manage->query($cid);
        $table= new Table();
        $tablearr=$table->query('',$r1[0]['cat_tpl_id']);

        $sql=sprintf('DELETE FROM `fcms`.`f_system_news` WHERE `%s`.`id` = %d',$tablearr[0]['table_name'],$id);
        $r = $this->pdo->exec($sql);
        $this->errorinfo = $this->pdo->errorInfo();
        if ($r === false) {
            return false;
        }
        return true;
    }
    /**
     * @param  int $catid 管理表ID、显示数据表
     * @param   int $id 管理表ID、显示管理表
     * @param int $curid 具体数据表中的ID
     * @return array
     */
    public function query($catid=-1,$id=-1,$curid=-1)
    {
        if($catid===-1){
            $sql=sprintf('SELECT * FROM  `f_system_manage`  WHERE  `id` =%d  ',$id);
            $sth = $this->pdo->query($sql);
            $r0 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $this->errorinfo = $sth->errorInfo();
            return $r0;
        }
          //查找表ID
        $manage=new Manage();
        $r1 = $manage->query($catid);
        $table= new Table();

        $tablearr=$table->query('',$r1[0]['cat_tpl_id']);
        if(empty($tablearr)){
            return array();
        }

        $tablename=$tablearr[0]['table_name'];


        //查找可显示的字段
        $filed = new Filed();
        $r3 = $filed->query($r1[0]['cat_tpl_id']);
        //所有的字段
        $showfiled = 'id,';
        foreach ($r3 as $v) {
            $showfiled .= sprintf('%s as %s,',$v['filed_name'],$v['filed_desc']);
        }

        $showfiled = substr($showfiled, 0, -1);
        $where=sprintf(' cat_id=%d ',$catid);
       //如果有具体的ID、显示具体数据
        if($curid>-1){
            $where.=sprintf(' and id=%d',$curid);
        }
        $sql = sprintf('SELECT %s FROM  `%s` WHERE %s ', $showfiled, $tablename,$where);
        $sth = $this->pdo->query($sql);
        $r4 = $sth->fetchAll(PDO::FETCH_ASSOC);
        $this->errorinfo = $sth->errorInfo();

        return $r4;
    }

}
