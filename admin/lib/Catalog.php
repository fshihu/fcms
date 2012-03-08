<?php
/**
 * User: Administrator
 * Date: 12-3-2
 * Time: 下午2:18
 */
class Catalog{
    protected $result='';
    protected $opt;
    public function  __construct($opt ){
        $this->opt=array('p_class'=>'parent',
                                 'i_class'=>'item',
                                 'c_class'=>'child',
                                 'item_fn'=>function($item){ return $item['id'];}
                            );
        //TODO 添加参数父ID？
        $this->setparm($opt);
    }
    public function setparm($opt){
        $this->opt=array_merge($this->opt,$opt);
        $this->result=new DOMDocument();
        $dl = $this->result->createElement('dl');
        $dl->setAttribute('class',$this->opt['p_class']);
        $this->result->appendChild($dl);
    }
    public function get($arr){
        $opt=$this->opt;
        $id=$opt['id'];
        $pid=$opt['pid'];
        foreach ($arr as $valarr) {

            if($valarr[$pid]==0){
                $this->catadd($valarr,$valarr[$id]);
            }else{
                $this->catchildadd($valarr,$valarr[$id],$valarr[$pid]);
            }

        }

        return html_entity_decode($this->result->saveHTML());

    }
    protected function catadd($item,$id){
        $opt=$this->opt;
        $itemfn=$opt['item_fn'];

        $dt = $this->result->createElement('dt',$itemfn($item));
        $dt->setAttribute('class',sprintf('%s %s_%d',$opt['p_class'],$opt['i_class'],$id));

        $this->result->documentElement->appendChild($dt);

    }
    protected function query($tag,$class=''){
        $nodes=$this->result->getElementsByTagName($tag);

        foreach($nodes as $node){
            if($node->attributes->getNamedItem("class")->nodeValue==$class){
                return $node;
            }
        }
    }
   aaaa
    protected function catchildadd($item,$id,$pid){
        $opt=$this->opt;
        $pclass=sprintf('%s %s_%d',$opt['p_class'],$opt['i_class'],$pid);
        $iclass=sprintf('%s %s_%d',$opt['p_class'],$opt['i_class'],$id);
        $pnode=$this->query('dt',$pclass);
        $itemfn=$opt['item_fn'];
        if($pnode){
            //如果已经有子节点
            if( $pnode->nextSibling && $pnode->nextSibling->nodeName=='dd'){

                $dl=$pnode->nextSibling->firstChild;
                $dt=$this->result->createElement('dt',$itemfn($item));
                $dt->setAttribute('class',$iclass);
                $dl->appendChild($dt);
            }else{
                //没有节点？ dd>dl>dt
                $dt=$this->result->createElement('dt',$itemfn($item));
                $dt->setAttribute('class',$iclass);
                $dl=$this->result->createElement('dl');
                $dl->appendChild($dt);

                $dd=$this->result->createElement('dd');
                $dd->appendChild($dl);
                $dd->setAttribute('class',$opt['c_class']);


                $pnode->parentNode->insertBefore($dd, $pnode->nextSibling);
            }

        }



    }

}
