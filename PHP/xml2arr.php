<?php
/**
  * xml字符串转成数组。
  *
  * @param string $xml
  * @return array
  */
function xml2arr ($xml)
{
    return (array) simplexml_load_string($xml);
}