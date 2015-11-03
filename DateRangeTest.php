<?php

require_once 'DateRange.php';

class DateRangeTest extends PHPUnit_Framework_TestCase {
  public function testIncludes() {
    $dateRange = new DateRange('2015-10-01', '2015-10-20');
    $actual = $dateRange->includes('2015-10-20');
    $this->assertTrue($actual);

    $actual = $dateRange->includes('2015-10-25');
    $this->assertFalse($actual);
  }

  public function testOverlaps() {
    // Pattern 1
    $dateRange = new DateRange(
      '2015-10-01',
      '2015-10-20'
    );
    $target = array(
      '2015-10-10',
      '2015-10-25'
    );
    $actual = $dateRange->overlaps($target);
    $this->assertTrue($actual);

    // Pattern 2
    $target = array(
      '2015-10-21',
      '2015-10-25'
    );
    $actual = $dateRange->overlaps($target);
    $this->assertFalse($actual);

    // Pattern 3
    $dateRange = new DateRange(
      '2015-10-01',
      '2015-10-20'
    );
    $target = array(
      '2015-09-20',
      '2015-10-10'
    );
    $actual = $dateRange->overlaps($target);
    $this->assertTrue($actual);

    // Pattern 4
    $target = array(
      '2015-09-20',
      '2015-09-25'
    );
    $actual = $dateRange->overlaps($target);
    $this->assertFalse($actual);
  }

  public function testExtract() {
    $dateRange = new DateRange(
      '2015-10-01',
      '2015-10-05'
    );
    $actual = $dateRange->extract();
    $expected = array(
      '2015-10-01',
      '2015-10-02',
      '2015-10-03',
      '2015-10-04',
      '2015-10-05'
    );
    $this->assertEquals($expected, $actual);
  }
}
