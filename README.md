# Firestore SDK for PHP without gRPC for PHP 7.4

[![Current version](https://img.shields.io/packagist/v/morrisalptop/firestore-php.svg)](https://packagist.org/packages/morrislaptop/firestore-php)
[![Build Status](https://img.shields.io/circleci/project/morrislaptop/firestore-php.svg)](https://circleci.com/gh/morrislaptop/firestore-php)

## @todo

- [x] Get
- [x] Set
- [ ] Delete
- [ ] Add
- [ ] Transactions (beginTransaction, commit, rollback)
- [ ] Reference value support
- [ ] Batch Get
- [ ] List Documents
- [ ] Query
- [ ] Order
- [ ] Limit
- [ ] Indexes (create, delete, list, get)

## Installation

* Create as folder named 'package' in app root directory 
* Extract this package in that folder 
* Update autoload in composer 
```
    "autoload": {
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "psr-4": {
            "App\\": "app/",
            "Morrislaptop\\Firestore\\":   "packages/open-source/firestore-php/src",
            "Lcobucci\\JWT\\": "packages/open-source/firestore-php/src/lcobucci/jwt/src/",
	    }
    },
```
## Usage

The library aims to replicate the API signature of [Google's PHP API](https://googlecloudplatform.github.io/google-cloud-php/#/docs/cloud-firestore/v0.11.0/firestore/readme).

Sample usage:

```php

use Morrislaptop\Firestore\Factory;
use Kreait\Firebase\ServiceAccount;

// This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/google-service-account.json');

$firestore = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->createFirestore();

$collection = $firestore->collection('users');
$user = $collection->document('123456');

// Save a document
$user->set(['name' => 'morrislaptop', 'role' => 'developer']);

// Get a document
$snap = $user->snapshot();
echo $snap['name']; // morrislaptop

```
