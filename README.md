# DateRange

A Utility class for handling range of date written in PHP.

## Usage

### Check whether a certain date is included a certain date range.

```php
$result = DateRange::isIncluded(
  array(
    '2015-10-01',
    '2015-10-20'
  ),
  '2015-10-10'
);

var_dump($result); // bool(true)
```
