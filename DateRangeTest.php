<?php

require_once 'DateRange.php';

class DateRangeTest extends PHPUnit_Framework_TestCase {
  public function testIsIncluded() {
    $dateRange = array(
      '2015-10-01',
      '2015-10-20'
    );
    $date = '2015-10-20';
    $actual = DateRange::isIncluded($dateRange, $date);
    $this->assertTrue($actual);

    $date = '2015-10-25';
    $actual = DateRange::isIncluded($dateRange, $date);
    $this->assertFalse($actual);
  }

}
