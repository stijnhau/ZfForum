Zf2Forum
========

# Note
This module is currently under heavy development.[UNDERGOING DATABASE CHANGE]

## Introduction
Forum module for zf2


## Installation

### Using composer (Proposed option)
1. Add `stijnhau/zf2-forum` (version `dev-master`) to requirements
2. Run `update` command on composer
3. enable it in your `application.config.php` file.

### Manually
1. Clone this project into your `./vendor/` directory and enable it in your
   `application.config.php` file.
2. Go to step 1.

4. Add the data/mysql.sql file to your database
5. Insert categories that the forum should have into forum_category.
3. Add topic after loging in and opening a forum category.

### Requires
1. PHP >= 5.3.0
2. ZfcUser >= 1.0.0

## features
1. Create topic.
2. Reply on topic.
3. enable and disable quickreply.
4. Show poster by customvield
5. Click on username top redirect to profile[TODO]
6. edit your own post[TODO]
7. Show posttime as time ago.
8. Quote posts [todo]
9. Block opening forum if not logged in. [BybAuthorize)
10. Multilanguage