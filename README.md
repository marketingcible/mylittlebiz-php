# mylittlebiz-php

## Installation

You can install **mylittlebiz-php** via composer or by downloading the source.

## Quickstart

### List All Your Contacts

```php
// List the contacts of a group using mylittlebiz's REST API and PHP
<?php
$api_key = "ACXXXXXX"; // Your Account Key from http://marketingcible.mylittlebiz.fr/account
$api_secret = "YYYYYY"; // Your API Secret from http://marketingcible.mylittlebiz.fr/account

$Client = new Client($api_key, $api_secret);
$Client->Contact->fetch($groupId = 0);

```