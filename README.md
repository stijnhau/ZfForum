Zf2Forum
========

# Note
This module is currently under heavy development.

## Introduction
Forum module for zf2


## Installation

### Using composer
1. Add `stijnhau/zf2-forum` (version `dev-master`) to requirements
2. Run `update` command on composer
3. enable it in your `application.config.php` file.
4. Add the mysql.sql file to your database
5. Add the rest oif the data folder to your data folder
   
### Manually
1. Clone this project into your `./vendor/` directory and enable it in your
   `application.config.php` file.
2. Add the mysql.sql file to your database
3. Add the rest oif the data folder to your data folder

### Requires

1. PHP >= 5.3.0
2. ZfcUser >= 1.0.0

## features
1. Create topic.
2. Reply on topic.
3. enable and disable quickreply.
4. Show poster bu customvield
5. Click on username top redirect to profile[TODO]
6. edit your own post[TODO]
7. Show posttime as time ago.
8. Quote posts [todo]
9. Block opening forum if not logged in. [BybAuthorize)
10. Multilanguage