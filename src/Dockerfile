FROM tmvdl/android:app

WORKDIR /app

RUN cordova create [project] com.brtmvdl.[project] [project]

WORKDIR /app/[project]

COPY app www

COPY cp.sh .

RUN cordova platform add android

RUN cordova build android
