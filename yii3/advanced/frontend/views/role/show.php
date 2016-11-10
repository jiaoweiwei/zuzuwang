<?php
use yii\widgets\LinkPager;
?>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">角色列表</a>
            </li>
            <li class="active">控制台</li>
        </ul><!-- .breadcrumb -->

        <div class="nav-search" id="nav-search">
            <form class="form-search">
                        <span class="input-icon">
                            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                            <i class="icon-search nav-search-icon"></i>
                        </span>
            </form>
        </div><!-- #nav-search -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                权利管理功能
                <small>
                    <i class="icon-double-angle-right"></i>
                    角色列表
                </small>
            </h1>
        </div><!-- /.page-header -->
        <center>
            <table border="1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>角色名称</th>
                    <th>角色描述</th>
                    <th>添加时间</th>
                    <th>角色状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $key=>$val){?>
                    <tr id="<?php echo $val['role_id']?>">
                        <td>
                            <?php echo $val['role_id']?>
                        </td>
                        <td>
                            <?php echo $val['role_name']?>
                        </td>
                        <td>
                            <?php echo $val['role_desc']?>
                        </td>
                        <td>
                            <?php echo $val['role_time']?>
                        </td>

                        <td>
                            <?php if($val['role_start']==0){;?>
                                启用
                            <?php  }else{ ?>
                                不启用
                            <?php  }?>
                        </td>
                        <td>

                            <button class="btn btn-xs btn-info" onclick="javascript:window.location.href='?r=role/upda&role_id=<?php echo $val['role_id']?>'">
                                <i class="icon-edit bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-danger"  onclick="javascript:window.location.href='?r=role/del&role_id=<?php echo $val['role_id']?>'">
                                <i class="icon-trash bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-warning"  onclick="javascript:window.location.href='?r=role/authority&role_id=<?php echo $val['role_id']?>'">
                                <i class="icon-flag bigger-120"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="11" align="center">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $pagination,
                            'firstPageLabel' => '首页',
                            'lastPageLabel' => '末页',
                            'prevPageLabel' => '上一页',
                            'nextPageLabel' => '下一页',
                        ]);
//                        ?><!--<br/>-->
<!--                        <button id="complete" class="btn btn-default btn-sm">全选</button>-->
<!--                        <button id="rebellion" class="btn btn-default btn-sm">反选</button>-->
<!--                        <button id="nope" class="btn btn-default btn-sm">全不选</button>-->
<!--                        <button id="delAll" class="btn btn-default btn-sm">批量删除</button>-->
                    </td>
                </tr>
                </tbody>
            </table>
        </center>
    </div><!-- /.page-content -->
</div><!-- /.main-content -->
</script>
