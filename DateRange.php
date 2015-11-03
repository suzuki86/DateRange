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
    $dateRange = array_map('strtotime', $this->dateRange);
    $date = strtotime($date);
    if (
      max($dateRange) >= $date &&
      min($dateRange) <= $date
    ) {
      return true;
    }
    return false;
  }

  public function overlaps($dateRange) {
    $dateRange1 = array_map('strtotime', $this->dateRange);
    $dateRange2 = array_map('strtotime', $dateRange);
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
    $dateRange = array_map('strtotime', $this->dateRange);
    $startDate = min($dateRange);
    $endDate = max($dateRange);
    $currentDate = $startDate;
    $dates = array();
    while ($currentDate <= $endDate) {
      $dates[] = date('Y-m-d', $currentDate);
      $currentDate = strtotime('+ 1 day', $currentDate);
    }
    return $dates;
  }
}
