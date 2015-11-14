<?php

require_once 'src/DateRange.php';

class DateRangeTest extends PHPUnit_Framework_TestCase {
  public function testIncludes() {
    $dateRange = new DateRange(
      strtotime('2015-10-01'),
      strtotime('2015-10-20')
    );
    $actual = $dateRange->includes(
      strtotime('2015-10-20')
    );
    $this->assertTrue($actual);

    $actual = $dateRange->includes(
      strtotime('2015-10-25')
    );
    $this->assertFalse($actual);
  }

  public function testOverlaps() {
    // Pattern 1
    $dateRange = new DateRange(
      strtotime('2015-10-01'),
      strtotime('2015-10-20')
    );
    $target = new DateRange(
      strtotime('2015-10-10'),
      strtotime('2015-10-25')
    );
    $actual = $dateRange->overlaps($target);
    $this->assertTrue($actual);

    // Pattern 2
    $target = new DateRange(
      strtotime('2015-10-21'),
      strtotime('2015-10-25')
    );
    $actual = $dateRange->overlaps($target);
    $this->assertFalse($actual);

    // Pattern 3
    $dateRange = new DateRange(
      strtotime('2015-10-01'),
      strtotime('2015-10-20')
    );
    $target = new DateRange(
      strtotime('2015-09-20'),
      strtotime('2015-10-10')
    );
    $actual = $dateRange->overlaps($target);
    $this->assertTrue($actual);

    // Pattern 4
    $target = new DateRange(
      strtotime('2015-09-20'),
      strtotime('2015-09-25')
    );
    $actual = $dateRange->overlaps($target);
    $this->assertFalse($actual);
  }

  public function testExtract() {
    $dateRange = new DateRange(
      strtotime('2015-10-01'),
      strtotime('2015-10-05')
    );
    $actual = $dateRange->extract();
    $expected = array(
      strtotime('2015-10-01'),
      strtotime('2015-10-02'),
      strtotime('2015-10-03'),
      strtotime('2015-10-04'),
      strtotime('2015-10-05')
    );
    $this->assertEquals($expected, $actual);
  }

  public function testGetOverlap() {
    $dateRange = new DateRange(
      strtotime('2015-10-01'),
      strtotime('2015-10-05')
    );
    $target = new DateRange(
      strtotime('2015-10-03'),
      strtotime('2015-10-07')
    );
    $overlappedDateRange = $dateRange->getOverlap($target);
    $actual = $overlappedDateRange->extract();
    $expected = array(
      strtotime('2015-10-03'),
      strtotime('2015-10-04'),
      strtotime('2015-10-05')
    );
    $this->assertEquals($expected, $actual);

    $target = new DateRange(
      strtotime('2015-10-06'),
      strtotime('2015-10-07')
    );
    $this->assertSame(null, $dateRange->getOverlap($target));
  }

  public function testMerge() {
    $dateRange = new DateRange(
      strtotime('2015-10-01'),
      strtotime('2015-10-05')
    );
    $target = new DateRange(
      strtotime('2015-10-03'),
      strtotime('2015-10-07')
    );
    $actual = $dateRange->merge($target);
    $this->assertSame(strtotime('2015-10-01'), $actual->startDate);
    $this->assertSame(strtotime('2015-10-07'), $actual->endDate);

    $target = new DateRange(
      strtotime('2015-10-08'),
      strtotime('2015-10-10')
    );
    $actual = $dateRange->merge($target);
    $this->assertSame(strtotime('2015-10-01'), $actual->startDate);
    $this->assertSame(strtotime('2015-10-10'), $actual->endDate);
  }
}
