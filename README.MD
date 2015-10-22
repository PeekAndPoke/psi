[![Build Status](https://travis-ci.org/PeekAndPoke/psi.svg?branch=master)](https://travis-ci.org/PeekAndPoke/psi)

[![Code Coverage](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/PeekAndPoke/psi/badges/build.png?b=master)](https://scrutinizer-ci.com/g/PeekAndPoke/psi/build-status/master)

[![Dependency Status](https://www.versioneye.com/user/projects/554f4873f7db0d2f070001a0/badge.svg?style=flat)](https://www.versioneye.com/user/projects/554f4873f7db0d2f070001a0)
[![Reference Status](https://www.versioneye.com/php/peekandpoke:psi/reference_badge.svg?style=flat)](https://www.versioneye.com/php/peekandpoke:psi/references)

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

## todo

### HHVM

- thing like new \DateTimeZone('+02:00') not possible -> Therefore LocalDate not working on HHVM

### FullSet manipulations

-> have a look a lodash.js what do they do and how do they call the methods

- Chunk [1,2,3,4] -> [[1,2], [3,4]]
- GroupBy [ ['name' => 'a', 'val' => 1], ['name' => 'a', 'val' => 2], ['name' => 'b', 'val' => 1] ] would become ['a' => [ ['name' => 'a', 'val' => 1], ['name' => 'a', 'val' => 2] ], 'b' => ... ]  


(x) sortBy (function ($i) { return $i->getY(); }
  ( ) ASC / DESC 
( ) uniqueBy (function ($i) { return $i->getY(); }

### Unary filter functions for strings

String-Mappers
- ToLower
- ToUpper
- Camelize
- ... camel to dashes
- UcFirst, LcFirst
- Replace
- RegexReplace

Matchers
- EndsWith
- StartWith
- ContainsString
- Regex


- IsMultipleOf    ... isMultipleOf(3) will give true for 0, 3, 6, ...

### Terminal

(X) getFirst
- getLast
- getRandom



## How to doc

http://www.sitepoint.com/using-sphinx-for-php-project-documentation/
