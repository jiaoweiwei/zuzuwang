<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">节点授权</a>
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
                    节点授权
                </small>
            </h1>
        </div>
        <!-- /.page-header -->

        <!-- 添加HTML -->
        <center>
            <table>
                <form action="?r=role/authority" method="post" >
                    <tr>
                        <td>节点：</td>
                        <td class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <?php
                            foreach($nodeLists as $v){;?>
                                <input type="checkbox" class="node" name="node_id[]" id="<?php echo $v['node_id']  ;?>" parent_id="<?php echo $v['parent_id'] ;?>" value="<?php echo $v['node_id']  ;?>"<?php if($v['check']=='check'){ ?>checked="checked" <?php } ;?>/><?php echo $v['node_title']  ;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php  };?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="role_id" value="<?php echo $role_id ;?>"/>
                        </td>
                        <td><input type="submit" value="submit"></td>
                    </tr>
                </form>
            </table>
        </center>
    </div><!-- /.page-content -->
</div><!-- /.main-content -->
<script src="assets/js/jquery1.8.3.js"></script>
<script>
   $(function(){
       //上、下级选中
      $(".node").click(
          function(){
          var _this=$(this).val();
          var _parent=$(this).attr("parent_id")
              if(this.checked){
                  $(".node").each(function(){
                      if($(this).attr("parent_id")==_this){
                          $(this).prop("checked",true)
                      }
                      if(_parent==$(this).val()){
                          $(this).prop("checked",true)
                      }
                  })
              }else {
                  $(".node").each(function () {
                      if ($(this).attr("parent_id") == _this) {
                          $(this).prop("checked", false)
                      }
                      if (_parent == $(this).val()) {
                          $(this).prop("checked", false)
                      }
                  })
              }
      }
      )

   })
</script>