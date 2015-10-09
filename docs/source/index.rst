.. PSI - Php Simplified Iterations documentation master file, created by
   sphinx-quickstart on Fri Oct  9 08:00:20 2015.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

.. role:: php(code)
    :language: php

Welcome to PSI - Php Simplified Iterations's documentation!
===========================================================

PSI aims at helping you to write better and more stable PHP-Code. Especially when it comes to iterating, filter,
sorting.

Introduction
------------

Let's start with an example.

.. code-block:: php

   $input = $service->getStuff();

   $result = Psi::it($input)
      ->filter(new IsInstanceOf(Person::class))
      ->filter(function (Person $p) { return $p->getAge() >= 18; })
      ->collect();

The example above will filter the input and will only keep instances of *Person* that have an age of at least 18 years.


Contents
--------

.. toctree::
   :maxdepth: 2



Indices and tables
==================

* :ref:`genindex`
* :ref:`modindex`
* :ref:`search`

