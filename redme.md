Installation Guide
Step 1: Clone the Project
Execute the following command to clone the project:

git clone https://github.com/Teko13/blog.git

Step 2: Install Dependencies
Install the project dependencies by running the following command:

composer install

Step 3: Configure Environment Variables
Rename the file "env" to ".env".
Open the ".env" file and replace placeholders like "xxxx" with your actual information. For example:

# DB_DSN = "mysql:host=xxxx;port=xxxx;dbname=my_blog;charset=utf8"
=> DB_DSN="mysql:host=localhost;port=3306;dbname=my_blog;charset=utf8"
or
# DB_USER = "xxxx"
=> DB_USER="root"
...
Make sure to uncomment all lines. The lines starting with "DB" are related to the database configuration and are crucial for the application.

Step 4: Configure Mail Server (Optional)
If you don't plan on using the mail functionality, you can skip this step. Otherwise, update the mail server configurations in the ".env" file.

Step 5: Start MySQL Server
Ensure your MySQL server is up and running.

Step 6: Create Database Schema
Before running the migration, make sure you have created a database schema named "mon_blog"

Step 7: Run Database Migration
Navigate to the project root directory and execute the migration script using the following command:

php migration.php

You will be prompted to create an administrator password. Use this password to log in to the site and access the administration panel. The administrator's email address will also be provided. Once the script execution is complete, you can open the site in a browser using the chosen host and port. Log in with the administrator's credentials.
