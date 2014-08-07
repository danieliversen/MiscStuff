#!/bin/bash
# Generate mass icon and splash screens for Oracle ADF Mobile / MAF
# Based on Phonegap code copyright 2013 Tom Vincent <http://tlvince.com/contact>
# modified a little by Nathan Birchenough, 2014 - http://birchenough.co.uk
# modified a lot (but with no real creativity) by Daniel Iversen - www.nexle.dk
# sh ~/apps/oracle-maf-adf-mobile-icon-splashscreen-generator.sh icon colour

usage() { echo "usage: $0 icon colour [dest_dir]"; exit 1; }

[ "$1" ] && [ "$2" ] || usage
[ "$3" ] || set "$1" "$2" "."

proj=${PWD##*/};
echo "project name: $proj";

devices=android,bada,bada-wac,blackberry,ios,webos,windows-phone
eval mkdir -p "$3/{android,ios}"

# Show the user some progress by outputing all commands being run.
set -x

# Explicitly set background in case image is transparent (see: #3)
convert="/opt/ImageMagick/bin/convert -background none"

$convert "$1" -resize 72x72 "$3/android/display-hdpi-icon.png"
$convert "$1" -resize 36x36 "$3/android/display-ldpi-icon.png"
$convert "$1" -resize 48x48 "$3/android/display-mdpi-icon.png"
$convert "$1" -resize 72x72 "$3/android/display-xhdpi-icon.png"

$convert "$1" -resize 144x144 "$3/ios/icon-144.png"
$convert "$1" -resize 72x72 "$3/ios/icon-72.png"
$convert "$1" -resize 57x57 "$3/ios/icon.png"
$convert "$1" -resize 114x114 "$3/ios/icon@2x.png"


convert="/opt/ImageMagick/bin/convert $1 -background $2 -gravity center"

$convert -resize 300x300 -extent 1280x800 "$3/android/display-land-hdpi-splashscreen.png"
$convert -resize 300x300 -extent 800x480 "$3/android/display-land-ldpi-splashscreen.png"
$convert -resize 300x300 -extent 800x480 "$3/android/display-land-mdpi-splashscreen.png"
$convert -resize 400x400 -extent 1024x768 "$3/android/display-land-xhdpi-splashscreen.png"
$convert -resize 300x300 -extent 800x1280 "$3/android/display-port-hdpi-splashscreen.png"
$convert -resize 300x300 -extent 480x800 "$3/android/display-port-ldpi-splashscreen.png"
$convert -resize 300x300 -extent 480x800 "$3/android/display-port-mdpi-splashscreen.png"
$convert -resize 400x400 -extent 768x1024 "$3/android/display-port-xhdpi-splashscreen.png"

$convert -resize 200x200 -extent 320x480 "$3/ios/Default-1135h@2x.png"
$convert -resize 450x450 -extent 640x1136 "$3/ios/Default-568h@2x.png"
$convert -resize 200x200 -extent 480x320 "$3/ios/Default-Land.png"
$convert -resize 400x400 -extent 1024x768 "$3/ios/Default-Landscape-Ipad.png"
$convert -resize 400x400 -extent 1024x768 "$3/ios/Default-Landscape.png"
$convert -resize 800x800 -extent 2048x1536 "$3/ios/Default-Landscape@2x~ipad.png"
$convert -resize 400x400 -extent 768x1024 "$3/ios/Default-Portrait-Ipad.png"
$convert -resize 400x400 -extent 768x1024 "$3/ios/Default-Portrait.png"
$convert -resize 800x800 -extent 1536x2048 "$3/ios/Default-Portrait@2x~ipad.png"
$convert -resize 200x200 -extent 320x480 "$3/ios/Default.png"
$convert -resize 300x300 -extent 960x640 "$3/ios/Default@2x-Landscape.png"
$convert -resize 300x300 -extent 640x960 "$3/ios/Default@2x.png"
$convert -resize 300x300 -extent 512x512 "$3/ios/iTunesArtwork.png"



