<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">角色授权</a>
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
                    角色授权
                </small>
            </h1>
        </div>
        <!-- /.page-header -->

        <!-- 添加HTML -->
        <center>
            <table>
                <form action="?r=users/authority" method="post" >
                    <tr>
                        <td>角色：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <?php
                            foreach($roleList as $v){;?>
                                <input type="checkbox" name="role_id[]" value="<?php echo $v['role_id']  ;?>"<?php if($v['check']=='check'){ ?>checked="checked" <?php } ;?>/><?php echo $v['role_name']  ;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php  };?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="user_id" value="<?php echo $user_id ;?>"/>
                        </td>
                        <td><input type="submit" value="submit"></td>
                    </tr>
                </form>
            </table>
        </center>
    </div><!-- /.page-content -->
</div><!-- /.main-content -->