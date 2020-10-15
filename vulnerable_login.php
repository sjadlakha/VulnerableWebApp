 <!DOCTYPE html>
 <html>

 <head>
     <title>Grocery Store</title>
     <meta charset="utf-8">
     <style>
         h1 {
             font-size: 4rem;
             color: beige;
             background-color: black;
             text-align: center;
             border-radius: 0.5rem;
         }

         p {
             font-size: 2rem;
         }

         form {
             background-color: grey;
             padding: 1rem;
         }

         form input {
             margin: 2rem;
             padding: 0.5rem;
             font-size: 1.5rem;
             display: block;
             width: 50%;
         }
     </style>
 </head>

 <body>
     <h1>Sahaj's Grocery Store</h1>
     <p>Welcome to the store</p>
     <form action="" method="GET">
         <input type="text" name="id" placeholder="Enter ID">
         <input type="password" name="pswd" placeholder="Enter Password">
         <input type="submit" name="submit" value="Submit">
     </form>
     <?php
        if (isset($_GET['id'])) {
            $host = ""; // Add host
            $db = "store"; // Add database name
            $user = ""; // Add database user name
            $pwd = ""; // Add database user pasword
            $link = new mysqli($host, $user, $pwd, $db);
            if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
            }
            $id = $_GET['id'];
            $pswd = $_GET['pswd'];
            // The following code is vulnerable to SQL injection because the user input is concatenated directly into the query:

            $query = "SELECT * FROM employees WHERE id = '$id' AND password = '$pswd'";
            $results = mysqli_query($link, $query);


            // ISSUES:
            // 1. No Input Validation: 
            // 2. Allows direct injection into the sql query from the input
            // 3. Errors are displayed on the screen to the user

            foreach ($results as $row) {
                echo "<h2>Welcome ";
                echo $row['fname'];
                echo "</h2>";
            }
        }

        ?>

 </body>

 </html>