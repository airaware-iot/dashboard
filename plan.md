# The mission.

## Models
- [ ] **Devices**
    - [ ] Model: name, type
    - [ ] Config for what type corresponds to what icon _or logic?_
- [ ] **Data**
    - [ ] Model: type, value(str), timestamp
    - [ ] Observer: Observe new data coming in and perform "sorting" and "labeling" data
    - [ ] Configuration file to cast a data entry to the right data type based on `type` column
- [ ] **Aggregate**
    - [ ] Model: 
    - getHourlyAvg
    - `getDailyAvg($start_day,)`
    - getLatest
    - 

```php

public class deviceDataService() 
{
    function __constructor (
        protected int $device_id,
    ) {}
    
    function getLatest($dataType) {}
    
    function getHourlyAvg($dataType, $dateFrom, $dateTo) {
        // The sensors send data irregularly, meaning that a simple avg() doesnt work as a certain
        // value may have been current longer. I think the way to solve this is this:
        
        // dateFrom must be before dateTo
        
        // 1. Get all the relevant data entries from the table
        // 2. Loop over all entries and determine how many seconds passed between each entry
        // 3. Multiply each entry based on the seconds passed
        // 4. Divide the total sum of all values by number of seconds between $dateFrom and $dateTo
        // 5. Return this value
        
        // This function should return a Collection of averages, one for each hour difference between
        // dateFrom and dateTo as an associative array of a timestamp and value. E.g.
        // ['2025-03-12-12:00:00' => 34.3, '2025-03-12-13:00:00' => 29.4]
    
    }
    function getDailyAvg($dataType, $dateFrom, $dateTo, ) {
        // Logic is the same as getHourlyAvg()
    }
    
    // Based on getHourlyAvg and getDailyAvg
    // Note: these return a collection, N days or N hours depending
    
    function getLastHour(now(), now()->subHour())
    function getLastSixHours()
    function getLastTwelveHours()
    function getLastTwentyFourHours()
    function getLastFortyEightHours()
    function getLastSeventyTwoHours()
    function getLastDay()
    function getLastThreeDays()
    function getLastWeek()
    function getLastTwoWeeks()
    function getLastMonth()
    function getLastQuarter()
    function getLastSemester()
    function getLastYear()
}


function get
```