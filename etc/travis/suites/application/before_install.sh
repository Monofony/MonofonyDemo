#!/usr/bin/env bash

source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/../../../bash/common.lib.sh"
source "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/../../../bash/application.sh"

print_header "Activating memcached extension" "Monofony"
run_command "echo \"extension = memcached.so\" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini" || exit $?

print_header "Updating Composer" "Monofony"
run_command "composer self-update --preview"

# Download and configure Symfony webserver
print_header "Downloading Symfony CLI" "Sylius"
if [ ! -f $MONOFONY_CACHE_DIR/symfony ]; then
    run_command "wget https://get.symfony.com/cli/installer -O - | bash"
    run_command "mv ~/.symfony/bin/symfony $MONOFONY_CACHE_DIR"
fi
run_command "$MONOFONY_CACHE_DIR/symfony version"
