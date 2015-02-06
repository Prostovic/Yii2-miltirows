<?php

/**
 * MultirowsWidget class file.
 *
 * @package   yii2-multirows
 * @author    Victor Kozmin <promcalc@gmail.com>
 * @license   http://directory.fsf.org/wiki/License:BSD_3Clause
 * @copyright Copyright &copy; Victor Kozmin, 2015
 * @version   1.0.0
 */

namespace prostovic\yii2multirows;

use yii\base\Widget; 
 
class MultirowsWidget extends Widget
{
 
    /**
     * @var string model name to genereate form elements
     */
    public $model = '';

    /**
     * @var array existing ActiveRecords of $model
     */
    public $records = array();

    /**
     * @var CActiveForm form object for render fields
     */
    public $form = null;

    /**
     * @var array default attributes for new created objects
     */
    public $defaultattributes = array();

    /**
     * @var string view path to render form fields
     */
    public $rowview = '';

    /**
     * @var string jQuery selector to find link which add new model fields
     */
    public $addlinkselector = '';

    /**
     * @var string jQuery selector to find link which delete model fields.
     */
    public $dellinkselector = '';

    /**
     * @var string jQuery selector to find form object.
     */
    public $formselector = '';
	
    public function init() {}

    public function run() {
        $controller = $this->controller;
        $sRowClass = 'row' . $this->model . substr(md5(microtime()), mt_rand(0, 10), mt_rand(3, 6)); 
        $ob = new $this->model;
        if( ! empty($this->defaultattributes) ) {
            $ob->attributes = $this->defaultattributes;
        }
        $aData = array_merge(array($ob), $this->records);
        foreach($aData As $k=>$v) {
            echo '<div class="' . $sRowClass . '">';
            $this->controller->renderPartial(
                $this->rowview, 
                array(
                    'index' => $k,
                    'model' => $v,
                    'form' => $this->form,
                )
            );
            echo '</div>';
        }

        $sAssetDir = rtrim(dirname(__FILE__), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR;
        $sJs = $sAssetDir . 'js' . DIRECTORY_SEPARATOR . 'multirows.js';
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish($sJs));
        $sJs = <<<EOT
jQuery(function($) {
	Multirow({
		rowclass: ".{$sRowClass}",
		model: "{$this->model}",
		addlinkselector: "{$this->addlinkselector}",
		dellinkselector: "{$this->dellinkselector}",
		formselector: "{$this->formselector}"
	});
});
EOT;
        Yii::app()->clientScript->registerScript($this->model . "multirow", $sJs, CClientScript::POS_END);
    }


}
