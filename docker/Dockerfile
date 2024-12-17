FROM php:8.3-cli-alpine

RUN apk update && apk add git make

EXPOSE 80

ENTRYPOINT ["php", "-S", "0.0.0.0:80"]
CMD ["-t", "/workspaces/output/php-chunked-xhtml/"]
