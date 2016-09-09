#!/bin/bash

SRC_PATH="/Users/liuxd/SpiderOak Hive/Book/holdme1234"
DES_PATH="/Users/liuxd/Downloads/tmp"

ls $SRC_PATH |grep txt|while read file
do
    iconv -f GB18030 -t UTF-8 "$SRC_PATH/$file" > "$DES_PATH/$file"
done