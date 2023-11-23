## Querys to try the server

### Get a customer

```
query {
  customer(id: "655e84326351c6baed6194b1"){
    id,
    age,
    firstname
  }
}
```


### Create a customer
```
mutation {
  createCustomer(firstname: "Juan", lastname: "Pablo", age: 32){
      id,
      firstname
  }
}
```


### Delete a customer