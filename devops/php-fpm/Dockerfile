FROM phpdockerio/php71-fpm:latest

LABEL maintainer="Alex Gomes <contato@alexwebmaster.com.br>"
LABEL version="0.0.1"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.1-bcmath php7.1-mysql php7.1-pgsql php7.1-gd php7.1-intl php7.1-mbstring php7.1-soap \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


WORKDIR "/application"
