#!/bin/sh
#
# Check whether there is a syntax error in the php files.

for file in `git diff --cached --name-only`;do
    if [ "${file##*.}" = "php" ];then
        output=`php -l $file`

        if [ $? -gt 0 ];then
            echo $output
            exit 1
        fi
    fi
done