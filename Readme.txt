GRAMMARK.ORG
These files are a web-based grammark checking program that lets people customize what they want to look for. It highlights things like passive voice, wordiness, and grammar errors, and offer suggestions when the mouse hovers over the highlighted word/phrase.

GETTING STARTED
1. Unzip the files and upload them to a directory in your website
2. Create an SQL database with user and password
3. Import the SQL database file zipped here, grammark.sql into that database
3. Open "mysql.php" and enter the username, password, and database name created above. Specifically, replaced the bracketed items shown below:
 $username="[USER NAME HERE]";
 $password="[PASSWORD HERE]";
 $db_name="[DATABASE NAME HERE"; 
 
That's it! You're ready to go.

This software is protected under a GNU General Public License: http://www.gnu.org/licenses/gpl.html
You may use it, provided that any modifications you make to it are available for others to use and modify in a similar manner. 