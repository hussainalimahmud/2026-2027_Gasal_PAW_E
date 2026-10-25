
<?php
echo "<h3>Posted data:</h3>";

foreach ($_GET as $key => $value) {
    if (is_array($value)) {
        $value = implode(", ", $value);
    }

    echo "(" . htmlspecialchars($key) . ") =&gt; ("
        . htmlspecialchars((string)$value) . ")<br>";
}
?>
