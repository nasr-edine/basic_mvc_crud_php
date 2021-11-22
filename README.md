## Crud in php with MVC

I build a CRUD in php mysql with MVC pattern

### Prerequisites

- PHP
- MySQL

### Installation

clone repository locally

```bash
git clone https://github.com/nasr-edine/basic_mvc_crud_php.git
```

Move to the basic_mvc_crud_php root folder:

```bash
cd basic_mvc_crud_php/
```

access to MySQL CLI and don't forget to enter your password:

```bash
mysql mysql -u username -p
```

Create a database

```sql
CREATE DATABASE your_database_name;
```

Make 'your_database_name' the current database

```sql
USE your_database_name;
```

Create a table. In my case, I use a table named user with 4 columns

```sql
CREATE TABLE `user` ( `id` INT NOT NULL AUTO_INCREMENT, `first_name` VARCHAR(255) DEFAULT NULL, `last_name` VARCHAR(255) DEFAULT NULL, `email` VARCHAR(255) DEFAULT NULL, PRIMARY KEY (`id`) );
```

Open config.php file and put your MySQL configuration

```php
class config
{
	function __construct()
	{
		$this->host = "server_name";
		$this->user  = "username";
		$this->pass = "password";
		$this->db = "database_name";
	}
}
```

## Usage

Open your browser and enter the URL below
[http://localhost:8000/](http://localhost:8000/)
