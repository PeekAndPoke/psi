[![Code Coverage](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/build.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/build-status/master)

# Introduction

PSI helps you to write cleaner and more stable PHP-Code. Especially when it comes to iterating, filtering, mapping,
sorting arrays or array-like data.

PSI consists of multiple small operations that can be combined and chained. Doing so results in easier to read and more expressive code.

# TOC

- [Examples](#examples)
- [Details Docs](#detailed-documentation)
- [UnitTests](#unittests)
- [Releases](#releases)
- [Todos and ideas](#todos-and-ideas)

## Examples

Let's have a look at some examples.


### Get all adults 

```php
$input = $service->getStuff();

/** @var Person[] $result */
$result = Psi::it($input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->toArray();
```

In plain PHP this might looks like:

```php
$ipnut = $service->getStuff();

$result = [];

foreach ($input as $item) {
  
  if ($item instanceof Person && $item->getAge() >= 18) {
    $result[] = $item
  }
}
 
```

### Get all adults and sort them by age

```php
$input = $service->getStuff();

/** @var Person[] $result */
$result = Psi::it($input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->sortBy(function (Person $p) { return $p->getAge(); })
  ->toArray();
```

In plain PHP this might looks like:

```php
$ipnut = $service->getStuff();

$result = [];

foreach ($input as $item) {
  
  if ($item instanceof Person && $item->getAge() >= 18) {
    $result[] = $item
  }
}

usort($result, function (Person $p1, Person $p2) {
 
  return $p1->getAge() <=> $p2->getAge(); 
}); 
```

### Get all adults and sort them by age descending

```php
$input = $service->getStuff();

/** @var Person[] $result */
$result = Psi::it($input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->sortBy(function (Person $p) { return $p->getName(); })
  ->reverse()
  ->toArray();
```

### 2. Advanced filtering

With *Psi::filterBy()* you can combine mapping and filtering. 

Let's get all adults by checking the age using Psi\IsGreaterThanOrEqual(). 

The example below will also give you all Persons with an age greater than or equal to 18.
 
```php
$input = $service->getStuff();

/** @var Person[] $result */
$result = Psi::it($input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filterBy(
    function (Person $p) { return $p->getAge(); }, // map the input
    new Psi\IsGreaterThanOrEqual(18)               // apply filter on the mapped value
  )
  ->toArray();
```

### 3. Check if all or any elements match

With *Psi::all()* you can check if all elements match the given condition 

```php
$result = Psi::it([1, 1, 1])
    ->all(new Psi\IsEqualTo(1));  // true, all elements are equal to 1

$result = Psi::it([1, 1, 1])
    ->all(function ($it) { return $it === 1 });  // true, all elements are equal to 1

$result = Psi::it([1, 2, 3])
    ->all(new Psi\IsEqualTo(1));  // false, not all elements are equal to 1

$result = Psi::it([])
    ->all(new Psi\IsEqualTo(1));  // true, since no element does not match the condition
```

With *Psi::any()* you can check if there is at least one element matching the condition

```php
$result = Psi::it([2, 1, 4])
    ->any(new Psi\IsEqualTo(1));  // true, there is on elements that is equal to 1

$result = Psi::it([2, 1, 4])
    ->any(function ($it) { return $it === 1 });  // true, there is on elements that is equal to 1

$result = Psi::it([2, 3, 4])
    ->any(new Psi\IsEqualTo(1));  // false, there is no element that is equal to 1

$result = Psi::it([])
    ->any(new Psi\IsEqualTo(1));  // false, when there is no element in the list, then none can match
```


### 4. Grouping

Let's group all persons by their age

```php
$input = $service->getStuff();

/** @var Person[] $result */
$result = Psi::it($input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->groupBy(
    function (Person $p) { return $p->getAge(); },   // define the group
  )
  ->toKeyValueArray();                               // toKeyValueArray() will preserve keys, in our case the age-groups

var_dump($result);
```
This might output:

```
array(3) {
  [7] =>
  array(2) { 
    [0] =>
    object(Person) ...
    [1] =>
    object(Person) ...
  }
  [15] =>
  array(1) {
    [0] =>
    object(Person) ...
    ...
  }
  [21] =>
  array (2) {
    ...
  }
  ...  
}
```


### 5. Multiple inputs

You can pass multiple array or array-like parameters to Psi::it(... $inputs) 

```php
/** @var Person[] $result */
$result = Psi::it(
    $service->getStuff(),
    $service->getMoreStuff(),
    $service->getEvenMoreStuff()    
  )
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->toArray();
```

### 6. Skip and Limit

Let's get up to 5 adults but skip the first 10:

```php
$input = $service->getStuff();

/** @var Person[] $result */
$result = Psi::it($input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->skip(10)
  ->limit(5)
  ->toArray();
```

Or let's skip the first 10 no matter what they are and then get up to 5 adults

```php
$input = $service->getStuff();

/** @var Person[] $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->skip(10)
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->limit(5)
  ->toArray();
```

Or let's skip the first 10, then get up to 5 and then filter the adults out of these

```php
$input = $service->getStuff();

/** @var Person[] $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->skip(10)
  ->limit(5)
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->toArray();
```

### 7. Count, sum, min, max, average, median

Let's count the number of adults:

```php
$input = $service->getStuff();

/** @var float $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->count();
```

Let's sum the age of all persons:

```php
$input = $service->getStuff();

/** @var float $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->map(function (Person $p) { return $p->getAge(); })
  ->sum();
```

Let's get the youngest age of all people we know:

```php
$input = $service->getStuff();

/** @var float $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->map(function (Person $p) { return $p->getAge(); })
  ->min();
```

Let's get the oldest age of all:

```php
$input = $service->getStuff();

/** @var float $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->map(function (Person $p) { return $p->getAge(); })
  ->max();
```

Let's get the average age:

```php
$input = $service->getStuff();

/** @var float $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->map(function (Person $p) { return $p->getAge(); })
  ->avg();
```

Let's get the median age:

```php
$input = $service->getStuff();

/** @var float $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->map(function (Person $p) { return $p->getAge(); })
  ->median();
```

Let's get the median age of all adults:

```php
$input = $service->getStuff();

/** @var float $result */
$result = Psi::it($input)  
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->map(function (Person $p) { return $p->getAge(); })
  ->median();
```

### 8. Get first, last, random

Let's get the first person that fits a certain condition (name starting with "A")

```php
/** @var Person|null $result */
$result = Psi::it(input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filterBy(
    function(function (Person $p) { return $p->getName(); }),
    new Psi\Str\IsStartingWith('A')
  )
  ->getFirst()
    
```

Let's get the last person that fits a certain condition (name starting with "A")

```php
/** @var Person|null $result */
$result = Psi::it(input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filterBy(
    function(function (Person $p) { return $p->getName(); }),
    new Psi\Str\IsStartingWith('A')
  )
  ->getLast()
    
```

Let's get a random person that fits a certain condition (name starting with "A")

```php
/** @var Person|null $result */
$result = Psi::it(input)
  ->filter(new Psi\IsInstanceOf(Person::class))
  ->filterBy(
    function(function (Person $p) { return $p->getName(); }),
    new Psi\Str\IsStartingWith('A')
  )
  ->getRandom()
    
```


# Detailed Documentation

## Filters - type checks

### IsArray and IsNotArray

Filters for Arrays using is_array()

```php
$result = Psi::it($input)->filter(new Psi\IsArray())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotArray())->toArray();
```

### IsBool and IsNotBool

Filter for Booleans using is_bool()

```php
$result = Psi::it($input)->filter(new Psi\IsBool())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotBool())->toArray();
```

### IsCallable and IsNotCallable

Filter for Callables using is_callable()

```php
$result = Psi::it($input)->filter(new Psi\IsCallable())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotCallable())->toArray();
```

### IsDateString and IsNotDateString

Checks if the given string is a string that would be understood be new \DateTime($str)

```php
$result = Psi::it($input)->filter(new Psi\IsDateString())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotDateString())->toArray();
```

### IsEmpty and IsNotEmpty

Filter for empty things using empty()

```php
$result = Psi::it($input)->filter(new Psi\IsEmpty())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotEmpty())->toArray();
```

### IsInstanceOf and IsNotInstanceOf

Filter for class instance

```php
$result = Psi::it($input)->filter(new Psi\IsInstanceOf())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotInstanceOf())->toArray();
```

### IsInteger and IsNotInteger

Filter for integers using is_int()

```php
$result = Psi::it($input)->filter(new Psi\IsInteger())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotInteger())->toArray();
```

### IsIntegerString and IsNotIntegerString

Filter for strings that contain an integer

```php
$result = Psi::it($input)->filter(new Psi\IsIntegerString())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotIntegerString())->toArray();
```

### IsNull and IsNotNull

Filter for nulls

```php
$result = Psi::it($input)->filter(new Psi\IsNull())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotNull())->toArray();
```

### IsNumeric and IsNotNumeric

Filter for numeric values using is_numeric()

```php
$result = Psi::it($input)->filter(new Psi\IsNull())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotNull())->toArray();
```

### IsObject and IsNotObject

Filter for objects

```php
$result = Psi::it($input)->filter(new Psi\IsObject())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotObject())->toArray();
```

### IsResource and IsNotResource

Filter for resources

```php
$result = Psi::it($input)->filter(new Psi\IsResource())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotResource())->toArray();
```

### IsScalar and IsNotScalar

Filter for scalar values using is_scalar()

```php
$result = Psi::it($input)->filter(new Psi\IsResource())->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotResource())->toArray();
```

## Filter - comparison


### IsEqualTo and IsNotEqualTo

Filter for NON type safe eqaulity (==). See IsSame / IsNotSame for === comparison

```php
$result = Psi::it($input)->filter(new Psi\IsEqualTo("Summer"))->toArray();

$result = Psi::it($input)->filter(new Psi\IsNotEqualTo("Winter"))->toArray();
```

# UnitTests

First install all dependencies

```bash
./composer install
```

Then run all tests

```bash
vendor/bin/phpunit
```


# Releases

## new in v1.2.0

*REMOVED PHP 5.6 SUPPORT*

Added 
- Psi::all()
- Psi::any()


## new in v1.1.0

Moved mapper ToFloat, ToInteger, ToString to Psi\Map\...

Old versions are kept for compatibility and marked as deprecated.

## new in v0.6.4

### Psi::chunk

Will split the stream into chunks of the given size.

```php
Psi::it(range(0, 10))
  ->chunk(3)
  ->toArray();
```

will result in

``` 
[
  [0, 1, 2], 
  [3, 4, 5], 
  [6, 7, 8], 
  [9, 10]
]
```

### Psi::skip

Skips the first n elements in the current stream

```php
Psi::it(range(0, 20))
  ->filter(new IsMultipleOf(2))
  ->skip(5)
  ->toArray();
```

will result in 

``` 
[10, 12, 14, 16, 18, 20]
```

### Psi::limit

Limits the result to the first n element in the current stream

```php
Psi::it(range(0, 20))
  ->filter(new IsMultipleOf(2))
  ->limit(5)
  ->toArray();
```

will result in 

``` 
[0, 2, 4, 6, 8]
```


### Psi::takeWhile

Take all elements of the input stream while the condition is met

```php
Psi::it(range(0, 20))
  ->takeWhile(new Psi\IsLessThan(5))
  ->toArray();
```

will result in

``` 
[0, 1, 2, 3, 4]
```


### Psi::takeUntil

Take all elements of the input stream until the condition is met

```php
Psi::it(range(0, 20))
  ->takeUntil(new Psi\IsGreaterThan(5))
  ->toArray();
``` 

will result in

``` 
[0, 1, 2, 3, 4, 5]
```

### Psi::getLast

Get the last element of the stream.

```php
Psi::it([1, 2, 3])
  ->filter(function ($i) { return $i < 3; })
  ->getLast()
```

will result in

```php
2
```

### Psi::getRandom

Will select a random element from the stream.

```php
Psi::it([1, 2, 3])
  ->filter(function ($i) { return $i < 3; })
  ->getRandom()
```

will result in

```
1 or 2
```

### Num::IsMultipleOf and Num::IsNotMultipleOf

Filters all numbers that are a multiple of the given factor

```php
Psi::it([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
  ->filter(new Psi\Num\IsMultipleOf(3))
  ->toArray();
```

will result in

```
[0, 3, 6, 9] 
```

### Num::IsPrime and Num::IsNotPrime

Filters all number that are prime number.

CAUTION: do not use this impl for big numbers, a it can be very slow.

```php
Psi::it(range(0, 30))
    ->filter(new Psi\Num\IsPrime())
    ->toArray();
```

will result in

``` 
[2, 3, 5, 7, 11, 13, 17, 19, 23, 29]
```

## new in v0.6.3

### Psi::filterBy()

In order to by able to use all other matchers on nested property / values of input objects, the 
method Psi::filterBy() was added

```php
$result = Psi::it($persons)
  ->filterBy(
    function (Person $p) { return $p->getAge(); },
    new IsLessThan(18)
  )
  ->toArray()
``` 

### Psi::uniqueBy 

Finds unique elements by first passing them through a mapper.

```php
$result = Psi::it($persons)
  ->uniqueBy(
    function (Person $p) { return $person->getName(); }
  )
  ->toArray();
```

### ToFloat

Maps inputs to floats.

```php
$result = Psi::it($values)
  ->map(new Psi\ToFloat())
  ->toArray();
```

### ToInteger

Maps inputs to integers.

```php
$result = Psi::it($values)
  ->map(new Psi\ToInteger())
  ->toArray();
```

### ToString

Maps inputs to strings.

```php
$result = Psi::it($values)
  ->map(new Psi\ToString())
  ->toArray();
```

### Str::IsStartingWith and Str::IsNotStartingWith - with or with case

Filters all strings starting with the given needle. By default case-sensitive. 
Pass false as the second parameter to be non-case-sensitive.

```php
$result = Psi::it($values)
  ->filter(new Psi\Str\IsStartingWith('a'))
  ->toArray();

$result = Psi::it($values)
  ->filter(new Psi\Str\IsNotStartingWith('a', false))
  ->toArray();
```

### Str::IsEndingWith and Str::IsNotEndingWith - with or without case

Filters all strings ending with the given needle. By default case-sensitive. 
Pass false as the second parameter to be non-case-sensitive.

```php
$result = Psi::it($values)
  ->filter(new Psi\Str\IsEndingWith('a'))
  ->toArray();

$result = Psi::it($values)
  ->filter(new Psi\Str\IsNotEndingWith('a', false))
  ->toArray();
```

### Str::IsContaining and Str::IsNotContaining - with or without case

Filters all strings containing the given needle. By default case-sensitive. 
Pass false as the second parameter to be non-case-sensitive.

```php
$result = Psi::it($values)
  ->filter(new Psi\Str\IsContaining('a'))
  ->toArray();

$result = Psi::it($values)
  ->filter(new Psi\Str\IsNotContaining('a', false))
  ->toArray();
```

### Str::IsMatchingRegex and Str::IsNotMatchingRegex

Filters all strings containing the given needle. By default case-sensitive. 
Pass false as the second parameter to be non-case-sensitive.

```php
$result = Psi::it($values)
  ->filter(new Psi\Str\IsMatchingRegex('/[0-9]{2,}'))
  ->toArray();

$result = Psi::it($values)
  ->filter(new Psi\Str\IsNotMatchingRegex('/ABC/i'))
  ->toArray();
```


### Str::WithoutAccents

Modifies a string by replacing special characters with the "normal" form, e.g.

```
Dragoş  ->  Dragos

Ärmel   ->  Aermel
Blüte   ->  Bluete
Straße  ->  Strasse

passé   ->  passe
```

```php
$result = Psi::it($values)
  ->map(new Psi\Str\WithoutAccents())
  ->toArray();
```

## new in v0.6.0 to v0.6.2

The internal folder structure was changed:

- public interface live now on the root level
- some over-engineering was removed (some classes removed)
- interface no longer have names like "UnaryFunctionInterface" but "UnaryFunction"

 

## new in v0.5.0

### Psi::groupBy 

```php
Psi::it(
  [ ['name' => 'a', 'val' => 1], ['name' => 'a', 'val' => 2], ['name' => 'b', 'val' => 1] ]
)
->groupBy(
  function ($o) { return $o['name']; }
)
->toArray() 
```
would become 

```php
['a' => [ ['name' => 'a', 'val' => 1], ['name' => 'a', 'val' => 2] ], 'b' => ... ]  
```

### Psi::sortBy 

Sort a list of objects by one of their properties, e.g. sorting persons by their age

```
$result = Psi::it($values)
  ->filterBy(
    function (Person $p) { return $p->getAge(); }
  )
  ->toArray()

```


## Todos and ideas

### HHVM

- things like new \DateTimeZone('+02:00') not possible -> Therefore LocalDate not working on HHVM

### general

- make custom TerminalOperations possible Psi::reduce()

### Unary filter functions for strings

String-Mappers
- Str::Camelize (StrToCamelCase)
- ... camel to dashes (StrToSlug)
- Str::UcFirst, Str::LcFirst
- Str::StrReplace
- Str::StrMbReplace
- Str::StrRegexReplace
- Str::StrMbRegexReplace

... for PHP-Types ... LocalDate::isSameDay
