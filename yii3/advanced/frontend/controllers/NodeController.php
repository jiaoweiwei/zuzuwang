<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use yii\data\Pagination;
class NodeController extends CommonController{
    public $layout = 'admin';

    public function actionShow(){
        $query = new Query();
        //查询出所有的数据
        $nodeList = $query->from('node')->all();
        $nodeLists=$this->sort_a($nodeList);
        return $this->render('show', ['data' => $nodeLists]);
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
    /**
     * 删除
     * @return [type] [description]
     */
    public function actionDel()
    {
        $db = Yii::$app->db;
        $id = Yii::$app->request->get('node_id');
        $sql="select * from node where parent_id = $id";
        $data = Yii::$app->db->createCommand("$sql")->queryAll();
        if($data){
            echo "<script>alert('该目录下有子类不能删除');location.href='?r=node/show';</script>";die;
        }
        $res=Yii::$app->db->createCommand()->delete('node', "node_id = $id")->execute();
        if($res)
        {
            echo "<script>alert('删除成功');location.href='index.php?r=node/show'</script>";
        }else{
            echo "<script>alert('删除失败');location.href='index.php?r=node/show'</script>";
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
            $node_title=$request->post('node_title');
            $controller=$request->post('controller');
            $action=$request->post('action');
            $parent_id=$request->post('parent_id');
            $node_id=$request->post('node_id');
            $res=Yii::$app->db->createCommand()->update('node', ['node_title' => $node_title,'controller'=>$controller,'action'=>$action,'parent_id'=>$parent_id], "node_id = $node_id")->execute();
            if($res){
                echo "<script>alert('修改成功');location.href='index.php?r=node/show'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='index.php?r=node/show'</script>";
            }
        }
        if($request->get('node_id')){
            $query = new Query();
            //查询出所有的数据
            $nodeList = $query->from('node')->all();
            $nodeLists=$this->sort_a($nodeList);
            $id=$request->get('node_id');
//            echo $id;exit;
            $data = Yii::$app->db->createCommand("SELECT * FROM node WHERE node_id=$id")->queryOne();
//            print_R($data);exit;
            return $this->render('upda', ['nodeInfo' => $data,'nodelist'=>$nodeLists]);
        }
    }

    public function actionAdd(){
        $query = new Query();
        //查询出所有的数据
        $nodeList = $query->from('node')->all();
//        print_R($nodeList);exit;
        $nodeLists=$this->sort_a($nodeList);
        $request = YII::$app->request;
        if($request->isPost){
//            print_r( $request->post());exit;
            $node_title=$request->post('node_title');
            $controller=$request->post('controller');
            $action=$request->post('action');
            $parent_id=$request->post('parent_id');
            $res=Yii::$app->db->createCommand()->insert('node', ['node_title' => $node_title,'controller'=>$controller,'action'=>$action,'parent_id'=>$parent_id])->execute();
            if($res){
                echo "<script>alert('添加成功');location.href='index.php?r=node/show'</script>";
            }else{
                echo "<script>alert('添加失败');location.href='index.php?r=node/show'</script>";
            }
        }else{
            return $this->render('add',['nodelist'=>$nodeLists]);
        }

    }
}