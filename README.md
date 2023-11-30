# Šablona pro administrační (jakýkoliv) panel
Toto je moje šablona která zahrnuje třídu pro připojení se na mysql databázi a lehkej design pro administrační (jakýkoliv) panel.
## Úprava
S úmyslem byla jednoduchost, chci aby tento projekt byl lehce upravitelný pro ty co ví co dělají, nebo aspoň si myslí.
Netřeba se bát ohledně cest ke souborám, v ```index.php``` (routovací skript) je ```$baseURL``` který vede hlavní cestu ke souborám, ať
už lokálně či na serveru kde už máte svůj vlastní ```index.php```, pokud ne ```$baseURL``` buď můžete zahodit nebo nastavit na ```/```.
Stačí se podívat a myslím si že každej pochopí co a jak.
### Hlavička
Hlavičku HTML is můžete změnit ve ```components/head.php```.
### Navigační menu
Pro úpravu navigančího menu najdete ve ```./views/nav.php```. Stačí si zkopírovat a vložit už předepsáne linky s jiným názvem a odkazem.
### Stránky
Stránku si přidtáte zde ```views/název.php```. Nová stránka obsahuje pouze věci co chcete zobrazit a není třeba psát znovu hlavičku 
či ostatní věci.
## Komponenty
Komponenty najedte ve složce ```components```. Tato složka už obsahuje ```db.php``` a ```useful.php``` (to jen obsahuje funkci která převádí jakýkoliv čas na český čas).
## db.php
```db.php``` je třída pro vytvoření spojení s vaší mysql databází. Stačí když si jen uvnitř změníte ```$servername```, ```$dbusername```, ```$dbpassword``` a ```$database``` 
podle vašich potřeb. Třída také obsahuje funkce jako ```executeQuery``` který bere argumenty ```$sql```, ```$params``` a ```$returnResult```.
 ```$sql``` je pochopitelný, to je například ```SELECT * FROM Customers;```. Pokud budete chtít vkládat informace dané uživatelem napište je do ```$params``` jako array ([]) ve správném pořadí!. Pokud nebudete očekávat či potřebovat výsledky z datábaze například při ```INSERT``` nebo ```DELETE```, ```$returnResult``` zapište jako ```false```. Tato třída také obsahuje ```fetchRows``` co bere za arguemtny ```$result```, pokud vaše databáze vrátí nějaký řádky tak je všechny budete mít v array a pokud očekáváte jen jeden řádek z databáze použijte ```fetchSingleRow``` co také bere argument ```$result```. Finální kód by mohl vypadat takto...
```php
if(isset($_GET["smazat"])) {
    $db = new Database();
    $sql = "DELETE FROM contact_forms WHERE id = ?";
    $params = [$_GET["smazat"]]; //ID pro smazání
    if(!$db->executeQuery($sql, $params, false)) {
        echo "Chyba při mazání!";
    } else {
        header("location: ./kontaktniFormular");
    }
}
```
Nebo takto...
```php
    include "../admin/components/useful.php";
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
        echo "<td><a class='button' href='?smazat={$row["ID"]}'>Smazat</a></td>";
        echo "</tr>";
    }
```
