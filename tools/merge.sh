#!/bin/sh

if [ $# -lt 1 ]
then
  echo
  echo 'usage : '$(basename $0)' <language code>'
  echo
  exit 1
fi

language=$1

if [ ! -f language/$language/LC_MESSAGES/messages.po ];then
    msgmerge -v language/$language/LC_MESSAGES/messages.po language/templates/messages.pot -o language/$language/LC_MESSAGES/messages.po
else
    msgmerge -v -U language/$language/LC_MESSAGES/messages.po language/templates/messages.pot 
fi
