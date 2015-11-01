<?php

class DateRange {
  public static function includes($dateRange, $date) {
    $dateRange = array_map('strtotime', $dateRange);
    $date = strtotime($date);
    if (
      max($dateRange) >= $date &&
      min($dateRange) <= $date
    ) {
      return true;
    }
    return false;
  }

  public static function overlaps($dateRange1, $dateRange2) {
    $dateRange1 = array_map('strtotime', $dateRange1);
    $dateRange2 = array_map('strtotime', $dateRange2);
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

  public static function extract($dateRange) {
    $dateRange = array_map('strtotime', $dateRange);
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
