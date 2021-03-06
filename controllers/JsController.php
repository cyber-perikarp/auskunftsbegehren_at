<?php

namespace app\controllers;


use app\components\JsAction;
use app\components\View;

/**
 * Controller renders JS via storage sent from View component.
 */
class JsController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'ready' => [
                'class' => JsAction::class,
                'storageKey' => View::STORAGE_JS_READY,
                'template' => "jQuery(document).ready(function () {\n{js}\n});"
            ],
            'load' => [
                'class' => JsAction::class,
                'storageKey' => View::STORAGE_JS_LOAD,
                'template' => "jQuery(window).load(function () {\n{js}\n});"
            ],
            'ajax' => [
                'class' => JsAction::class,
                'storageKey' => View::STORAGE_JS_AJAX
            ],
            'begin' => [
                'class' => JsAction::class,
                'storageKey' => View::STORAGE_JS_BEGIN
            ],
            'end' => [
                'class' => JsAction::class,
                'storageKey' => View::STORAGE_JS_END
            ],
            'head' => [
                'class' => JsAction::class,
                'storageKey' => View::STORAGE_JS_HEAD
            ],
        ];
    }
}