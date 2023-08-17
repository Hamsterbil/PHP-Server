<h2>Movies</h2>
<table>
    <tr>
        <th>Title</th>
        <th>Release Year</th>
        <th>Genre</th>
        <th>Rental Price</th>
    </tr>
    <?php      
        $query = "SELECT * FROM movies";

        $result = executeQuery($conn, $query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['release_year']}</td>";
            echo "<td>{$row['genre']}</td>";
            echo "<td>\${$row['rental_price']}</td>";
            echo "</tr>";
        }    
    ?>
</table>
