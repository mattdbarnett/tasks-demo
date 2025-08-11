# DTS Tasks Demo

# Setup
Please note, this project currently only runs on Windows.
1. Ensure you have the following downloaded and setup on your desktop:
		- **WAMP** 
		- **PHP 8.*x*.*x***
		- **Apache 2.4.*xx***
		- **MySQL 9.1.0**
		- **Composer 2.8.10**
		- **Node 22.17.1**
		- **Git**
		- **HeidiSQL**
2. Clone into the "*C:\wamp64\www*" directory project using the following command:
`git clone https://github.com/mattdbarnett/tasks-demo.git`

3. In the project root, run the following commands in the order listed:
    `composer install`
    `npm install`
    `npm run watch`

3. Click on the WAMP icon on your taskbar, hover over "Apache" then click "*httpd-vhosts.conf*". This will open your WAMP virtual hosts. Add the following entry to the end of this file and save:
```
    <VirtualHost *:80>
      ServerName tasksdemo.local
      ServerAlias tasksdemo.local
      DocumentRoot "${INSTALL_DIR}/www/tasks-demo/public"
      <Directory "${INSTALL_DIR}/www/tasks.demo/public/">
        Options +Indexes +Includes +FollowSymLinks +MultiViews
        AllowOverride All
        Require local
      </Directory>
    </VirtualHost>
```
4. Run Notepad as administrator. Open the file named "*hosts*" found in "*C:\Windows\System32\drivers\etc\hosts*". Add the following line to the end of that file and save:
    `127.0.0.1 tasksdemo.local`

5. Setup a localhost database server. Open localhost using HeidiSQL, open the query tab, then drag the file "*init.sql*" from within the project inside the folder named "*database*" to the whitespace below the tabs. When the file has populated the textarea, press the blue "*Execute SQL*" arrow button at the top of the screen.

6. Reopen the WAMP menu from the taskbar and press "*Restart All Services*".

7. Navigate to "*http://tasksdemo.local*" in your browser.

# What I'd Add in the Futre

1. Add custom error message parsing based on what was returned from the failed responses to show in the popup instead of standard messages based on the current process (create, edit, delete, etc.) that currently appear.
2. Add the success/failure popup to the page as an overlay element that disappears over time, rather than the current inline element that you have to close.
3. Add full-edit functionality to the API.
4. Add authentication to the the front-end and API utilising the *tduser10* table already present in the database.
5. Add front-end validation to the edit and create task forms.
6. Currently the program **is** responsive, but I believe the experience on mobile can be further improved.
7. Add more depth and detail to this readme.