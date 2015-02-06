<?php
 
use prostovic\yii2multirows\MultirowsWidget;
 
class MultirowsTest extends PHPUnit_Framework_TestCase {
 
  public function testRun()
  {
    $oWidget = new MultirowsWidget;
    $this->assertTrue($oWidget->run());
  }
 
}
