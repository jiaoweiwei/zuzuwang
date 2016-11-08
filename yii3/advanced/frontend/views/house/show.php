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
                <a href="#">房屋展示</a>
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
                房屋功能
                <small>
                    <i class="icon-double-angle-right"></i>
                    展示
                </small>
            </h1>
        </div><!-- /.page-header -->
		<center>
			<table border="1" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>选择</th>
						<th>ID</th>
						<th>房屋名称</th>
						<th>房屋数量</th>
						<th>房屋价格</th>
						<th>房屋图片</th>
						<th>房屋排序</th>
						<th>房屋地址</th>
						<th>房屋描述</th>
						<th>是否显示</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $key=>$val){?>
						<tr id="<?php echo $val['house_id']?>">
							<td>  
                                <input type='checkbox' name='id[]' value='<?php echo $val['house_id']?>' />  
                            </td>
							<td>
								<?php echo $val['house_id']?>
							</td>
							<td>
								<?php echo $val['house_name']?>
							</td>
							<td>
								<?php echo $val['house_count']?>
							</td>
							<td>
								<?php echo $val['market_parice']?>
							</td>
							<td>
								<img src="<?php echo $val['house_img']?>" with="50px" height="40px"/>
							</td>
							<td>
								<span class="sort"><?php echo $val['house_sort']?></span>
							</td>
							<td>
								<?php echo $val['site']?>
							</td>
							<td>
								<?php echo $val['house_desc']?>
							</td>
							<td>
								<?php if($val['in_sale'] == 0):?>
									<span class="in_sale">显示</span>
								<?php else:?> 
									<span class="in_sale">不显示</span>
								<?php endif; ?>		
							</td>
							<td>
								<button class="btn btn-xs btn-info" onclick="javascript:window.location.href='?r=house/upda&house_id=<?php echo $val['house_id']?>'">
									<i class="icon-edit bigger-120"></i>
								</button>
								<button class="btn btn-xs btn-danger">
									<i class="icon-trash bigger-120"></i>
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
							?><br/>
							<button id="complete">全选</button>
							<button id="rebellion">反选</button>
							<button id="nope">全不选</button>
							<button id="delAll">批量删除</button>
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
