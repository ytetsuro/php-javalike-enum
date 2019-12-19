# This is Java like enum for PHP.

@todo

## Install

```
composer require ytetsuro/php-javalike-enum
```

## Using

create enum.

```php
use JavaLikeEnum\Enum;

final class ItemType{
  use Enum;

  const FOOD = 1;
  const SERVICE = 2;
  const DRINK = 3;
}

assert(ItemType::FOOD() === ItemType::FOOD());

try {
  $a = clone ItemType::FOOD();
} catch (LogicException $e) {
  assert(true);
}

assert(ItemType::values() === [ItemType::FOOD(), ItemType::SERVICE(), ItemType::DRINK()]);
assert('1' === (string) ItemType::FOOD());
```
