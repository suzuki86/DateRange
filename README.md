# DateRange

A Utility class for handling range of date written in PHP.

[![Build Status](https://travis-ci.org/suzuki86/DateRange.svg?branch=master)](https://travis-ci.org/suzuki86/DateRange)

## Usage

### Check whether a certain date is included a certain date range.

```php
$result = DateRange::includes(
  array(
    '2015-10-01',
    '2015-10-20'
  ),
  '2015-10-10'
);

var_dump($result); // bool(true)
```

### Check whether a certain date range overlaps with a certain date range.

```php
$result = DateRange::overlaps(
  array(
    '2015-10-01',
    '2015-10-20'
  ),
  array(
    '2015-10-10',
    '2015-10-25'
  )
);

var_dump($result); // bool(true)
```
