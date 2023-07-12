
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <style>
        <?php include 'static/css/style.css'?>
    </style>
 </head>
 <body>
    <div class="main-container">
    <div class="field">

    <h1>Fictional Florida Clotheline Store</h1>
    <p>Fictional Clothline store website is a fictional store that sells high end clothes and jewelry. It wants to be able to let their employees login and add customers to their mailing list that is usually generated as a CSV file. They would also love to search for the address of their customers using a search interface above the input form.</p>

    <br>
    <p>Now to run the main page of the project in our browser we shall run this URL in the browser: <a href="http://localhost/clothstore/pages/"><b>Click here to open Clothstore</b></a></p>
    <br>
    <b><i>A copy of this project can be found on <a href="https://github.com/tiprock-network">github.com/tiprock-network</a></i></b>

    <br>
    <br>
    <h2>Technologies Utilized in this small project</h2>
    <ul>
    <li>Php</li>
    <li>Xampp as a web server and host for MySQL</li>
    <li>Javascript (for an interactive website and also to send requests to the server), HTML, CSS</li>
    <li>Composer to import necessary dependencies required</li>
    <li>PHPmailer - used to send reset links to emails (the reset links are valid for about 10 minutes)</li>
    </ul>

    <h2>Project by</h2>
    <ul>
    <li>Lincoln Owiti - CS/M/1443/09/21</li>
    <li>Trevor Vuhya - CS/M/1990/09/21</li>
    <li>Moses Sande - CS/M/1209/09/21</li>
    <li>Victor Kimutai - CS/M/0712/09/20</li>
    </ul>

    </div>


    <div class="field"><h2>Instructions</h2></div>

        <div class="field">
        <p>Before we can set up the database, we should make sure that the XAMPP Apache Server and MySQL and Tomcat are turned on in order to provide a local server environment.</p>

        <h3>Setting up the database:</h3>
        <ul>
        <li>First, go to <b>/database</b>.</li>
        <li>Confirm if the <b>floridastore.sql</b> is present.</li>
        <li>After which you will need to go to XAMPP by going to your browser paste the URL: <b>localhost/phpmyadmin</b>.</li>
        </ul>
        <img src="docs-pics/xampp.png" alt="xampp">
        <p>On the dashboard look for import, and import <b><u>floridastore.sql</u></b> as the database.</p>
        <img src="docs-pics/xampp-import.png" alt="xampp-import">
        <p>Hit the <b>Go</b> button below and you are done importing the database.</p>

        <h3>Configuring the config file</h3>
        <p>In order to connect to the database, the HOSTNAME, USER, PASSWORD &amp; DATABASE need to be specified. In this case, since we are using XAMPP then we will add the following parameters as follows respectively: 'localhost', 'root','<i><b><u>add_your_password</u></b></i>', 'floridastore'.</p>
        <p>If your XAMPP MySQL user account does not have a password, leave it blank. Now to do all the explained we navigate as follows, in the directory we follow the path <i><b>/config/config.php</b></i>. Open the file and replace all the values as shown above.</p>
        <img src="docs-pics/configfile.png" alt="config">
        </div>

        <div class="field">
        <h3>Running the project</h3>
        <p>To run the project, make sure the whole folder (clothstore) has been transferred to the folder <b>htdocs</b> located at: <u><i><b>C:\xampp\htdocs</b></i></u></p>
        <p>Now to run the main page of the project in our browser we shall run this URL in the browser: <a href="http://localhost/clothstore/pages/">Click here to open Clothstore</a></p>
        </div>

    

    </div>
 </body>
 </html>
