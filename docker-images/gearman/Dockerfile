FROM ubuntu:xenial
MAINTAINER eshaft <eshaft@gmail.com>

RUN \
  apt-get update \
  && apt-get -y install --no-install-recommends \
      gearman-job-server \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

EXPOSE 4730

USER gearman

ENTRYPOINT [ "gearmand" ]