#!/usr/bin/env bash
# Add create date to markdown files.

markdown_path=/Users/liuxidong/Github/liuxd.github.io/markdown/index/英语

if [ ! -n $1 ];then
  markdown_path=$1
fi

cd $markdown_path

ls|while read f;do
  create_time=`git log --max-count=1 --reverse --pretty=format:'%ci' --abbrev-commit "$f"|awk '{print $1}'`
  new_filename="$create_time ${f%.*}.md"
  git mv "$f" "$new_filename"
done