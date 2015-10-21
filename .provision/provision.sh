#!/usr/bin/env bash

set -o verbose

sudo apt-get update -q

# install useful things
sudo apt-get install -q -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" vim htop curl mc git python-pip software-properties-common

# add ppa to get php above 5.5.9
sudo add-apt-repository -y ppa:ondrej/php5
sudo apt-get update -q

# install php and libraries
sudo apt-get install -q -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" php5 php5-curl php5-intl php5-xsl php5-dev php5-cli

# install debug tools
sudo apt-get install -q -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" php5-xdebug


# install sphinx for documentation
sudo pip install sphinx sphinx-autobuild sphinx_rtd_theme sphinxcontrib-phpdomain
sudo pip install recommonmark
