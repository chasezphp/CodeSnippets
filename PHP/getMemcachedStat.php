<?php
/**
 * 获得memcached服务的状态信息。不需要额外的pecl扩展。
 * @param string $host
 * @param int $port
 * @return array
 */
function getMemcachedStat($host, $port)
{
    $s = fsockopen($host, $port, 1);

    if (!$s) {
        die("Cant connect to:" . $host . ':' . $port);
    }

    fwrite($s, "stats\r\n");
    $buf = array();

    while (!feof($s)) {
        $tmp = fgets($s, 256);
        $buf[] = $tmp;

        if (strpos($tmp, "END\r\n")!==false) {
            break;
        }
    }

    fclose($s);

    return $buf;
}

# end of this file