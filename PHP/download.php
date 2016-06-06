<?php

function download($sContent, $sFileName)
{
    header("Content-type: application/octet-stream");
    header("Accept-Length: " . mb_strlen($sContent));
    header("Content-Disposition: attachment; filename=" . $sFileName);
    echo $sContent;
}

# end of this file.