<?php

require_once 'DateRange.php';

class DateRangeTest extends PHPUnit_Framework_TestCase {
  public function testIncludes() {
    $dateRange = array(
      '2015-10-01',
      '2015-10-20'
    );
    $date = '2015-10-20';
    $actual = DateRange::includes($dateRange, $date);
    $this->assertTrue($actual);

    $date = '2015-10-25';
    $actual = DateRange::includes($dateRange, $date);
    $this->assertFalse($actual);
  }

  public function testOverlaps() {
    // Pattern 1
    $dateRange1 = array(
      '2015-10-01',
      '2015-10-20'
    );
    $dateRange2 = array(
      '2015-10-10',
      '2015-10-25'
    );
    $actual = DateRange::overlaps($dateRange1, $dateRange2);
    $this->assertTrue($actual);

    // Pattern 2
    $dateRange2 = array(
      '2015-10-21',
      '2015-10-25'
    );
    $actual = DateRange::overlaps($dateRange1, $dateRange2);
    $this->assertFalse($actual);

    // Pattern 3
    $dateRange1 = array(
      '2015-10-01',
      '2015-10-20'
    );
    $dateRange2 = array(
      '2015-09-20',
      '2015-10-10'
    );
    $actual = DateRange::overlaps($dateRange1, $dateRange2);
    $this->assertTrue($actual);

    // Pattern 4
    $dateRange2 = array(
      '2015-09-20',
      '2015-09-25'
    );
    $actual = DateRange::overlaps($dateRange1, $dateRange2);
    $this->assertFalse($actual);
  }

  public function testExtract() {
    $dateRange = array(
      '2015-10-01',
      '2015-10-05'
    );
    $actual = DateRange::extract($dateRange);
    $expected = array(
      strtotime('2015-10-01'),
      strtotime('2015-10-02'),
      strtotime('2015-10-03'),
      strtotime('2015-10-04'),
      strtotime('2015-10-05')
    );
    $this->assertEquals($expected, $actual);
  }
}
