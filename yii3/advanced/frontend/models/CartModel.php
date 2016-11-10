<?php 
namespace frontend\models;
// use Yii;
// use ActiveRecord;
// use yii\base\Model;
// use yii\db\Query;
class CartModel extends \yii\db\ActiveRecord 
{

      public static function tablename()
      {
      	return 'cart';
      }
//查询分类数据
      // public function show(){   
      //      $query = new Query();
      //      return $query->from("cart")->all();

      // }
//添加分类数据
      public function add($data){
        $this->setAttributes($data,false);  
        $this->isNewRecord = true; 
        return $this->save();
        // $this->id;
        // return Yii::$app->db->createCommand()->insert('cart',$data)->execute();
      }
//软删除分类数据
      public function updele($id){
        // return Yii::$app->db->createCommand()->delete('cart','cart_id='.$id)->execute();
        // $user = $this->find()->where(['cart_id'=>$id])->one();
        // return $user->delete();
        $user = $this->find()->where(['cart_id'=>$id])->one(); //获取name等于test的模型
        $user->is_delete = 1; //修改age属性值
        return $user->save();         
      } 
//单条分类查询
      public function upda($id){
      	// $data = Yii::$app->db->createCommand("SELECT * FROM cart WHERE cart_id = $id")->queryOne(); 
      	// return $data;
       return $this->find()->where("cart_id=$id")->one(); 
      }
//修改
      public function upl($data,$cart_id){
         // return Yii::$app->db->createCommand()->update('cart',$data,"cart_id=$cart_id")->execute();
         return $this->updateAll($data,['cart_id'=>"$cart_id"]);
      }
//批量删除
      public function Upbatch($dataid){
         $list = explode(",",$dataid);
         return $this->updateAll(["is_delete"=>"0"],['in', 'cart_id',$list]);
      }
}
?>