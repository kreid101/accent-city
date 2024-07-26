### Шаг 1

Выполнить команду ```composer install ```

### Шаг 2

Создать файл .env от example.env и прописать данные для бд

### Шаг 3

Выполнить команду ```php artisan key:generate```

### Шаг 4

Выполнить команду ```php artisan migrate```

### Шаг 5

Выполнить команду ```php artisan app:fetch-cities``` и дождаться сообщения об успешном добавление городов в бд.

### Шаг 6

Запустить http сервер и проверить работу.

## Api

### Удаление

Для удаление города используеться post запрос на адрес "/api/remove",
в тело запроса передается json с ключом "city" где значение нужный нам город.

#### Example:

``` 
{
    "city":"Москва"
}
```

### Добавление

Для добавления города используеться post запрос на адрес "/api/add",
в тело запроса передается json с ключом "city" где значение нужный нам город.

#### Example:

``` 
{
    "city":"Москва"
}
```
