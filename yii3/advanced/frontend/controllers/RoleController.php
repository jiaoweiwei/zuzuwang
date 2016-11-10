<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use yii\data\Pagination;
class RoleController extends CommonController{
    public $layout = 'admin';

    public function actionShow(){
        $query = new Query();
        //查询出所有的数据
        $userList = $query->from('role')->where(['is_delete'=>0])->all();
        //统计数据个数
        $count = count($userList);
        //实例化分页类
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->setPageSize(2 );
        $data = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('show', ['data' => $data, 'pagination' => $pagination,]);
    }
    /**
     * 删除
     * @return [type] [description]
     */
    public function actionDel()
    {
        $db = Yii::$app->db;
        $id = Yii::$app->request->get('role_id');
//      echo $id;exit;
        $res = $db->createCommand()->update('role',['is_delete'=>1],['role_id'=>$id])->execute();
        if($res)
        {
            echo "<script>alert('删除成功');location.href='index.php?r=role/show'</script>";
        }else{
            echo "<script>alert('删除失败');location.href='index.php?r=role/show'</script>";
        }
    }

    /**
     * 修改数据
     * @return [type] [description]
     */
    public function actionUpda()
    {
        $request = YII::$app->request;
        if($request->isPost){
//            print_r( $request->post());exit;
            $role_name=$request->post('role_name');
            $role_desc=$request->post('role_desc');
            $role_start=$request->post('role_start');
            $role_id=$request->post('role_id');
            $res=Yii::$app->db->createCommand()->update('role', ['role_name' => $role_name,'role_desc'=>$role_desc,'role_start'=>$role_start], "role_id = $role_id")->execute();
            if($res){
                echo "<script>alert('修改成功');location.href='index.php?r=role/show'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='index.php?r=role/show'</script>";
            }
        }
        if($request->get('role_id')){
            $id=$request->get('role_id');
//            echo $id;
            $data = Yii::$app->db->createCommand("SELECT * FROM role WHERE role_id=$id")->queryOne();
            return $this->render('upda', ['roleInfo' => $data]);
        }
    }

    public function actionAdd(){
        $request = YII::$app->request;
        if($request->isPost){
//            print_r( $request->post());exit;
            $role_name=$request->post('role_name');
            $role_desc=$request->post('role_desc');
            $role_start=$request->post('role_start');
            $role_time=date("Y-m-d H:i:s",time());
            $res=Yii::$app->db->createCommand()->insert('role', ['role_name' => $role_name,'role_desc'=>$role_desc,'role_start'=>$role_start,'role_time'=>$role_time])->execute();
            if($res){
                echo "<script>alert('添加成功');location.href='index.php?r=role/show'</script>";
            }else{
                echo "<script>alert('添加失败');location.href='index.php?r=role/show'</script>";
            }
        }else{
            return $this->render('add');
        }

    }


    public function actionAuthority(){
        $request = YII::$app->request;
        if($request->isPost){
            $request->post();
//            print_r($request->post());exit;
            $node_ids= $request->post('node_id');
            $role_id= $request->post('role_id');

            //查询派生表中数据
            $sql="select * from role_node where role_id=$role_id";
            $role_node=Yii::$app->db->createCommand($sql)->queryAll();

            if($role_node){
                //删除派生表中原有数据
                $re=Yii::$app->db->createCommand()->delete('role_node', "role_id = $role_id")->execute();
                //判断是否接到值
                if($node_ids){
                    foreach($node_ids as $v){
                        $res=Yii::$app->db->createCommand()->insert('role_node', ['role_id' => $role_id,'node_id'=>$v])->execute();
                    }
                    if($res){
                        echo "<script>alert('节点赋权成功');location.href='index.php?r=role/show'</script>";die;
                    }else{
                        echo "<script>alert('节点赋权失败');location.href='index.php?r=role/show'</script>";die;
                    }
                }else{
                    echo "<script>alert('清除所有节点');location.href='index.php?r=role/show'</script>";die;
                }
            }else{
                if($node_ids){
                    foreach($node_ids as $v){
                        $res=Yii::$app->db->createCommand()->insert('role_node', ['role_id' => $role_id,'node_id'=>$v])->execute();
                    }
                    if($res){
                        echo "<script>alert('节点赋权成功');location.href='index.php?r=role/show'</script>";die;
                    }else{
                        echo "<script>alert('节点赋权失败');location.href='index.php?r=role/show'</script>";die;
                    }
                }else{
                    echo "<script>alert('清除所有节点');location.href='index.php?r=role/show'</script>";die;
                }
            }

        }
        if($request->isGet){
            $id = Yii::$app->request->get('role_id');
            //查询出所有节点
            $query = new Query();
            //查询出所有的数据
            $nodeList = $query->from('node')->all();
            $nodeLists=$this->sort_a($nodeList);
            //查询出派生表中角色所定义的节点id
            $role_node= Yii::$app->db->createCommand("SELECT * FROM role_node where role_id=$id")->queryAll();
            //循环两个数组将角色对应的节点增加选中字段
            $arr=array();
            foreach($role_node as $v){
                $arr[]=$v['node_id'];
            }
//            print_r($nodeLists);exit;
            foreach($nodeLists as $k=>$val){
                if(in_array($val['node_id'],$arr)){
                    $nodeLists[$k]['check']="check";
                }else{
                    $nodeLists[$k]['check']="false";
                }
            }
//            print_r($nodeLists);exit;
//            echo $id;exit;
//            print_r($nodeLists);exit;
            return $this->render('authority',['nodeLists'=>$nodeLists,'role_id'=>$id]);
        }
    }
    /** 递归
     * @param 列表数据
     * @param int 父类id
     * @param int 间隔
     * @return array
     */
    public function sort_a($res,$sid=0,$level=0){
        static $arr=array();
        foreach($res as $key=>$val){
            if($val['parent_id']==$sid){
                $val['level']=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$level);
                $arr[]=$val;
                $this->sort_a($res,$val['node_id'],$level+1);
            }
        }
        return $arr;
    }
}