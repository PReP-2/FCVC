Welcome to the Free CV Creator!

To run the app you need a webserver and a MySQL server connected to the localhost.

Recommended softwares with download link:
	- XAMPP: https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe
	- dbForge (a free account is required): https://www.devart.com/dbforge/mysql/studio/dbforgemysql.exe

XAMPP, dbForge:
	- Install with default settings, but don't start the app when completed.

XAMPP:
	- Locate the root directory of the program (default: C:\xampp).
	- Enter the "htdocs" directory and either put every default content into a new directory or preferably delete them.
	- Copy the "free-cv-creator" directory here.
	- Run the app as Administrator.
	- Start Apache and MySQL.

dbForge:
	- Run the app.
	- Database --> New Connection (with the following settings):
		* Type: TCP/IP
		* Host: localhost
		* Port: 3306
		* User: root
		* Password: //leave it empty
		* Allow saving password: checked
		* Database: //leave it empty
		* Connection Name: localhost
	- Connect

	- Database --> Tasks --> Restore Database (with the following settings):
		* Connection: localhost
		* Database: //leave it empty
		* SQL file name: brows the db file (default: C:\xampp\htdocs\free-cv-creator\02-resources\01-db\freecvcreator.sql)
		* SQL file encoding: //leave it as default
	- Restore

Now you can type 127.0.0.1 in your preferred browser's URL field, enter the free-cv-creator directory and start creating your new CV!

Enjoy! :)