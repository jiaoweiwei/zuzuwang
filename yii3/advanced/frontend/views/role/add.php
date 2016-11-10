<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">添加角色</a>
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
                    添加角色
                </small>
            </h1>
        </div>
        <!-- /.page-header -->

        <!-- 添加HTML -->
        <center>
            <table>
                <form action="?r=role/add" method="post" >
                    <tr>
                        <td>角色名称：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">*</span>
                            <input type="text" class="form-control" value="" name="role_name">
                        </td>
                    </tr>
                    <tr class="success">
                        <td>角色描述：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">*</span>
<!--                            <textarea name="role_desc"    cols="0" rows="10">--><?php //echo $roleInfo['role_desc']?><!--</textarea>-->
                            <input type="text" class="form-control" value="" name="role_desc">
                        </td>
                    </tr>
                    <tr class="success">
                        <td>角色状态：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">*</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio"  name="role_start" value="0" id="yes" checked="checked"/><label for="yes">启用</label>
                                <input type="radio" name="role_start" value="1" id="no"/><label for="yes">不启用</label>
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