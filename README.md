# w6-wp-seo
Seo plugin for Wordpress


## Development

IDE : Visual Studio Code

### Features :

- Wordpress Coding Standards compliance and auto fixing

### Install :

#### Clone project

```bash
$ git clone https://github.com/web6-fr/w6-wp-seo.git
```

#### Open Folder in VS Code

#### Install VS Code plugins :

- phpcs
- phpcbf

#### Install dependencies via composer

```bash
$ composer install
```

#### Tell PHP Code Sniffer where WordPress Coding standards are located

```bash
$ vendor/bin/phpcs --config-set installed_paths ./vendor/wp-coding-standards/wpcs
```

## Todo

- Create a character counter for the fields
