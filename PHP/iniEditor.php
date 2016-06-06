<?php
/**
 * 将数组写入ini文件。
 * @param array $array 待写入的数组。
 * @param string $file ini文件路径。
 * @return bool
 */
function iniEditor($array, $file)
{
    $res = [];
    
    foreach ($array as $key => $val) {
        if (is_array($val)) {
            $res[] = "[$key]";
            
            foreach($val as $skey => $sval) {
                $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
            }
        } else {
            $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
        }
    }

    return file_put_contents($file, implode("\r\n", $res));
}

# end of this file