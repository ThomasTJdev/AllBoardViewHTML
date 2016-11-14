Kanboard Plugin for viewing all boards
======================================

This plugin adds a view for viewing all boards at the same time.

Plugin for https://github.com/fguillot/kanboard

Author
------

- 2016 ThomasTJ (TTJ)
- License MIT

Installation
------------

- Decompress the archive in the `plugins` folder

or

- Create a folder **plugins/AllBoardViewHTML**
- Copy all files under this directory

or

- Clone folder with git

Requirements
------------

* Change the template **Template/allboardviewhtml/show.php** to your columns. Now it is configured to Backlog, Ready, Work in progress and Done.
* Only 4 columns: Check the comments in the top of **Template/allboardviewhtml/show.php** 
* More columns: Check the comments in the top of **Template/allboardviewhtml/show.php** 
* This is only tested with a small project team, please ensure that your user priviliges works as intended in a development environment first.

Changes
-------

* Support for subtasks - will be displayed below task title
* Equal heights for columns - max and min setting available in **Template/allboardviewhtml/show.php**
* CSS styling

Todo
----

- Nothing, waiting for Stinnux pull request [2676](https://github.com/kanboard/kanboard/pull/2676)

HALLO!
------

- This plugin is ONLY for viewing the task. There's no function in moving the task from one column to another.

Tested
------

- Application version: 1.0.34
- PHP version: 5.6.27
- PHP SAPI: apache2handler
- OS version: Linux 4.8.6-1-ARCH
- Database driver: sqlite
- Database version: 3.15.1
