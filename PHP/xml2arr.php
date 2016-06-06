<?php
/**
  * xml字符串转成数组。
  *
  * @param string $xml
  * @return array
  */
function xml2arr ($xml)
{
    libxml_disable_entity_loader(true);
    return (array)simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
}