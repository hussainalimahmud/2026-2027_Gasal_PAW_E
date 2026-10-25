<?php
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET'
    && isset($_GET['submit'])) {

    require 'validate.inc';

    validateName($errors, $_GET, 'surname');

    if ($errors) {
        echo '<h1>Invalid, correct the following errors:</h1>';

        foreach ($errors as $field => $error) {
            echo htmlspecialchars($field) . ' '
                . htmlspecialchars($error) . '<br>';
        }

        include 'form_get.inc';
    } else {
        echo 'Form submitted successfully with no errors!';
    }

} else {
    include 'form_get.inc';
}
?>