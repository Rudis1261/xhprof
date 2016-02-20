#!/bin/sh
# Helper to join SQL files
# Awesome site https://www.mockaroo.com/schemas/download, but only allows 1000 records to be download, MEH!
# $1 filename
# $2 current file number

cat "$1 ($2).sql" >> $1.sql; rm "$1 ($2).sql"