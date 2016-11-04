owl deployer
====

Deploy script for [owl](https://github.com/owl/owl).

### Description

Deploy [owl](https://github.com/owl/owl) with [deployer](https://deployer.org/).

### Requirement

- PHP 5.4~
- composer

**You need to login deploy server with using ssh forward agent.**

### Usage

First, copy `config.sample.yaml` and edit it.

```shell
cp config.sample.yaml config.yaml
vi config.yaml
```

Next, exec behind command to deploy owl.

```shell
git clone git@https://github.com/owl/owl_deployer.git

# deploy
cd owl_deployer
curl -sS https://getcomposer.org/installer | php
php composer.phar install
php composer.phar deploy
```

### Contribution

Give me the PullRequest :)

### Licence

This software is released under the MIT License, see LICENSE.txt.

## Author

[owl organization](https://github.com/owl)
