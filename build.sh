rm -rf build
mkdir build
VERSION=`./version.sh`
cd src/divvit
zip -r ../../build/divvit-prestashop-plugin-${VERSION}.zip .
