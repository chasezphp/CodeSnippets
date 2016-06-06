<?php
/**
 * 图片与字符串互相转换。
 */
class ImgPipString
{
    /**
     * 图片转字符串
     * @param string $file 图片文件路径。
     * @return string
     */
    public static function img2str($file)
    {
        if (!file_exists($file)){
            return FALSE;
        }
        $str = chunk_split(base64_encode(file_get_contents($file)));
        return $str;
    }

    /**
     * 字符串转成图片输出。
     * @param type $str 图片文件字符串。
     * @param type $ext 图片扩展名。
     */
    public static function str2img($str, $ext)
    {
        header("Content-type: image/$ext");
        echo base64_decode($str);
    }
}

# end of this file