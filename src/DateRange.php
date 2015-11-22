<?php

namespace DateRange;

class DateRange {

  /**
   * Holds first date as timestamp.
   *
   * @var int
   */
  public $startDate;

  /**
   * Holds last date as timestamp.
   *
   * @var int
   */
  public $endDate;

  /**
   * Holds first date and last date as timestamp.
   *
   * @var array
   */
  public $dateRange = array();

  /**
   * Constructor
   *
   * @param int $startDate Timestamp of first date.
   * @param int $endDate Timestamp of last date.
   */
  public function __construct($startDate, $endDate) {
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->dateRange = array(
      $startDate,
      $endDate
    );
  }

  /**
   * Check whether a date paased as argument is included in this date range.
   *
   * @param int $date Timestamp
   * @return bool True if a date passed as argument is included in this date range, otherwise false.
   */
  public function includes($date) {
    $dateRange = $this->dateRange;
    if (
      max($dateRange) >= $date &&
      min($dateRange) <= $date
    ) {
      return true;
    }
    return false;
  }

  /**
   * Check whether a date range paased as argument overlaps with this date range.
   *
   * @param DateRange $dateRange DateRange object to check.
   * @return bool True if a date range passed as argument overlaps with this date range, otherwise false.
   */
  public function overlaps(DateRange $dateRange) {
    $dateRange1 = $this->dateRange;
    $dateRange2 = array(
      $dateRange->startDate,
      $dateRange->endDate
    );
    if (
      (
        (min($dateRange2) < max($dateRange1)) &&
        (min($dateRange1) < max($dateRange2))
      ) || (
        (min($dateRange1) < max($dateRange2)) &&
        (min($dateRange2) < max($dateRange1))
      )
    ) {
      return true;
    }
    return false;
  }

  /**
   * Get all dates between first date and last date.
   *
   * @return array Array that includes all timestamps between first date and last date.
   */
  public function extract() {
    $dateRange = $this->dateRange;
    $startDate = min($dateRange);
    $endDate = max($dateRange);
    $currentDate = $startDate;
    $dates = array();
    while ($currentDate <= $endDate) {
      $dates[] = $currentDate;
      $currentDate = strtotime('+ 1 day', $currentDate);
    }
    return $dates;
  }

  /**
   * Get overlapped dates.
   *
   * @param DateRange $dateRange DateRange object to compare.
   * @return DateRange DateRange object of overlapped dates.
   */
  public function getOverlap(DateRange $dateRange) {
    if (!$this->overlaps($dateRange)) {
      return null;
    }
    $result = array_intersect(
      $this->extract(),
      $dateRange->extract()
    );
    return new DateRange(min($result), max($result));
  }

  /**
   * Merge two DateRange objects into one DateRange object.
   *
   * @param DateRange $dateRange Daterange object to merge.
   * @return DateRange DateRange object that is merged.
   */
  public function merge(DateRange $dateRange) {
    $dateRange1 = $this->extract();
    $dateRange2 = $dateRange->extract();
    $resultDateRange = array_unique(
      array_merge($dateRange1, $dateRange2),
      SORT_NUMERIC
    );
    return new DateRange(
      min($resultDateRange),
      max($resultDateRange)
    );
  }
}
