<?php

session_start();
include('conn.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>



<?php

$num = $_GET["numero"];

$sql =
"SELECT attori.Nome FROM attori
  ORDER BY attori.Nome
  LIMIT $num";


$result = $conn->query($sql);

$count = 0;
        if ($result->num_rows > 0) {
            echo "<h1 class='tit'>ATTORI</h1>";
        echo '<table>';
        echo "<br><br>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
            echo "<td class='$nini'> <ul>";
            $sql2 = "SELECT film.Titolo FROM film
            JOIN recita ON film.CodFilm = recita.CodFilm
            JOIN attori ON recita.CodAttore = attori.CodAttore
            WHERE attori.Nome = '$value'";
            
            $result2 = $conn->query($sql2);
            $numeroRighe = $result2->num_rows;
            if($numeroRighe == 0){
                
                    echo "NESSUN FILM !!!";
                    
                }
                
            while($row2 = mysqli_fetch_assoc($result2)){
                
                
                foreach ($row2 as $value) {
                    
                    echo "<li class\"verde\">" . $value . "</li>";

                }

            }
            echo "</li> </td>";
            echo "<td class='prova' > N FILM : $numeroRighe </td>";

            }
            echo "</tr>";
            $count ++;
        }
        echo '</table><br />';
        
        }else {
            echo "0 results";
          }


?>

<br><br><a href="index.html">
<input type="button" value="TORNA INDIETRO"><br><br>
</a>    
</body>
</html>