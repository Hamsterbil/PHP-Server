<h2 id="tableTitle">Movies</h2>
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
            echo
            "<tr>
             <td>{$row['title']}</td>
             <td>{$row['release_year']}</td>
             <td>{$row['genre']}</td>
             <td>\${$row['rental_price']}</td>
             </tr>";
        }    
    ?>
</table>
