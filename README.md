# mylittlebiz-php

This API allows you to launch/schedule SMS and/or EMAIL campaigns to your client database and see their statistics in real time.

## API Account

Log in to your MyLittleBiz account and create an API which will give you access to a pair of keys.

Click on “My account” in the main menu, then “Account settings” then “API tab” and follow instructions.

## Installation

You can install **mylittlebiz-php** via composer or by downloading the source.

## Quickstart

### Initialize the Client

The client is initialized by passing in the constructor the api key and secret parameters you can find on 
(http://marketingcible.mylittlebiz.fr/account)

```php
$api_key = "AKXXXXXX"; // Your Account Key
$api_secret = "ASYYYYYY"; // Your API Secret

$Client = new \MyLittleBiz\Client($api_key, $api_secret);
```

### API KEYS CHECK

A useful checklist to test your keys before using the API.

```php
$Client->Contact->check();
```

Response:

```json
{
    "res": true,
    "version": "1.1",
    "data": {
        "id": 50,
        "nom": "test_nom",
        "prenom": "test_prenom",
        "email": "test@email.com",
        "mobile": "+33666666666",
        ...
    }
}
```

### List The Contacts of a Group

In order to list all the contacts of a group, you must specify the id group.
The query limit is 10 000 contacts

```php
$Client->Contact->fetch($groupId, $from = 0);
```

Response:

```json
{
    "res": true,
    "version": "1.1",
    "data": [
        {
            "id": 128,
            "fnamn": "first name",
            "enamn": "last name",
            "epost": "user@domain.com",
            "mob": "0033612345678",
            "adress1": "postal address",
            "birthday": "1990-01-01",
            "created_at": "2016-02-11 12:10:11",
            ...
        },
        ...
    ]
}
```
<!-- $Client->Contact->search(int $id)
$Client->Contact->create(int $groupId, array $data)
$Client->Contact->modify(int $id, array $data = [])
$Client->Contact->delete(int $id)
 -->
 
 [![ghit.me](https://ghit.me/badge.svg?repo=marketingcible/mylittlebiz-php)](https://ghit.me/repo/marketingcible/mylittlebiz-php)
