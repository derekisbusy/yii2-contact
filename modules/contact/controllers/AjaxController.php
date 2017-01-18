<?php


namespace derekisbusy\contact\modules\contact\controllers;


use yii\web\Controller;
use yii\db\Query;

/**
 * Site controller
 */
class AjaxController extends Controller
{
    
    public function actionUsernames($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, username AS text')
                ->from('user')
                ->where(['like', 'username', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => \dektrium\user\models\User::find($id)->username];
        }
        return $out;
    }
}