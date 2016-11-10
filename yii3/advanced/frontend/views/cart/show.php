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
								<a href="#">控制台</a>
							</li>

							<li>
								<a href="#">分类管理</a>
							</li>
							<li class="active">分类显示</li>
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
							  分类管理
								<small>
									<i class="icon-double-angle-right"></i>
								分类显示
								</small>
							</h1>
						</div><!-- /.page-header -->


						<div class="page-header">
	                      <a href="?r=cart/add">添加分类</a>
						</div>


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-xs-12">
										<div class="table-responsive">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">
															<label>																
																<input type="checkbox" class="ace" id="ace" />
																<span class="lbl"></span>
															 </label>
															 <label>   
															    <a href="javascript:void(0)"id="batch">批删</a>
															</label>
														</th>
														<th  class="center">分类名称</th>
														<th  class="center">是否展示</th>
														<th  class="center">操作</th>
													</tr>
												</thead>

												<tbody>
									<?php foreach ($data as $key => $value) { ?> 
												    <tr class="center" trid = "<?php echo $value['cart_id']; ?>">
												        <td><input type="checkbox" class="list" name="box[]"></td>
														<td class="center">
														<?php echo $value['cart_name']; ?>
														</td>
														<td>
															<?php if($value['is_show']=="0"){
																        echo  "不展示";
															          }else{
																        echo "展示";
																      } 
														     ?>
														</td>
														<td >
															<div class="center" class="visible-md visible-lg hidden-sm hidden-xs btn-group">
<!--												                <a href="" class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a>-->
																<a href="?r=cart/upda&id=<?php echo base64_encode($value['cart_id']); ?>" class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
															    <a href="?r=cart/dele&id=<?php echo base64_encode($value['cart_id']); ?>" class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></a>
<!--																<a href="" class="btn btn-xs btn-warning"><i class="icon-flag bigger-120"></i></a>-->
															</div>
														</td>
													</tr>										
								     <?php } ?>
								         <tr>
									         <td colspan="5" class="center">
									         	<?php echo LinkPager::widget([
	                                              'pagination' => $pages,
	                                              ]); ?>
	                                         </td>
								         </tr>
											 </tbody>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
                    <script src="assets/js/jquery1.8.3.js"></script>
<script type="text/javascript">
$(function(){
//全选全不选
     $("#ace").click(function(){
       if ($(this).prop('checked')) {
			$(".list").attr('checked',true);
       }else{
       	    $(".list").attr('checked',false);
       }
     });
//批量删除
     $("#batch").click(function(){
        var list = $('input[name="box[]"]');
        var arrid = "";
	  	  $.each(list,function(i,n){
	  	  	if (n.checked==true) { 
	           arrid = arrid +','+$(this).parent().parent().attr('trid');	  		
	  	  	}
	      });
	      var arrid = arrid.substr(1);
        $.get("?r=cart/batch",{"arrid":arrid},function(data){
            if (data!=0) {
               window.location.reload();
            }
         });
     })
})
</script>
