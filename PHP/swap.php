<?php
/**
 * Swap to variables' values without extra variable.
 */

$a = 1;
$b = 2;
var_dump($a, $b);

# Solution 1:
$a = $a + $b - ($b = $a);
var_dump($a, $b);

# Solution 2:
$a = $a + $b;
$b = $a - $b;
$a = $a - $b;
var_dump($a, $b);

# Solution 3:
$a = $a * $b;
$b = $a / $b;
$a = $a / $b;
var_dump($a, $b);
