# DateRange

A Utility class for handling range of date written in PHP.

[![Build Status](https://travis-ci.org/suzuki86/DateRange.svg?branch=master)](https://travis-ci.org/suzuki86/DateRange)

## Usage

### Check whether a certain date is included a certain date range.

```php
$dateRange = new DateRange('2015-10-01', '2015-10-20');
$result = $dateRange->includes('2015-10-10');

var_dump($result); // bool(true)
```

### Check whether a certain date range overlaps with a certain date range.

```php
$dateRange = new DateRange('2015-10-01', '2015-10-20');
$target = new Daterange('2015-10-10', '2015-10-25');
$result = $dateRange->overlaps($target);

var_dump($result); // bool(true)
```

### Extract included each date from a certain date range.

```php
$dateRange = new DateRange('2015-10-01', '2015-10-05');
$result = $dateRange->extract();

echo date('Y-m-d', $result[0]); // '2015-10-01'
echo date('Y-m-d', $result[1]); // '2015-10-02'
echo date('Y-m-d', $result[2]); // '2015-10-03'
// ...
```
