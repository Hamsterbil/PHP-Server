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
            echo 
            "<tr>
             <td>{$row['full_name']}</td>
             <td>{$row['salutation']}</td>
             <td>{$row['age']}</td>
             <td>{$row['email']}</td>
             <td>{$row['phone_number']}</td>
             </tr>";
        }        
    ?>
</table>