# PHP Clone MySQL DB Script

PHP script that will clone Database from 1 server to another server. Useful for soft redandancy database.

### Requirement
1. PHP 7.0+
2. MySQL 5.0+

### Usage
1. Edit config.ini to match with master and slave members.
	- item "tables", if you need to clone all tables, fill with *. if need specify table, put table name separated with comma.

2. Run script with cli.
	 `php clone.php`
