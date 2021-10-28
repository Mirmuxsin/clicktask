# Click task: Laravel REST API with Sanctum

## Task:
Задание: написать REST API на LARAVEL

Функции:

1. Регистрация/Авторизация
2. Профиль (данные зарегистрированного пользователя, имя, email, номер телефона)
3. Категории товаров (CRUD)
3. Размещение товара, свойства: user_id, category_id, photo, name, description, price
4. Список товаров
5. Детальный просмотр товара
6. Поиск товаров по ключевым словам
7. Удаление товаров

коллекция запросов postman

## Set to use

1. Clone it ```git clone url```
2. Change the *.env.example* to *.env* and add your database info
3. Run it to correctly upload photos ```php artisan storage:link```
4. Run the webserver on port 8000
```php artisan serve```

## Routes

```
# Public

POST   /api/register
@body: name, email, phone_number, password, password_confirmation

POST   /api/login
@body: email or phone_number, password


# Protected

//////////////////CATEGORY/////////////////////


//get all categories
GET   /api/categories

//view category info
GET   /api/categories/:id

//search categories
GET   /api/categories/search/:name

//get products on this category
GET   /api/categories/:id/products

//store category
POST   /api/categoires
@body: name

//update category
PUT   /api/categories/:id
@body: ?name

//delete category
DELETE  /api/categories/:id


/////////////////PRODUCT///////////////////


//get all products
GET   /api/products

//view product
GET   /api/products/:id

//search products
GET   /api/products/search/:name

//get product category info
GET   /api/products/:id/category

//store product
POST   /api/products
@body: name, description, price, photo, category_id

//update product
PUT   /api/products/:id
@body: ?name, ?description, ?price, ?photo, ?category_id

//delete product
DELETE  /api/products/:id


///////////////////////////

GET     /api/user
POST    /api/logout
```

