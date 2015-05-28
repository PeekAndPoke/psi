#!/usr/bin/env bash

set -o verbose

sudo apt-get update -q

# install useful things
sudo apt-get install -q -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" vim htop curl mc git

# install php and libraries
sudo apt-get install -q -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" php5 php5-curl php5-intl php5-xsl php5-dev php5-cli

# install debug tools
sudo apt-get install -q -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" php5-xdebug
