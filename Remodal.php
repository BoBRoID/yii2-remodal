<?php
namespace bobroid\remodal;
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 06.10.15
 * Time: 13:02
 */

use yii\helpers\Html;

class Remodal extends \yii\base\Widget{

    public $options = [];
    public $buttonOptions = [];
    public $cancelButtonOptions = [];
    public $confirmButtonOptions = [];
    public $content = '';
    public $closeButton = true;
    public $cancelButton = true;
    public $confirmButton = true;
    public $addRandomToID = true;
    public $events = [];

    public $id = 'remodal';

    private $optionsDefault = [
        'hashTracking'          =>  "true",
        'closeOnOutsideClick'   =>  "true",
    ];

    private $buttonOptionsDefault = [
        'label'                 =>  'Open Remodal'
    ];

    private $cancelButtonOptionsDefault = [
        'label'                 =>  'Cancel',
        'data-remodal-action'   =>  'cancel',
        'class'                 =>  'remodal-cancel'
    ];

    private $confirmButtonOptionsDefault = [
        'label'                 =>  'OK',
        'data-remodal-action'   =>  'confirm',
        'class'                 =>  'remodal-confirm'
    ];

    public function init(){
        RemodalAsset::register($this->getView());
        if($this->addRandomToID){
            $this->id = $this->id.rand(0, 200000000);
        }
        $this->options = array_merge($this->options, $this->optionsDefault);
        $this->buttonOptions = array_merge($this->buttonOptions,$this->buttonOptions);
        $this->cancelButtonOptions = array_merge($this->cancelButtonOptions,$this->cancelButtonOptionsDefault);
        $this->confirmButtonOptions = array_merge($this->confirmButtonOptions,$this->confirmButtonOptionsDefault);
    }

    public function renderModal($content = '', $options = []){
        if(!empty($options)){
            $this->options = array_merge($this->options, $options);
        }

        if(!empty($content)){
            $this->content = $content;
        }

        $modalData = '';

        if($this->closeButton){
            $modalData .= Html::tag('button', '', [
                'data-remodal-action'   =>  'close',
                'class'                 =>  'remodal-close',
            ]);
        }

        $modalData .= $this->content;

        if($this->cancelButton){
            $modalData .= Html::tag('button', $this->cancelButtonOptions['label'], $this->cancelButtonOptions);
        }

        if($this->confirmButton){
            $modalData .= Html::tag('button', $this->confirmButtonOptions['label'], $this->confirmButtonOptions);
        }

        if(!empty($this->events)){
            foreach($this->events as $key => $event){
                $ex = '$(document).on(\''.$key.'\', \'.remodal[data-remodal-id='.$this->id.']\', function(e){'.$event.'});';
                $this->getView()->registerJs(new \yii\web\JsExpression($ex));
            }
        }

        return Html::tag('div', $modalData, [
            'class'                 =>  'remodal',
            'data-remodal-id'       =>  $this->id,
            'data-remodal-options'  =>  $this->modalOptions()
        ]);
    }

    public function modalOptions(){
        $options = [];

        foreach($this->options as $key => $option){
            $options[] = $key.': '.$option;
        }

        return implode(', ', $options);
    }

    public function renderButton($buttonOptions = []){
        if(!empty($buttonOptions)){
            $this->buttonOptions = array_merge($this->buttonOptions, $buttonOptions);
        }

        $tag = isset($this->buttonOptions['tag']) ? $this->buttonOptions['tag'] : 'a';
        $label = $this->buttonOptions['label'];

        unset($this->buttonOptions['tag'], $this->buttonOptions['label']);
        return Html::tag($tag, $label, array_merge($this->buttonOptions, [
            'href'    =>  '#'.$this->id
        ]));
    }

    public function run(){
        return $this->renderButton().$this->renderModal();
    }

}