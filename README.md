# Integrated Member Card Requests
Set member card requests to be added to a database table in MyTCG instead of being emailed for every. single. request.

## Features
- Instead of sending an email for each member card request, MyTCG will add to `$table_mcs` the new requests.
- You can choose to send the member their member card and delete their request by selecting "complete".

## Requirements
- MyTCG

## Installation
1. Add `$table_mcs = 'table name';` to `mytcg/settings.php`. Change `table name` to the name of the table. Mine, for example, is `mcs`, so it looks like `$table_mcs = 'mcs';`.
2. Upload the updated settings file, along with the contents of this hack, to the appropriate directories.
3. Run `mytcg/create_mcs.php` to create the database. If you do not run into errors, move on to #4. If you *do* run into errors, make sure you've completed #1 accordingly *and* uploaded the updated settings file.
4. 
