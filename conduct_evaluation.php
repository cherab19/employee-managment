<?php
include ('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_ID = $_POST['employee_ID'];
    $evaluation_date = $_POST['evaluation_date'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    $sql = "INSERT INTO Performance_Evaluation (employee_ID, evaluation_date, rating, comments) 
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$employee_ID, $evaluation_date, $rating, $comments]);
    echo "<p class='success-message'>Performance evaluation conducted successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conduct Performance Evaluation</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="number"],
        input[type="date"],
        textarea,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical; /* Allow vertical resizing only */
        }

        input[type="submit"] {
            background-color: #28a745; /* Green color */
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .success-message {
            color: green;
            text-align: center;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <h2>Conduct Performance Evaluation</h2>
    <form method="POST" action="">
        <label>Employee ID:</label>
        <input type="number" name="employee_ID" required>
        
        <label>Evaluation Date:</label>
        <input type="date" name="evaluation_date" required>
        
        <label>Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>
        
        <label>Comments:</label>
        <textarea name="comments" required></textarea>
        
        <input type="submit" value="Conduct Evaluation">
    </form>
</body>
</html>