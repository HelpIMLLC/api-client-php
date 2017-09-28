# Helpim API. PHP-клиент

## Требования

* PHP версии 5.5+
* PHP-расширение cURL

## Установка через [composer](https://getcomposer.org/)

1. Установить composer в проект:
```bash
curl -sS https://getcomposer.org/installer | php
```

2. Добавить в зависимости пакет:
```bash
php composer.phar require helpim/api-client-php
```

3. Подключить автозагрузку файлов классов:
```php
require 'vendor/autoload.php';
```

## Использование

Каждый запрос должен содержать идентификатор сервиса (customerServiceId), авторизационный токен (token) и набор данных,
представляющий собой массив элементов.

### Допустимые наборы данных

* customers - наполнение справочника клиентов;
* nomenclature - наполнение справочника номенклатуры;
* orders - передача заказов в обработку;
* statuses - наполнение справочника статусов.

### Пример

```php
function sendOrder()
{
    $defaultFields = [
        'customerServiceId' => 123,
        'token' => 'myLongSecureToken'
    ];
    
    $api = new \Helpim\Api\Client\HttpClient($defaultFields);
    
    $newOrder = [
        'id' => 12345,
        'number' => 'ABC12345',
        'name' => 'Иванов Иван',
        'phone' => '+7 999 123 4567'
    ];
    
    try {
        $response = $api->request([
            'orders' => [
                $newOrder
            ]
        ]);
    } catch (\Helpim\Api\Exception\CurlException $e) {
        printf('Error %d: %s', $e->getCode(), $e->getMessage());
        return false;
    }
    
    if (!$response->isSuccessful()) {
        printf('Error %d: %s: %s', $response->getStatusCode(), $response->getError(), $response->getMessage());
        return false;
    }

    return true;
}
```

