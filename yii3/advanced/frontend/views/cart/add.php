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
							<li class="active">分类添加</li>
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
								分类添加
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form action="?r=cart/add" class="form-horizontal" method="post" >
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">分类名称:</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="cart_name" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">是否展示:</label>

										<div class="col-sm-9">
											<input type="radio" name="is_show" value="1" />显示
											<input type="radio" name="is_show" value="0" />不显示
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
												<input class="btn btn-info" type="submit" value="Submit">
											&nbsp; &nbsp; &nbsp;
												<input class="btn" type="reset" type="reset" value="Reset">
										</div>
									</div>

									<div class="hr hr-24"></div>
									</div>
								</form>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->