<!DOCTYPE html>
<html>
<head>
    <title>MyProject - Bookmark For Your Projects</title>
</head>
<body>
    <h1>MyProject - Bookmark For Your Projects</h1>

    <form method="post" action="">
        <label for="title">Project Title:</label>
        <input type="text" name="title" id="title" required>
        <br><br>
        <label for="link">Project Link:</label>
        <input type="url" name="link" id="link" required>
        <br><br>
        <label for="note">Notes:</label>
        <input type="text" name="note" id="note">
        <br><br>
        <label for="importance">Importance Level:</label>
        <select name="importance" id="importance">
            <option value="very_important">Very Important</option>
            <option value="important">Important</option>
            <option value="not_too_important">Not Too Important</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Save">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $link = $_POST['link'];
        $note = $_POST['note'];
        $importance = $_POST['importance'];
        $date = date('Y-m-d H:i:s');

        // Save link, title, notes, importance level, and date to a text file
        $data = "Date: $date\nTitle: $title\n$link\nNotes: $note\nImportance Level: $importance\n\n";
        file_put_contents("projects.txt", $data, FILE_APPEND);

        echo "<p>Project successfully saved.</p>";
    }

    // Display list of saved projects
    if (file_exists("projects.txt")) {
        echo "<h2>List of Projects:</h2>";
        $projects = file("projects.txt");
        $project_count = count($projects);
        
        if ($project_count > 0) {
            echo "<ul>";
            for ($i = 0; $i < $project_count; $i += 6) {
                $date = trim($projects[$i]);
                $title = trim($projects[$i + 1]);
                $link = trim($projects[$i + 2]);
                $note = trim($projects[$i + 3]);
                $importance = trim($projects[$i + 4]);
                
                echo "<li>";
                echo "<strong>$title</strong><br>";
                echo "<a href='$link' target='_blank'>Open</a><br>";
                echo "$note<br>";
                echo "$importance<br>";
                echo "$date<br>";
                echo "</li>";
            }
            echo "</ul>";
        }
    }
    ?>
</body>
</html>
