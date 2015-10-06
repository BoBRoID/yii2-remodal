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

    public $id = 'remodal';

    private $optionsDefault = [
        'hashTracking'          =>  true,
        'closeOnOutsideClick'   =>  true,
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
        $this->id = $this->id.rand(0, 200000000);
        $this->options = array_merge($this->optionsDefault,$this->options);
        $this->buttonOptions = array_merge($this->buttonOptionsDefault,$this->buttonOptions);
        $this->cancelButtonOptions = array_merge($this->buttonOptionsDefault,$this->cancelButtonOptionsDefault);
        $this->confirmButtonOptions = array_merge($this->buttonOptionsDefault,$this->confirmButtonOptionsDefault);
    }

    public function renderModal(){
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

    public function renderButton(){
        return Html::tag('button', $this->buttonOptions['label'], array_merge($this->buttonOptions, [
            'href'    =>  '#'.$this->id
        ]));
    }

    public function run(){
        return $this->renderButton().$this->renderModal();
    }

}