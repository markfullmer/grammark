Grammark
========
<img src="https://github.com/markfullmer/grammark/blob/master/img/screenshot1.png" align="right" />
A complete web application for identifying writing problems and offering suggestions.

Requirements
============
To run Grammark No-SQL version, you need to have access to a webserver (or the equivalent on your
local computer) with PHP installed, and a basic knowledge of how to use it. The download includes installation and configuration instructions. If you are
 completely new to this, try reading http://www.sitepoint.com/php-amp-mysql-1-installation/

Dependencies
============
- [Foundation](http://foundation.zurb.com/) CSS/JS library (automatically
included by default via cdnjs.cloudflare.com)
- [Composer](https://getcomposer.org/) (dependency manager)
- A server running PHP 5.3 or higher

Installation
============
1. Place the files contained in this distribution on a webserver. Navigating to
the location (e.g., mysite.com/grammark) will render the site, but without the
text processing.
2. Copy *example.settings.php* as a new file, "settings.php".
4. In *settings.php*, define your site preferences by replacing what is between the ::
 - define('EMAIL',':your email:'); // for the contact and database suggestion forms
 - define('ANALYTICS',':Google tracking code:'); // place Google Analytics tracking code here
 - define('TESTING_MODE', false); // true runs and displays unit tests

If you've followed the steps above, going to "mysite.com/grammark" will give you
a fully-functioning grammark checker.

License
=======
This software is protected under the [GNU General Public License](http://www.gnu.org/licenses/gpl.html)
You may use it, provided that any modifications you make to it are available for
others to use and modify in a similar manner.

Versions
========
Release       | Short Description
------------- | -------------
[Grammark No-SQL](https://github.com/markfullmer/grammark/tree/No-SQL)  | Does not require SQL database to run; data stored in filesystem
[Grammark 3.0](https://github.com/markfullmer/grammark/tree/Version-3)  | [Twig](http://twig.sensiolabs.org/) templating and class-based PHP
[Grammark 2.0](https://github.com/markfullmer/grammark/tree/Version-2)  | [Foundation](http://foundation.zurb.com/)-based CSS with better directory structure and settings files
[Grammark 1.0](https://github.com/markfullmer/grammark/tree/Version-1)  | Custom CSS with flat file structure

