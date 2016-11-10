<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">修改房屋</a>
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
                    修改
                </small>
            </h1>
        </div>
        <!-- /.page-header -->

        <!-- 添加HTML -->
        <center>
            <table>
                <form action="?r=house/upda" method="post" enctype="multipart/form-data">
                    <tr>
                        <td>房屋名称：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" value="<?php echo $houseInfo['house_name']?>" name="house_name">
                        </td>
                    </tr>
                    <tr class="success">
                        <td>房屋数量：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" value="<?php echo $houseInfo['house_count']?>" name="house_count">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋价格：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" value="<?php echo $houseInfo['market_parice']?>" name="market_parice">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋面积：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" value="<?php echo $houseInfo['area']?>" name="area">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋分类：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <?php foreach($cart_list as $v){;?>
                                    <input type="checkbox" name="cart_name[]" <?php if($v['check']=='check'){;?> checked="checked" <?php } ;?> value="<?php echo $v['cart_name']  ;?>"/><?php echo $v['cart_name']  ;?>
                            <?php  };?>

                        </td>
                    </tr>
                    <tr>
                        <td>房屋图片：</td>
                        <td>
                            <img src="<?php echo $houseInfo['house_img']?>" with="50" height="40"/>
                            <input type="file" name="house_img">
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>房屋缩略图：</td>
                        <td><input type="file" name="house_thumb"></td>
                    </tr> -->
                    <tr>
                        <td>房屋排序：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" value="<?php echo $houseInfo['house_sort']?>" name="house_sort" value ="99">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋地址：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" value="<?php echo $houseInfo['site']?>" name="site">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋描述</td>
                        <td>
                            <textarea name="house_desc" cols="30" rows="10"><?php echo $houseInfo['house_desc']?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" id="_csrf" name="<?php echo yii::$app->request->csrfParam;?>" value="<?php echo yii::$app->request->csrfToken?>"/>
                            <input type="hidden" name="house_id" value="<?php echo $houseInfo['house_id']?>">
                        </td>
                        <td><input type="submit" value="submit"></td>
                    </tr>
                </form>
            </table>
        </center>
    </div><!-- /.page-content -->
</div><!-- /.main-content -->