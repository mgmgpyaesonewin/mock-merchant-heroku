#!/bin/zsh
while read line; do
    echo $line
    echo "Setting NEXT VAR ..."
   heroku config:set $line --app wavemockmerchant2prod
done < .env.preprod
