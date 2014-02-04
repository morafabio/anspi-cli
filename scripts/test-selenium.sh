#!/bin/sh

# tested against Selenium 2.39.0 (java -jar selenium-server-standalone-2.39.0.jar)
# eg. wget "https://selenium.googlecode.com/files/selenium-server-standalone-2.39.0.jar"

phpunit -c config/ test/
