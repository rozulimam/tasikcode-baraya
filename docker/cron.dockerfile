FROM forwarding_app

COPY docker/cron.sh /usr/local/bin/cron
RUN chmod +x /usr/local/bin/cron

CMD [ "/usr/local/bin/cron" ]