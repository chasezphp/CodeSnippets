#!/usr/bin/env bash
#
# Check the modified php file's syntax in a subversion repository.

function _cecho {
  case $2 in
    info )
      color=33;;
    error )
      color=31;;
    success )
      color=32;;
    *)
      color=1;;
  esac

  echo -e "\033["$color"m$1\033[0m"
}

cur=${PWD}

for i in `svn st|awk '{print $2}'|grep '.php\>'`;do
  msg=`php -l $i 2>&1`

  if [ $? -ne 0 ];then
    _cecho "$msg" error
    exit
  fi
done

if [ $? -eq 0 ];then
  _cecho "Wonderful!" success
fi

# end of this file.