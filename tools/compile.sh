#!/bin/sh

if [ $# -lt 1 ]
then
  echo
  echo 'usage : '$(basename $0)' <language code> [domain]'
  echo
  exit 1
fi

language=$1
if [ $2 ];then
domain=$2
else
domain=piwigo
fi

msgfmt language/$language/LC_MESSAGES/$domain.po -o language/$language/LC_MESSAGES/$domain.mo