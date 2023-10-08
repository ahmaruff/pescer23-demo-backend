# Books Web API  

Sebuah web API sederhana CRUD buku.

## Get Started

1. clone this repo `git clone https://github.com/ahmaruff/pescer23-demo-backend.git`  
2. run `composer install`  
3. copy `.env-example` to `.env`  
4. set DATABASE configuration in `.env` file
5. run migration `php artisan migrate`
6. run web server `php artisan serve`
7. start cosume API via browser or API Client.

## Routes

| METHOD | PATH | PARAMETER | BODY REQUEST | DESC |
| --- | --- | --- | --- |  --- |
| GET | / | n/a | n/a | return app name, desc, and laravel version |  
| GET | /books | n/a | n/a | return array of books |  
| POST | /books | n/a | title, author, category['fiction', 'non-fiction'], description | create new book record |  
| GET | /books/{id} | id: int | n/a | return single book record |
| PUT  | /books/{id} | id: int | title, author, category['fiction', 'non-fiction'], description | update book record |
| DELETE |  /books/{id} | id: int | n/a | delete book record |
## Response Template

all response should be in json. following [JSend Standard](https://github.com/omniti-labs/jsend).  
The HTTP code will be 400 (Bad Request) for all errors unless stated otherwise.

```json
{
    status : "success|fail|error"
    code : "HTTP_STATUS_CODE"
    message : "custom message"
    data : {
        // data goes here
    }
}
```

## Author

[Ahmad Ma'ruf](https://github.com/ahmaruff)
