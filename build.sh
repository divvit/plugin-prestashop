VERSION=`cat src/divvit/config.xml | egrep -o "<version>(.*)</version>" | cut -f3 -d "[" | cut -f1 -d "]"`
cd src/divvit
zip -r ../../divvit-prestashop-plugin-${VERSION}.zip .
