#!/bin/bash
DIR="/var/www/html/start-up-tokyo/src"
OIL="${DIR}/oil"
ENV='development'
FUEL_ENV=${ENV} php ${OIL} r event:sendRemind