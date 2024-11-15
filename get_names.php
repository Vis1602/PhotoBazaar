<?php
// List of Indian names for demo purposes
$names = [
    "Aarav", "Aakash", "Amit", "Ananya", "Anil", "Arjun", "Ayush", "Bala", "Chandresh", "Deepak",
    "Divya", "Esha", "Farhan", "Gaurav", "Gita", "Harsh", "Ishaan", "Jai", "Kiran", "Laxmi",
    "Manoj", "Neha", "Nikhil", "Om", "Pooja", "Pradeep", "Ravi", "Rajesh", "Shiva", "Shruti",
    "Tanvi", "Vijay", "Yash","Bhavya", "Vishal"
];

$letter = strtoupper($_GET['letter']);
$suggested_names = [];

foreach ($names as $name) {
    if (strpos($name, $letter) === 0) {
        $suggested_names[] = $name;
    }
}

echo json_encode($suggested_names);
?>
