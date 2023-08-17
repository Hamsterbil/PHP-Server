<h2>Membership Information</h2>
<table>
    <tr>
        <th>Full Name</th>
        <th>Salutation</th>
        <th>Age</th>
        <th>Email</th>
        <th>Phone Number</th>
    </tr>    
    <?php       
        $query = "SELECT m.full_name, s.salutation, m.age, m.email, m.phone_number
        FROM membership m
        JOIN salutation s ON m.salutation_id = s.salutation_id";

        $result = executeQuery($conn, $query);
        // Insert data as table rows if no error
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['full_name']}</td>";
            echo "<td>{$row['salutation']}</td>";
            echo "<td>{$row['age']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['phone_number']}</td>";
            echo "</tr>";
        }        
    ?>
</table>