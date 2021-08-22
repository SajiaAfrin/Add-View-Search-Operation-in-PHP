<?php
    // Connect to the Database 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "info";

    // Create a connection
    $link = mysqli_connect($servername, $username, $password, $dbname);
    $conn = mysqli_select_db($link, $dbname);

    // Die if connection was not successful
    if(!$conn){
        die ("Connection Failed Because: ".mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add, View and Search Operation</title>
</head>
<body>
    <div class="container shadow-none p-500 mb-500 bg-light rounded d-flex justify-content-center">
        <form action="" method="post" class="justify-content-around">
            <div class="pt-5">
                <h5>Name: <input type="text" name="username"></h5>
            </div>
            <div class="pt-2">
                <h5>Section: <input type="text" name="section"></h5>
                
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" name="insert" value="Insert" class="btn btn-success m-1">
                <input type="submit" name="display" value="Display" class="btn btn-success m-1">
                <input type="submit" name="search" value="Search" class="btn btn-success m-1">
            </div>
        </form>
    </div>
</body>
</html>

<?php
    // Insert Operation
    if(isset($_POST["insert"])){
        $username = $_POST['username'];
        $section = $_POST['section'];

        if(!empty($username) && (!empty($section))){
            mysqli_query($link, "INSERT INTO t_profile(username, section) VALUES('$_POST[username]','$_POST[section]')");
            echo "<h4 class='text-center'>Record Inserted Successfully</h4>";
    }
}

    // Display Operation
    if(isset($_POST["display"])){
        $res = mysqli_query($link, "SELECT * FROM t_profile");
        echo "<div class='container'>";
            echo "<table class='table text-center table-bordered shadow '>";
                echo "<tr>";
                    echo "<th>"; echo "Name"; echo "</th>";
                    echo "<th>"; echo "Section"; echo "</th>";
                echo "</tr>";
        "</div>";
        
        while($row = mysqli_fetch_array($res)){
            echo "<tr>";
                echo "<td>"; echo $row["username"]; echo "</td>";
                echo "<td>"; echo $row["section"]; echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    // Search Operation
    if(isset($_POST["search"])){
        $res = mysqli_query($link, "SELECT * FROM t_profile WHERE username = '$_POST[username]'");
        echo "<div class='container'>";
            echo "<table class='table table-bordered text-center shadow'>";
                echo "<tr>";
                echo "<th>"; echo "Name"; echo "</th>";
                echo "<th>"; echo "Section"; echo "</th>";
            echo "</tr>";
        "</div>";

        while($row = mysqli_fetch_array($res)){
            echo "<tr>";
                echo "<td>"; echo $row["username"]; echo "</td>";
                echo "<td>"; echo $row["section"]; echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>