# haushaltskosten



## Introduction

This is a skeleton application using the Laminas MVC layer and module
systems. This application is meant to extend on Laminas in a functional PHP Apache Environment.

## Running Unit Tests

To run the supplied skeleton unit tests, you need to do one of the following:

- During initial project creation, select to install the MVC testing support.
- After initial project creation, install [laminas-test](https://docs.laminas.dev/laminas-test/):

  ```bash
  $ composer require --dev laminas/laminas-test
  ```

Once testing support is present, you can run the tests using:

```bash
$ ./vendor/bin/phpunit
```

If you need to make local modifications for the PHPUnit test setup, copy
`phpunit.xml.dist` to `phpunit.xml` and edit the new file; the latter has
precedence over the former when running tests, and is ignored by version
control. (If you want to make the modifications permanent, edit the
`phpunit.xml.dist` file.)

## Running Psalm Static Analysis

To run the supplied skeleton static analysis, you need to do one of the following:
It is recommended to install the test components from laminas (laminas/laminas-test), 
as this is used in the tests supplied.

  ```bash
  $ composer require --dev vimeo/psalm psalm/plugin-phpunit laminas/laminas-test
  ```

Once psalm support is present, you can run the static analysis using:

```bash
$ composer static-analysis
```

## Using docker-compose

This application provides a `docker-compose.yml` for use with
[docker-compose](https://docs.docker.com/compose/); it
uses the provided `Dockerfile` to build a docker image 
for the `laminas` container created with `docker-compose`.

Build and start the image and container using:

```bash
$ docker-compose up -d --build
```

At this point, you can visit http://localhost/public to see the site running.

You can also run commands such as `composer` in the container.  T