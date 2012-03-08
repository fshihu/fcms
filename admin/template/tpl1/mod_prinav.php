<div class="prinavw">

    <ul class="prinav">
        <li class="prinavli">

            <h2><strong>设置</strong>  </h2>
            <ul>
                <li><span>表设置</span><a href="edittable.php?act=add">添加表</a> </li>
                <li>

                    <ul>

                        <?php
                         foreach ($table->query() as $v) {
                            ?>
                            <li>

                                <a href="editfiled.php?tid=<?php echo $v['id'];?>" title="<?php echo $v['table_desc'];?>">
                                    <?php echo $v['table_desc'] ?>
                                </a>
                                <a href="edittable.php?act=del&tid=<?php echo $v['id']?>">删除</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <li><a href="">附带发布设置</a></li>
                <li><a href="">附件设置</a></li>
            </ul>
            <h2><strong>导航</strong> <span><a href="editmanage.php?act=add">新建根目录</a></span></h2>
            <?php
            $manage = new Manage();
            $managarr=$manage->query();
            $navcat = new Catalog(array('id' => 'id', 'pid' => 'parent_catalog',
                'item_fn'=>function($item){
                    return sprintf('<a href="editmanage.php?act=alt&amp;pid=%d">%s</a>'.
                                   '<a href="editmanage.php?act=add&amp;pid=%d">建立子目录</a>'.
                                   '<a href="editmanage.php?act=del&amp;pid=%d">删除</a>',
                        $item['id'],$item['cat_name'],$item['id'],$item['id']);
                }));
            echo  $navcat->get($managarr);
            ?>
            <h2><strong>发布</strong></h2>
            <?php
            $navcat->setparm(array('item_fn'=>function($item){return sprintf('<a href="editpublish.php?cid=%s">%s</a>',
                $item["id"],$item["cat_name"]);}));
            echo  $navcat->get($managarr);
            ?>
        </li>
    </ul>
</div>