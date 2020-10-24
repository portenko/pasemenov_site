<?php
namespace app\widgets;

use yii\base\Exception;
use yii\httpclient\Client;
use Yii;

/**
 * Class PageForm
 * @package app\widgets
 */
class PageForm extends \yii\bootstrap\Widget
{
    const METHOD_VIEW = 'v1.data.view';
    const METHOD_UPDATE = 'v1.data.update';
    public $form_name = 'Data';
    public $page_uid;

    /**
     * @return string|void|null
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function run()
    {
        if(!isset($this->page_uid)){
            return;
        }

        $fields = null;
        $jsonRpc = [
           'jsonrpc' => '2.0',
           'method' => self::METHOD_VIEW,
           'id' => uniqid('page_form'),
           'params' => [
               'page_uid' => $this->page_uid,
               'fields' => [
                   //fields
               ]
           ],
        ];

        $request = Yii::$app->request;
        if($request->isPost && ($data = $request->post('Data')) !== null)
        {
            foreach ($data as $key => $value)
            {
                $jsonRpc['params']['fields'][] = [
                    'name' => $key,
                    'value' => $value,
                ];
            }
            $jsonRpc['method'] = self::METHOD_UPDATE;
        }
        else {
            $jsonRpc['method'] = self::METHOD_VIEW;
        }

        try
        {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl([Yii::$app->params['apiUrl'], 'access-token' => Yii::$app->params['apiToken']])
                ->setFormat(Client::FORMAT_JSON)
                ->setData($jsonRpc)
                ->send();

            if ($response->isOk && isset($response->data['result']['fields'])){
                if($jsonRpc['method'] === self::METHOD_UPDATE){
                    Yii::$app->session->setFlash('success', 'Data updated successfully');
                }
                $fields = $response->data['result']['fields'];
            }
        }
        catch (Exception $e){
            Yii::$app->session->setFlash('error', 'An error occurred while processing the request');
        }

        $html = null;
        if($fields)
        {
            foreach($fields as $field)
            {
                $tag = Yii::getAlias('@app/widgets/views/page_form/fields/' . $field['tag'] . '.php');
                if(is_file($tag)){
                    $html .= $this->renderFile($tag, ['field' => $field, 'form_name' => $this->form_name]);
                }
            }
            return $this->render('page_form/form_update', ['content' => $html]);
        }
    }
}
