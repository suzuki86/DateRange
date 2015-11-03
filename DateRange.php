<?php

class DateRange {

  public $startDate;

  public $endDate;

  public $dateRange = array();

  public function __construct($startDate, $endDate) {
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->dateRange = array(
      $startDate,
      $endDate
    );
  }

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
}
