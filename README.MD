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

## Todos

### HHVM

- things like new \DateTimeZone('+02:00') not possible -> Therefore LocalDate not working on HHVM

### FullSet manipulations

-> have a look a lodash.js what do they do and how do they call the methods

- Chunk [1,2,3,4] -> [[1,2], [3,4]]
(x) GroupBy [ ['name' => 'a', 'val' => 1], ['name' => 'a', 'val' => 2], ['name' => 'b', 'val' => 1] ] would become ['a' => [ ['name' => 'a', 'val' => 1], ['name' => 'a', 'val' => 2] ], 'b' => ... ]  
-> see Psi::group

(x) sortBy (function ($i) { return $i->getY(); }
  (-) ASC / DESC -> use reverse 
( ) uniqueBy (function ($i) { return $i->getY(); }

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
