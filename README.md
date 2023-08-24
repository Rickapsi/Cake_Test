############################################
Project name: Cake_Test
Date completed: 24.8.23
Time taken: 4 hours
Author: Matt Rickatson
Description: 

Backend: Cakephp 3.0+
Frontend: Jquery Datatables. Bootstrap
Database: MySQL

1. Create a cron/command that will call the following API and save the results in database table. (Note, this api returns over 5000 records, it may crash your browser if you try to open it.)
https://api.adgatemedia.com/v3/offers/?aff=48864&api_key=155efa664a706f295fb446570041d707&wall_code=o6qb

2. Encrypt the data when storing it into the database table. You are free to use any encryption algorithm. Make sure to include the private key in the code repo if you choose to use one.

3. Create a web page that should load the data from the table, decrypt it, and display on the page using Jquery DataTables with the following columns:
name -> string
requirements -> string
description -> string
ecpc -> double
click_url -> anchor tag, onclick should open the link in a new window

4. Enable sorting only for ECPC column.

5. At the top of the page, Add a "Search" box that searches by "name" and use AutuSuggest to the loaded data.
############################################

User guide:

All encryption keys aswell as database information can be found and in the files. 
This is not a secure method but as this is a test project it is fine. 
Otherwise I would use an .env file to secure the keys.

Encryption
key = '88d0a029e9770818280a65dfdfc6c259e542371cf5f423c2b97a0c6078774733'
method = openssl_<encrypt|decrypt>
iv = pk for the tuple

Database:
can be found under config/app_local.php
'username' => 'Rickapsi',
'password' => 'test123',
'database' => 'Cake_Test'

running:

bin/cake migrations migrate : migrates all database setup once database connection is present
bin/cake api_integration : imports data from given API and encrypts into DB
bin/cake server : runs the project on localhost:8765


