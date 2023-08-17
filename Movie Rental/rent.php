<h2>Rented Movies</h2>
<table>
    <tr>
        <th>Rented Movie</th>
        <th>Full Name</th>
    </tr>
    <?php  
        $query = "SELECT m.title, mem.full_name
                FROM rentals r
                JOIN movies m ON r.movie_id = m.movie_id
                JOIN membership mem ON r.membership_id = mem.membership_id";

        $result = executeQuery($conn, $query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['full_name']}</td>";
            echo "</tr>";
        }    
    ?>
</table>