[![Code Coverage](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/build.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/build-status/master)

# PSI

PSI aims at helping you to write better and more stable PHP-Code. Especially when it comes to iterating, filter,
sorting.

## Example

```php
   
$input = $service->getStuff();

$result = Psi::it($input)
  ->filter(new IsInstanceOf(Person::class))
  ->filter(function (Person $p) { return $p->getAge() >= 18; })
  ->sortBy(function (Person $p) { return $p->getAge(); })
  ->reverse()
  ->collect();

```

The example above will filter the input and will only keep instances of *Person* that have an age of at least 18 years,
sorts them by age descending.

## Go ahead

Find out more and the full documentation at [http://psi.readthedocs.org](http://psi.readthedocs.org)

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

### uniqueBy 

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

(x) groupBy [ ['name' => 'a', 'val' => 1], ['name' => 'a', 'val' => 2], ['name' => 'b', 'val' => 1] ] would become ['a' => [ ['name' => 'a', 'val' => 1], ['name' => 'a', 'val' => 2] ], 'b' => ... ]  

(x) sortBy (function ($i) { return $i->getY(); }
  (x) ASC / DESC -> use reverse 


## Todos

### HHVM

- things like new \DateTimeZone('+02:00') not possible -> Therefore LocalDate not working on HHVM

### FullSet manipulations

-> have a look a lodash.js what do they do and how do they call the methods

( ) Chunk [1,2,3,4] -> [[1,2], [3,4]]

### Unary filter functions for strings

String-Mappers
- Str::Camelize (StrToCamelCase)
- ... camel to dashes (StrToSlug)
- Str::UcFirst, Str::LcFirst
- Str::StrReplace
- Str::StrMbReplace
- Str::StrRegexReplace
- Str::StrMbRegexReplace

Matchers
- Regex

Number matchers
- IsMultipleOf    ... isMultipleOf(3) will give true for 0, 3, 6, ...

### Terminal

(X) getFirst
- getLast
- getRandom

## How to doc

http://www.sitepoint.com/using-sphinx-for-php-project-documentation/
