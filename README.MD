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

(x) Psi::filterBy()

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

(x) uniqueBy 

Finds unique elements by first passing them through a mapper.

```php
$result = Psi::it($persons)
  ->uniqueBy(
    function (Person $p) { return $person->getName(); }
  )
  ->toArray();
```

(x) ToFloat

Maps inputs to floats.

```php
$result = Psi::it($values)
  ->map(new Psi\ToFloat())
  ->toArray();
```

(x) ToInteger

Maps inputs to integers.

```php
$result = Psi::it($values)
  ->map(new Psi\ToInteger())
  ->toArray();
```

(x) ToString

Maps inputs to strings.

```php
$result = Psi::it($values)
  ->map(new Psi\ToString())
  ->toArray();
```

(x) Str::StartingWith and Str::NotStartingWith - with or with case

Filters all string starting with the given needle. By default case-sensitive. 
Pass false as the second parameter to be non-case-sensitive.

```php
$result = Psi::it($values)
  ->filter(new Psi\Str\StartingWith('a', false))
  ->toArray();

$result = Psi::it($values)
  ->filter(new Psi\Str\NotStartingWith('a', false))
  ->toArray();
```

(x) Str::EndingWith and Str::NotEndingWith - with or without case

Filters all string ending with the given needle. By default case-sensitive. 
Pass false as the second parameter to be non-case-sensitive.

```php
$result = Psi::it($values)
  ->filter(new Psi\Str\EndingWith('a', false))
  ->toArray();

$result = Psi::it($values)
  ->filter(new Psi\Str\NotEndingWith('a', false))
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

- Str::removeAccents

        $translations = [
            'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y'
        ];

        return strtr($subject, $translations);

Matchers
- ContainsString
- Regex

Number matchers
- IsMultipleOf    ... isMultipleOf(3) will give true for 0, 3, 6, ...

### Terminal

(X) getFirst
- getLast
- getRandom

## How to doc

http://www.sitepoint.com/using-sphinx-for-php-project-documentation/
