<?php
namespace frontend\controllers;
use Yii;
use yii\web\controller;
use frontend\models\CartModel;
use yii\db\Query;
use yii\base\Model;
use yii\data\Pagination;//分页调用
use yii\web\AssetBundle; 
class CartController extends CommonController{

	public $layout = "admin";
//分类展示页
    public  function  actionShow(){
           $query = new Query();
           $list = $query->from("cart")->where("is_delete=0")->all();
            // var_dump($list);die;
            $pages = new Pagination([  
            'totalCount' =>count($list),
            'pageSize' =>3,//pageSize 每页显示的条数  
            ]);   
            $data = $query->offset($pages->offset)->limit($pages->limit)->all();
//        print_r($data);exit;
            return $this->render('show',['data'=>$data,'pages' => $pages,]);  
    }

//分类添加
    public function actionAdd(){
    	$post = Yii::$app->request->post();
        if ($post) {
            $model = new CartModel();
            $res = $model->add($post);      
	        if ($res==1){
	           return $this->redirect(['cart/show']);     	
	        }else{
	           return $this->redirect(['cart/add']);
	        }
        }else{
        	return $this->render('add');
        }

    }  

//分类删除
    public function actionDele(){
    	$id=base64_decode(Yii::$app->request->get('id'));
//        echo $id;exit;
        $model = new CartModel();
        $set = $model->updele($id);
        if ($set==1) {
           return $this->redirect(['cart/show']);
        }else{
           return $this->redirect(['cart/show']);
        }
    }
//分类批删
    public function actionBatch(){
        $dataid = Yii::$app->request->get('arrid');
        $model = new CartModel();
        $set = $model->Upbatch($dataid);
        return $set;
    }
//分类修改
    public function actionUpda(){
        $post = Yii::$app->request->post();
    	if ($post) {
    	   $cart_id = $post['cart_id'];
      	   unset($post['cart_id']);
           $model = new CartModel();
           $set = $model->upl($post,$cart_id);
          if ($set==1) {
             return $this->redirect(['cart/show']);
          }else{
          	return $this->redirect(['cart/show']);
          } 		
    	}else{
    		$id = base64_decode(Yii::$app->request->get("id"));
	        $model = new CartModel();
	        $data = $model->upda($id);
	        // var_dump($data);die;
	        return $this->render("upda",['data'=>$data]);   		
    	}

    }
}
?>