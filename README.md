## Deploy using docker

<b>Docker image </b> : [romeoz/docker-apache-php:7.3](https://github.com/romeOz/docker-apache-php)


#### Dockerfile

- run as app : <b>Dockerfile.bak</b>
- for development : <b> Dockerfile </b>

##### Docker buid

```
docker build -t whiterabbit .

```

##### Deploy as app
```
docker run -d --name=whiterabbit -p 8080:80 whiterabbit
```


##### Deploy on local (mount by volume)
```
docker run -d --name=whiterabbit -v=<path-to-your-app>:/var/www/app 8080:80 whiterabbit

```


#### GENERAL ACTIVITES

- Run Database Migration & Seeders
- Copy contents of .env.sample to .env and update IMAP configuration, with the username and password.
- Currently supports only one account


```
array (
  'data' => 
  array (
    0 => 
    array (
      'type' => 'articles',
      'id' => '1',
      'attributes' => 
      array (
        'title' => 'JSON:API paints my bikeshed!',
        'body' => 'The shortest article. Ever.',
        'created' => '2015-05-22T14:56:29.000Z',
        'updated' => '2015-05-22T14:56:28.000Z',
      ),
      'relationships' => 
      array (
        'author' => 
        array (
          'data' => 
          array (
            'id' => '42',
            'type' => 'people',
          ),
        ),
      ),
    ),
  ),
  'included' => 
  array (
    0 => 
    array (
      'type' => 'people',
      'id' => '42',
      'attributes' => 
      array (
        'name' => 'John',
        'age' => 80,
        'gender' => 'male',
      ),
    ),
  ),
)

```
