<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">添加房屋</a>
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
                    添加
                </small>
            </h1>
        </div><!-- /.page-header -->

        <!-- 添加HTML -->
        <center>
            <table>
                <form action="?r=house/index" method="post" enctype="multipart/form-data">
                    <tr>
                        <td>房屋名称：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" name="house_name">
                        </td>
                    </tr>
                    <tr class="success">
                        <td>房屋数量：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" name="house_count">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋价格：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" name="market_parice">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋图片：</td>
                        <td>
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
                            <input type="text" class="form-control" name="house_sort" value ="99">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋地址：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" name="site">
                        </td>
                    </tr>
                    <tr>
                        <td>房屋描述</td>
                        <td>
                            <textarea name="house_desc" cols="30" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" id="_csrf" name="<?php echo yii::$app->request->csrfParam;?>" value="<?php echo yii::$app->request->csrfToken?>"/>
                        </td>
                        <td><input type="submit" value="submit"></td>
                    </tr>
                </form>
            </table>
        </center>
    </div><!-- /.page-content -->
</div><!-- /.main-content -->