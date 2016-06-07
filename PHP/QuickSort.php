<?php
/**
 * Quick sort implementation.
 *
 * Keywords: pivot
 */
class Quicksort
{
    /**
     * Sort an array.
     */
    public function sort(array $array):array
    {
        // The end of sorting.
        if (count($array) <= 1) {
            return $array;
        }

        $head = 0;
        $tail = count($array) - 1;

        // Get random pivot.
        $pivot = $array[$this->getPivot($head, $tail)];

        $smaller = [];
        $bigger = [];

        foreach ($array as $key => $value) {
            if ($value > $pivot) {
                $bigger[] = $value;
            } else {
                $smaller[] = $value;
            }
        }

        // Recursion sorting.
        return array_merge($this->sort($smaller), $this->sort($bigger));
    }

    /**
     * Test.
     */
    public function test()
    {
        $array = [1,2,20,12,33,23,11];
        $result = $this->sort($array);

        var_dump($result === [1,2,11,12,20,23,33]);
    }

    /**
     * Swap two elements of an array.
     * @param array $array
     * @param int $key1
     * @param int $key2
     * @return array
     */
    private function swap(array $array, int $key1, int $key2):array
    {
        $array[$key1] = $array[$key1] + $array[$key2] - ($array[$key2] = $array[$key1]);
        return $array;
    }

    /**
     * Get the pivot key.
     * @param int $head the head key of the range.
     * @param int $tail the tail key of the range.
     * @return int the key of the pivot.
     */
    private function getPivot(int $head, int $tail):int
    {
        return rand($head, $tail);
    }
}

(new Quicksort)->test();

# end of this file.
