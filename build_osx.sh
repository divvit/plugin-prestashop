#!/usr/bin/env bash

rm -rf build
mkdir build
VERSION=$( cat src/divvit/config.xml | egrep -o "<version>(.*)</version>" | cut -f3 -d "[" | cut -f1 -d "]" )
cd src
zip -r ../build/divvit-prestashop-plugin-${VERSION}.zip divvit

