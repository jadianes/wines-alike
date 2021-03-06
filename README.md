Winesalike
==========

WinesAlike is a PHP (together with Java for admin tasks) framework for deploying wine affinity websites.

## Model-View-Controller Architecture  
It follows a **Model-View-Controller** architectural style where data models (together with business rules) are separated from information presentation (views) and user interaction (controllers).

- Models: WinesAlike models are represented by PHP5 OO classes in folder /models. They encapsulate many `MySQL` tables and also implement business rules (e.g. suggestion algorithm) as well as user management, session management, and configuration files (i.e. config.php file).

- Views: WinesAlike views are generated using the `Smarty` PHP template engine, and are styled using `html5`+`CSS` thanks to `Boostrap` from Twitter. Additional CSS classes and rules are defined in folder `/css`.

- Controllers: WinesAlike controllers work pretty much like Zend controllers. They are contained in folder /controllers where a front controller parses clean URLs (after passing Apache mod_rewrite rules) and call the appropriate action controller. URLs follow the patter:

http://domain-name/controller/action/key1/value1/key2/value2...

where controller has to be implemented by a class with the same name inside the folder /controllers, and action is a method of this class. Keys and values will be passed as arguments to this method.

## Test cases  
Test cases are based in PHPUnit, and can be found in folder /tests

## API  
The folder /API contains controllers (following a similar schema to html controllers) that return JSON objects for different actions. It can be used as REST services (e.g. in mobile clients).

## INSTALLATION  
The script `install.php` creates all the `MySQL` tables containing the model data. This script uses the configuration parameters defined in `models/config.php`.

Wines-alike uses `Smarty` template engine to render html views. Therefore Smarty has to be installed. The installer also uses `Smarty`. It can be found in http://www.smarty.net.

The framework also depends on jQuery. The version used is included in the folder /js.
