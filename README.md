# A micro-service implemented with PHP Phalcon


## API

The Swagger specification of the API is in `swagger.yaml`.


## Design

```
+-- Micro-Service Generic ---+
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
