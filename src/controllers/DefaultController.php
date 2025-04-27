<?php

namespace gotivac\chat\controllers;

use Yii;
use yii\web\Controller;
use gotivac\chat\models\ChatModel;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @param null $thread
     * @return string
     */
    public function actionIndex($thread = null)
    {

        $this->layout = 'chat';
        $className = Yii::$app->getUser()->identityClass;
        $model = new $className;
        $user=$model->find()->where(['id'=>Yii::$app->user->id])->one();

        $messages = ChatModel::getMessages($this->module->numberLastMessages,$thread);

        return $this->render('index',compact('user','messages','thread'));
    }

    public function actionSendMessage($thread=null)
    {
        if (Yii::$app->user->isGuest)
            return Yii::t('app','Registered can chat only');

        $post = Yii::$app->request->post();


        if ($post['sendMessage']=='true')
        {
            $model = new ChatModel();
            if ($model->load(Yii::$app->request->post()) and $model->validate())
            {
                $model->time = time();
                $model->rfc822 = date(DATE_RFC822,$model->time);
                $model->save();
            }
        }

        $messages = ChatModel::getMessages($this->module->numberLastMessages,$thread);

        return $this->renderPartial('_msgbox',compact('messages'));
    }
}
