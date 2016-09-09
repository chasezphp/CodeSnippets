<?php
/**
 * git commit hook
 * Check whether commit message include Chinese. If there is, stop the commit.
 */

function cecho($string, $style = 'notice') {
    if (isset($_SERVER['REQUEST_URI'])){
        echo $string, "\n";
        return;
    }

    $colors = array(
        'info' => '1',
        'notice' => '32',
        'error' => '31',
        'system' => '34',
    );

    $string = addslashes($string);
    $cmd = "echo \"\033[{$colors[$style]}m$string\033[0m\n\"";
    $out = array();
    exec($cmd, $out);

    if (isset($out[0])){
        echo $out[0], "\n";
    }
}

$opts = ['commit-file:'];

$options = getopt('', $opts);
$cf = $options['commit-file'];

$commit_content = file($cf);

$msgs = array_filter($commit_content, function($v){
    $v = trim($v);

    if (substr($v, 0, 1) !== '#') {
        return $v;
    }
});

if (empty($msgs)) {
    exit(1);
}

foreach ($msgs as $msg) {
    $match = preg_match('/[\x{4e00}-\x{9fa5}]/u', $msg);

    if ($match > 0) {
        cecho('Chinese commit messages are forbidden!', 'error');
        exit(1);
    }
}

exit(0);

# end of this file
