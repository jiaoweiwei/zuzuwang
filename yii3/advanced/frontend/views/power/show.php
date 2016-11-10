<div class="main-content">
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
                <th>用户名称</th>
                <th>权限名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php /*foreach($data as $key=>$val){*/?><!--
                <tr id="<?php /*echo $val['house_id']*/?>">
                    <td>
                        <input type='checkbox' name='id[]' value='<?php /*echo $val['house_id']*/?>' />
                    </td>
                    <td>
                        <?php /*echo $val['house_id']*/?>
                    </td>
                    <td>
                        <?php /*echo $val['house_name']*/?>
                    </td>
                    <td>
                        <?php /*echo $val['house_count']*/?>
                    </td>
                    <td>
                        <?php /*echo $val['market_parice']*/?>
                    </td>
                    <td>
                        <img src="<?php /*echo $val['house_img']*/?>" with="50px" height="40px"/>
                    </td>
                    <td>
                        <span class="sort"><?php /*echo $val['house_sort']*/?></span>
                    </td>
                    <td>
                        <?php /*echo $val['site']*/?>
                    </td>
                    <td>
                        <?php /*echo $val['house_desc']*/?>
                    </td>
                    <td>
                        <?php /*if($val['in_sale'] == 0):*/?>
                            <span class="in_sale">显示</span>
                        <?php /*else:*/?>
                            <span class="in_sale">不显示</span>
                        <?php /*endif; */?>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-info" onclick="javascript:window.location.href='?r=house/upda&house_id=<?php /*echo $val['house_id']*/?>'">
                            <i class="icon-edit bigger-120"></i>
                        </button>
                        <button class="btn btn-xs btn-danger">
                            <i class="icon-trash bigger-120"></i>
                        </button>
                    </td>
                </tr>
            <?php /*} */?>
            <tr>-->
                <td colspan="11" align="center">
                    <button id="complete" class="btn btn-default btn-sm">全选</button>
                    <button id="rebellion" class="btn btn-default btn-sm">反选</button>
                    <button id="nope" class="btn btn-default btn-sm">全不选</button>
                    <button id="delAll" class="btn btn-default btn-sm">批量删除</button>
                </td>
            </tr>
            </tbody>
        </table>
    </center>
</div>
    </div><!-- /.page-content -->