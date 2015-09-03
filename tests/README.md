# Jyotish Library Unit tests

## How to run the tests

Make sure you have PHPUnit installed and that you installed all composer dependencies (run `composer update` in the repo base directory).

Run PHPUnit in the repo base directory.

```
phpunit
```

You can run tests for specific groups only:

```
phpunit --group=base,ganita
```

You can get a list of available groups via `phpunit --list-groups`.

A single test class could be run like the follwing:

```
phpunit tests/unit/Ganita/MathTest.php
```