# Generic Json Api with Slim Framework

The **Generic Json Api with Slim Framework** is for allowing an example api to work with database. You just need to provide the database and it is ready to go. All the request to api will respond with a json

## Requirements

* Slim Framework 3.0+
* PHP 5.2.8+

## Installation

Download the files and move to your root folder and paste it there,

### After successfull steps above, Please follow the following:

* Open in config/auth.php and add the users who can access the api in the code below
	```
	<?php
	$app->add(new \Slim\Middleware\HttpBasicAuthentication([
	    "path" => "/api", /* or ["/admin", "/api"] */
	    "realm" => "Protected",
	    "users" => [
	        "root" => "root",
	        "user2" => "password2"
	    ]
	]));
	?>
	```
* Open config/dbconnect and add your database credentials, just replace the following
	```
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "test";
	?>
	```

**Thats all your script has been installed, yay :)**

You can access the API if you have user config/auth.php.

### Usage

* All the code is defined in index.php, to fetch all results please call the api on 
	```
	http://yourdomain.com/api-folder/api/database-table-name

	```

* Please read index.php as all the functions are well commented there with easy understading.

## Test

* To test please modify and run test/index.php

## Author

Developed by [Hassnain Abass](https://www.linkedin.com/in/hussnain-abass-b041b578/) - Senior Web Developer and [Freelancer](https://www.freelancer.com/u/Hussnain0163.html)

## Contributing

This repository follows the [PHP Standards](https://php.net). If you'd like to contribute new features, enhancements or bug fixes to the plugin, please feel free to pull or report/open issues.

## License

Copyright 2017-2020 [Hassnain Abass](https://www.linkedin.com/in/hussnain-abass-b041b578/). All rights reserved.

Licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) License. Redistributions of the source code included in this repository must retain the copyright notice found in each file.

**Goodluck And Happy Coding.**