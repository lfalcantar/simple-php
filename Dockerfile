FROM debian:bullseye-slim
RUN apt-get update && apt-get install -y cowsay iputils-ping fortune  && rm -rf /var/lib/apt/lists/*
CMD /usr/games/fortune | /usr/games/cowsay
