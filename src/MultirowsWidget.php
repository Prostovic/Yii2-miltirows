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
 
class MultirowsWidget {
 
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
        return true;
    }


}
