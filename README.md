# haushaltskosten



## Introduction

This is a skeleton application using the Laminas MVC layer and module
systems. This application is meant to extend on Laminas in a functional PHP Apache Environment.

## Using docker-compose

This application provides a `docker-compose.yml` for use with
[docker-compose](https://docs.docker.com/compose/); it
uses the provided `Dockerfile` to build a docker image 
for the `laminas` container created with `docker-compose`.

Build and start the image and container using:

```bash
$ docker-compose up -d --build
```

At this point, you can visit http://localhost/public/hako to see the site running.
Use http://localhost:8080 to connect to database using adminer.