# blog
 This is a simple dynamic blog with admin panel for sample purpose and I have used HTML/CSS for frontend &amp; PHP/MYSQL for backend.
I am discussing this topic as per the localhost scenario.

After cloning/downloading it on your laptop/pc, you will find a folder name 'blog'. I have provided a DB file inside the folder named as 'blog.db'.

Use a usbserver/XAMPP or WAMPP to run this project as i have mentioned earlier that it is a PHP file so you will need this local web server to make it work. And also upload the DB file to the local server to display the data.

Inside the blog folder there is a 'includes' folder in which i have placed the db configuration file. Change the configuration as per the requirement. As i am using the usbwebserver, i have changed the configuration as per the local server. See the info given below:

//database credentials

define('DBHOST','localhost'); //Your Local Server Name

define('DBUSER','root'); //Your Local Server Username

define('DBPASS','usbw'); //Your Local Server Password

define('DBNAME','blog'); //Your DB Name


$db = new PDO("mysql:host=".DBHOST.";port=3307;dbname=".DBNAME, DBUSER, DBPASS); //post=3307 -- Your MySql Port Number for Local Server


After changing the configuration, go to your browser and type "http://localhost:8080/blog" to display the website. Remember '8080' is the localhost port no.

For admin, type http://localhost:8080/blog/admin , it will ask for the username and password.

UserName = nikhil

Password = 123

After successful login, you will see the blogs list which are added by the users. Things you can do through admin panel are:
1. Add a new blog
2. Edit or Delete an existing blog
3. Add a new user
4. Edit or delete an existing user
5. Change your password

As this is a sample blog, i have kept it really simple and clean to make the old and new user understand easily. You can add more option as per your requirement.

This is my first time on Git and first project on Git. I hope this project helps you in your near future.

ThankYou and
ENJOYYYYY.....!!!!!
