<?php
/**
 * PHP三种POST数据的方式。
 */
class PHPPost
{
    /**
     * 通过cUrl扩展的POST。
     * @param string $url
     * @param array $post_data
     * @param int $timeout
     * @param int $conn_timeout
     * @return string
     */
    public static function curlPost($url, $post_data = [], $timeout = 5, $conn_timeout = 2)
    {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);

        if ($post_data) {
            $tmp = [];
            foreach ($post_data as $name => $value) {
                $tmp[] = $name . '=' . $value;
            }
            $data = implode('&', $tmp);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $conn_timeout);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $file_contents = curl_exec($ch);
        curl_close($ch);

        return $file_contents;
    }

    /**
     * 通过stream进行POST。
     * @param string $url
     * @param array $data
     * @return string
     */
    public static function post2($url, $data)
    {
        $postdata = http_build_query($data);
        $opts = [
            'http' => [ 
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            ]
        ];
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);

        return $result;
    }

    /**
     * 通过socket实现POST。
     * @param string $host
     * @param string $path
     * @param string $query
     * @param string $others
     * @return string
     */
    public static function socketPost($host, $path, $query, $others='')
    {
        $post = "POST $path HTTP/1.1\r\nHost: $host\r\n";
        $post .= "Content-type: application/x-www-form-";
        $post .= "urlencoded\r\n${others}";
        $post .= "User-Agent: Mozilla 4.0\r\nContent-length: ";
        $post .= strlen($query) . "\r\nConnection: close\r\n\r\n$query";
        $h = fsockopen($host, 80);
        fwrite($h, $post);

        for ($a = 0, $r = ''; !$a; ) {
            $b = fread($h,8192);
            $r .= $b;
            $a = (($b == '') ? 1 : 0);
        }

        fclose($h);

        return $r;
    }
}

# end of this file
