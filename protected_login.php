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
    <!-- Most instances of SQL injection can be prevented by using PARAMETERIZED QUERIES (also known as PREPARED statements) instead of STRING CONCATENATION within the query. -->
    <?php
    if (isset($_GET['id'])) {
        $host = "localhost";
        $db = "store";
        $user = "root";
        $pwd = "";

        // Adding the entire code in a try catch block
        try {

            // Correctly connecting to the database with error and exception 
            $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);

            // Setting attributes on the database handle.
            // ATTR_ERRMODE: Error Reporting
            // ERRMODE_EXCEPTION : Throw exceptions
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $item = $_GET['id'];
            $pswd = $_GET['pswd'];


            // The prepare method has two alternatives: 
            // 1. Using PDO 
            // 2. Using mysqli (used here)

            // Parameterized query
            $stmt = $conn->prepare("SELECT * FROM employees WHERE id LIKE :id AND password like :pswd");

            $stmt->bindParam(':id', $item);
            $stmt->bindParam(':pswd', $pswd);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


            foreach ($results as $row) {
                echo "<h2>Welcome ";
                echo $row['fname'];
                echo "</h2>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    ?>

</body>

</html>