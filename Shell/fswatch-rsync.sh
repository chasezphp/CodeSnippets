#!/usr/bin/env sh
#
# Description:
#     Make your local folder to remote server synchronization.
# Requirements:
#     brew install fswatch

SRC=/Users/liuxd/Documents/guess_cheat_new/
DES=liuxidong@172.16.0.37:/home/liuxidong/project/cheat/
EXCLUDE=/Users/liuxd/Downloads/rsync-exlcude.txt

fswatch $SRC | while read ev
do
  if [ -e $ev ];then
    rsync -av --delete --exclude-from=$EXCLUDE $SRC $DES
  fi
done

# end of this file