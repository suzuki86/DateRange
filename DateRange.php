<?php

class DateRange {
  public static function isIncluded($dateRange, $date) {
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
}
