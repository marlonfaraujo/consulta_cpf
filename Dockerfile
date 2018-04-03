FROM tutum/lamp
RUN apt-get update && apt-get install -y \
 php5-sqlite