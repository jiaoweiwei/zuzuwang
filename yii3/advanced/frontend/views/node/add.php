<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">添加节点</a>
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
                权限管理功能
                <small>
                    <i class="icon-double-angle-right"></i>
                    添加节点
                </small>
            </h1>
        </div>
        <!-- /.page-header -->

        <!-- 添加HTML -->
        <center>
            <table>
                <form action="?r=node/add" method="post" >
                    <tr>
                        <td>所属权限</td>
                        <td>
                            <select name="parent_id" id="">
                                <option value="">请选择</option>
                                <option value="0">顶级权限</option>
                                <?php foreach($nodelist as $v){ ;?>
                                  <option value="<?php echo $v['node_id']  ;?>">&nbsp;&nbsp;&nbsp;<?php echo $v['level']  ;?><?php echo $v['node_title']  ;?></option>
                                <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>功能标题：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" value="" name="node_title">
                        </td>
                    </tr>
                    <tr class="success">
                        <td>控制器名：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
<!--                            <textarea name="role_desc"    cols="0" rows="10">--><?php //echo $roleInfo['role_desc']?><!--</textarea>-->
                            <input type="text" class="form-control" value="" name="controller">
                        </td>
                    </tr>
                    <tr class="success">
                        <td>方法名：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" value="" name="action">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td><input type="submit" value="submit"></td>
                    </tr>
                </form>
            </table>
        </center>
    </div><!-- /.page-content -->
</div><!-- /.main-content -->