# A micro-service implemented with PHP Phalcon

In the first iteration a PHP module is made accessable via a synchronous REST call.
This is not how a micro-service should be implemented.

To get an idea what a micro-service should look like and what a micro-service architecture is here a few links to get started:
* [QBit library](http://advantageous.github.io/qbit/)
* [Fowler on Micro-Service](https://www.youtube.com/watch?v=wgdBVIX9ifA)
* [Micro-Service Architekture](http://www.mammatustech.com/java-microservices-architecture)

This repo is a quick exercise on one fundamental requirement of a micro-service architecture. The automated build and deployment of the service. Part of the build are unit and acceptance tests.


## API

The specification of the API was done with Swagger and is in `swagger.yaml`.


## Design

```
+-- Micro-Service Library ---+
|                            |
|   +-- User Service ----+   |
|   |                    |   |
|   +--------------------+   |
|                            |
+----------------------------+
```


## Implementation

make use of the Phalcon\Micro framework


## Run

Install Roles from ansible-galaxy
```
ansible-galaxy install -r requirements.yml
```

Create and start the Vagrant box.
```
vagrant up
```


## Test

GET the customers
```
curl 127.0.0.1:8080/api/customers
```
