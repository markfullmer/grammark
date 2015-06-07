Grammark
========
<img src="https://github.com/markfullmer/grammark/blob/master/img/screenshot1.png" align="right" />
> A complete web application for identifying writing problems and offering suggestions.


Requirements
============
To run Grammark, you need to have a browser with Javascript enabled (almost all do by default).

Dependencies
============
- [Foundation](http://foundation.zurb.com/) CSS/JS library (included in this distribution)
- [AngularJS](https://angularjs.org/) (included in this distribution)
- [underscore.js](http://underscorejs.org/) (included in this distribution)

Out-of-Box Installation
=======================
If you just want your own version of Grammark on your server and don't plan to
modify it, head on over to https://github.com/markfullmer/grammark/tree/angular-distribution.
Clone the files, or download the zip into a directory on your server.

You should now have a fully-functional grammark checker!

Developer Installation
======================
1. Clone the master branch of this repository:
```
git clone git@github.com:markfullmer/grammark.git .
```
2. Grammark is built on the [yeoman angular scaffolding](https://github.com/yeoman/generator-angular)
To facilitate easy development, install `yo`, `grunt-cli`, `bower`, `generator-angular` and `generator-karma`:
```
npm install -g grunt-cli bower yo generator-karma generator-angular
```
You can then use the following for local development:
Serve the project locally
```
grunt serve
```
Build the distribution
```
grunt build
```

License
=======
This software is protected under the [GNU General Public License](http://www.gnu.org/licenses/gpl.html)
You may use it, provided that any modifications you make to it are available for
others to use and modify in a similar manner.

Versions
========
Release       | Short Description
------------- | -------------
[Grammark Angular](https://github.com/markfullmer/grammark/tree/angular)  | AngularJS framework-based. Does not require PHP
[Grammark No-SQL](https://github.com/markfullmer/grammark/tree/No-SQL)  | Does not require SQL database to run; data stored in filesystem
[Grammark 3.0](https://github.com/markfullmer/grammark/tree/Version-3)  | [Twig](http://twig.sensiolabs.org/) templating and class-based PHP
[Grammark 2.0](https://github.com/markfullmer/grammark/tree/Version-2)  | [Foundation](http://foundation.zurb.com/)-based CSS with better directory structure and settings files
[Grammark 1.0](https://github.com/markfullmer/grammark/tree/Version-1)  | Custom CSS with flat file structure

