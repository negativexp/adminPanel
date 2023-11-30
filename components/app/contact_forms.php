<?php
    include "./db.php";
    if(isset($_GET["smazat"])) {
        $db = new Database();
        $sql = "DELETE FROM contact_forms WHERE id = ?";
        $params = [$_GET["smazat"]];
        if(!$db->executeQuery($sql, $params, false)) {
            echo "Chyba při mazání!";
        } else {
            header("location: ./?page=contactForm");
        }
    }
?>
<table>
    <thead>
        <tr>
            <td>Datum přidání</td>
            <td>Jméno</td>
            <td>E-Mail</td>
            <td>Zpráva</td>
            <td>Akce</td>
        </tr>
    </thead>
    <tbody>
        <?php
        include "./useful.php";
        $db = new Database();
        $sql = "select * from contact_forms";
        $rows = $db->fetchRows($db->executeQuery($sql));
        foreach ($rows as $row) {
            $czTime = czechTime($row["date"]);
            echo "<tr>";
            echo "<td>{$czTime}</td>";
            echo "<td>{$row["name"]}</td>";
            echo "<td>{$row["email"]}</td>";
            echo "<td><textarea disabled>{$row["message"]}</textarea></td>";
            echo "<td><a class='button' href='?page=contactForm&smazat={$row["ID"]}'>Smazat</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>