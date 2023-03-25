# Firestore SDK for PHP without gRPC for PHP 7.4

[![Current version](https://img.shields.io/packagist/v/morrisalptop/firestore-php.svg)](https://packagist.org/packages/morrislaptop/firestore-php)
[![Build Status](https://img.shields.io/circleci/project/morrislaptop/firestore-php.svg)](https://circleci.com/gh/morrislaptop/firestore-php)

## @todo

- [x] Get
- [x] Set
- [x] Delete
- [x] Update
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

* Create a folder named 'package/opensource' in app root directory 
* Extract this package in the "package/opensource" folder 
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
Run `compoaer dump-autoload`
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
Delete content older than 20 hours
```php
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\ServiceAccount;
use Morrislaptop\Firestore\Factory;

        $serviceAccount = ServiceAccount::fromJsonFile( storage_path()  . '/app/google-services.json');
        $firestore = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->createFirestore();


        $documents = $firestore->collection('alerts')->documents(['pageSize' => 100]);

        foreach ($documents as $document) {

                $hourdiff = round((time() - strtotime($document['date']))/36000, 1);

            if( $hourdiff  > 20 ) //everything older than 20 hours will be deleted
            {
                    $document->reference()->delete();
                }

            }
```

Delete by Document id 
```php
            $collection     = $this->firestore->collection('collection_name')->document( (int) $document->id );
            $collection->delete();
```
Update
```php
$this->firestoreServiceAccount = ServiceAccount::fromJsonFile( storage_path()  . '/app/google-services.json');
        $this->firestore = (new Factory)->withServiceAccount($this->firestoreServiceAccount)->createFirestore();

 
            $collection     = $this->firestore->collection('users')->document( (int) $user->id );

            $email                   = $collection->snapshot()->data()['email'];
            $fcm_registration_token  = $collection->snapshot()->data()['fcm_registration_token'];

            $collection->set
            (
                [
                    'fcm_registration_token' => $fcm_registration_token,
                    'email'                 => $email,
                    'alert_notifications'   => $user->alert_notifications,
                ]
            );            

 ```
