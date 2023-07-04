<?php

//Validate main function

function validateData($name, $email, $phone) {
    $errors = array();

    // Validate name
    if (!is_string($name)) {
        $errors[] = "Name must be a string.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid.";
    } else {
        $data = loadData();
        foreach ($data as $row) {
            if ($row['email'] == $email) {
                $errors[] = "Email already exists.";
                break;
            }
        }
    }

    // Validate phone
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (!is_numeric($phone)) {
        $errors[] = "Phone must be a number.";
    }

    return $errors;
}
// function to load data
function loadData() {
    $data = array();

    if (($handle = fopen("data.txt", "r")) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $data[] = array(
                'name' => $row[0],
                'email' => $row[1],
                'phone' => $row[2]
            );
        }
        fclose($handle);
    }

    return $data;
}

// function to save data 
function saveData($data) {
    $handle = fopen("data.txt", "a");
    fputcsv($handle, $data);
    fclose($handle);
}

// Validate input data
$errors = validateData($_POST['name'], $_POST['email'], $_POST['phone']);

if (count($errors) > 0) {
    // Display error messages
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
} else {
    // Save data to file
    $data = array($_POST['name'], $_POST['email'], $_POST['phone']);
    saveData($data);

    // Display success message
    echo "<p>Data has been inserted successfully.</p>";
}

?>
