# DateRange

A Utility class for handling range of date written in PHP.

[![Build Status](https://travis-ci.org/suzuki86/DateRange.svg?branch=master)](https://travis-ci.org/suzuki86/DateRange)

## Usage

### DateRange::includes()

Check whether a certain date is included a certain date range.

```php
$dateRange = new DateRange(
  strtotime('2015-10-01'),
  strtotime('2015-10-20')
);
$result = $dateRange->includes(strtotime('2015-10-10'));

var_dump($result); // bool(true)
```

### DateRange::overlaps()

Check whether a certain date range overlaps with a certain date range.

```php
$dateRange = new DateRange(
  strtotime('2015-10-01'),
  strtotime('2015-10-20')
);
$target = new DateRange(
  strtotime('2015-10-10'),
  strtotime('2015-10-25')
);
$result = $dateRange->overlaps($target);

var_dump($result); // bool(true)
```

### DateRange::extract()

Extract included each date from a certain date range.

```php
$dateRange = new DateRange(
  strtotime('2015-10-01'),
  strtotime('2015-10-05')
);
$result = $dateRange->extract();

echo date('Y-m-d', $result[0]); // '2015-10-01'
echo date('Y-m-d', $result[1]); // '2015-10-02'
echo date('Y-m-d', $result[2]); // '2015-10-03'
// ...
```

### DateRange::getOverlap()

Get all overlapped dates.

```php
$dateRange = new DateRange(
  strtotime('2015-10-01'),
  strtotime('2015-10-05')
);
$target = new DateRange(
  strtotime('2015-10-03'),
  strtotime('2015-10-07')
);
$resultDateRange = $dateRange->getOverlap($target);
echo strtotime('Y-m-d', $resultDateRange->startDate); // '2015-10-03'
echo strtotime('Y-m-d', $resultDateRange->endDate); // '2015-10-05'
```

### DateRange::merge()

Merge a certain date range with another one.

```php
$dateRange = new DateRange(
  strtotime('2015-10-01'),
  strtotime('2015-10-05')
);
$target = new DateRange(
  strtotime('2015-10-03'),
  strtotime('2015-10-07')
);
$resultDateRange = $dateRange->merge($target);
echo strtotime('Y-m-d', $resultDateRange->startDate); // '2015-10-01'
echo strtotime('Y-m-d', $resultDateRange->endDate); // '2015-10-07'
```

