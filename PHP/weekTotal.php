<?php
/**
 * 计算某年有多少周。按每周以星期一开始来计算。
 * @param int $year
 * @return int
 */
function weekTotal($year)
{
    /**
     * 计算某个日期是星期几。
     * @return int
     */
    $getWeekDay = function ($year, $mon, $day) {
        $unixtime = mktime(0, 0, 0, $mon, $day, $year);
        $date = getdate($unixtime);
        return $date['wday'];
    };

    $isLeapyear = ($year % 4 == 0) ? true : false;
    $total = 53;
    if ($isLeapyear) {
        $firstWeekday = $getWeekDay($year, 1, 1);
        $lastWeekday = $getWeekDay($year, 12, 31);
        if ($firstWeekday == 0 && $lastWeekday == 1) {
            $total = 54;
        }
    }
    return $total;
}

# end of this file