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
                <a href="#">节点列表</a>
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
                    节点列表
                </small>
            </h1>
        </div><!-- /.page-header -->
        <center>
            <table border="1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>功能标题</th>
                    <th>控制器</th>
                    <th>方法</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $key=>$val){?>
                    <tr id="<?php echo $val['node_id']?>">
                        <td>
                            <?php echo $val['node_id']?>
                        </td>
                        <td>
                           <?php echo $val['level'] ;?><?php echo $val['node_title']?>
                        </td>
                        <td>
                            <?php echo $val['controller']?>
                        </td>
                        <td>
                            <?php echo $val['action']?>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-info" onclick="javascript:window.location.href='?r=node/upda&node_id=<?php echo $val['node_id']?>'">
                                <i class="icon-edit bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-danger"  onclick="javascript:window.location.href='?r=node/del&node_id=<?php echo $val['node_id']?>'">
                                <i class="icon-trash bigger-120"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="11" align="center">
<!--                        <!--<!--<br/>-->
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
<script src="assets/js/jquery1.8.3.js"></script>
<script type="text/javascript">
    $(function(){
        //全选
        $('#complete').click(function(){
            $("input[name='id[]']").each(function()
            {
                this.checked = true;
            });
        });
        //反选
        $('#rebellion').click(function(){
            $("input[name='id[]']").each(function()
            {
                if (this.checked == true)
                {
                    this.checked = false;
                }
                else
                {
                    this.checked = true;
                }
            })
        });
        //全不选
        $('#nope').click(function(){
            $("input[name='id[]']").each(function()
            {
                this.checked = false;
            });
        });

        //批量删除
        $('#delAll').click(function()
        {
            var ids = "";
            var url = "?r=house/delall";
            $("input[name='id[]']").each(function()
            {
                if (this.checked == true)
                {
                    ids += $(this).val() + ",";
                }
            });
            $.get(url,{"id":ids},function(msg)
            {
                if(msg == 1)
                {
                    $("input[name='id[]']").each(function()
                    {
                        if(this.checked == true)
                        {
                            $(this).parents('tr').remove();

                        }
                    });
                    window.location.reload();
                    // alert('删除成功');
                }
                else
                {
                    alert('删除失败');
                }
            });
        });

        //即点即改
        $(document).on('click','.sort',function(){
            var _this = $(this);
            var sort = $(this).html();
            _this.parent('td').html('<input type="text" name="house_sort" value="'+sort+'"/>');
        });

        $(document).on('blur','input[name="house_sort"]',function(){
            var _this = $(this);
            var house_sort = _this.val();
            var id = _this.parents('tr').attr('id');
            var url = "?r=house/upsale";
            $.get(url,{'house_id':id,'house_sort':house_sort},function(msg){
                if(msg)
                {
                    _this.parent('td').html('<span class="sort">'+house_sort+'</span>');
                }
                else
                {
                    alert('修改失败');
                }
            })
        })


        //修改状态
        $(document).on('click','.in_sale',function(){
            var _this = $(this);
            var in_sale = _this.html();
            var id = _this.parents('tr').attr('id');
            var url = "?r=house/upsale";
            if(in_sale == '显示')
            {
                var in_sale = 1;
            }
            else
            {
                var in_sale = 0;
            }

            $.get(url,{'house_id':id,'in_sale':in_sale},function(msg){
                if(msg)
                {
                    if(in_sale == 0)
                    {
                        _this.html('显示');
                    }
                    else
                    {
                        _this.html('不显示');
                    }
                }
                else
                {
                    alert('修改失败');
                }
            });
        });


        //删除
        $('.btn-danger').click(function(){
            var _this = $(this);
            var url = "?r=house/del";
            var id = _this.parents('tr').attr('id');
            $.get(url,{'house_id':id},function(msg){
                if(msg)
                {
                    _this.parents('tr').remove();
                    window.location.reload();
                }
                else
                {
                    alert('删除失败');
                }
            });
        });
    });

</script>
