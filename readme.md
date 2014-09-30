Grammark
========
<img src="https://github.com/markfullmer/grammark/blob/master/img/screenshot1.png" align="right" />
A complete web application for identifying writing problems and offering suggestions. 

Requirements
============
To run Grammark, you need to have access to a webserver (or the equivalent on your local computer) with PHP and MySQL installed, and a basic knowledge of how to use them. The download includes installation and configuration instructions. If you are completely new to this, try reading http://www.sitepoint.com/php-amp-mysql-1-installation/ 

Dependencies
============
- Foundation CSS/JS library (automatically included by default via cdnjs.cloudflare.com)

Installation
============
1. Place the files contained in this distribution on a webserver. Navigating to the location (e.g., mysite.com/grammark) will render the site, but without the text processing.
2. Create a new SQL database, with username and password
3. Import the SQL database file zipped here, *grammark_grammar.sql*, into that database
3. Copy *example.settings.php* as a new file, "settings.php".
4. In *settings.php*, enter the username, password, and database name created above. Specifically, replace the uppercase items shown below:
  - $host="HOST"; // usually localhost
  - $username="USER NAME HERE";
  - $password="PASSWORD HERE";
  - $db_name="DATABASE NAME HERE";
  - $email = "EMAIL ADDRESS FOR CONTACT FORM";
 
If you've followed the steps above, going to "mysite.com/grammark" will give you a fully-functioning grammark checker.

License
=======
This software is protected under a GNU General Public License: http://www.gnu.org/licenses/gpl.html
You may use it, provided that any modifications you make to it are available for others to use and modify in a similar manner. 

Versions
========
Release       | Short Description
------------- | -------------
[Grammark 2.0](https://github.com/markfullmer/grammark)  | [Foundation](http://foundation.zurb.com/)-based CSS with better directory structure and settings files
[Grammark 1.0](https://github.com/markfullmer/grammark/tree/Version-1)  | Custom CSS with flat file structure

Analytics
=========
To turn on Google Analytics, copy your tracking code into *js/analyticstracking.php* and uncomment the following line in *index.php*:
```
include_once('js/analyticstracking.php');
```