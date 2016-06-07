<?php
/**
 * Searching a value from a sorted array with dichotomy method.
 *
 * Keywords: median
 *
 * @param int $target The value you want to find.
 * @param array $sorted_array The sorted array you want to search.
 * @return int
 */
function binarySearch($target, $sorted_array)
{
    $head = 0;
    $tail = count($sorted_array) - 1;
    while (true) {
        // Get the middle value.
        $mid = (int)floor(($head + $tail) / 2);
        $value = $sorted_array[$mid];
        // Get the target
        if ($value == $target) {
            return $mid;
        }
        // Reset head or tail.
        if ($value > $target) {
            $tail = $mid;
        } else {
            $head = $mid;
        }
    }
}

$sorted_array = [1,2,4,5,7,9,12,20];
$target = 5;
var_dump(binarySearch($target, $sorted_array));
