FROM ubuntu:xenial
MAINTAINER eshaft <eshaft@gmail.com>

RUN \
  apt-get update \
  && apt-get install -y beanstalkd \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

EXPOSE 11300

ENTRYPOINT [ "beanstalkd" ]