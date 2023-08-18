<!DOCTYPE html>
<html>
<head>
    <title>MyProject - Simpan Link Proyek</title>
    <style>
        .project {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>MyProject - Simpan Link Proyek</h1>

    <form method="post" action="">
        <label for="judul">Judul Proyek:</label>
        <input type="text" name="judul" id="judul" required>
        <br><br>
        <label for="link">Link Proyek:</label>
        <input type="url" name="link" id="link" required>
        <br><br>
        <input type="submit" name="submit" value="Simpan">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $judul = $_POST['judul'];
        $link = $_POST['link'];

        // Menyimpan link dan judul proyek ke dalam file teks
        $data = "$judul - $link\n";
        file_put_contents("projects.txt", $data, FILE_APPEND);

        echo "<p>Proyek berhasil disimpan.</p>";
    }

    // Menampilkan daftar proyek yang disimpan
    if (file_exists("projects.txt")) {
        echo "<h2>Daftar Proyek:</h2>";
        $projects = file("projects.txt", FILE_IGNORE_NEW_LINES);
        echo "<ul>";
        foreach ($projects as $project) {
            $project_parts = explode(" - ", $project);
            $judul = $project_parts[0];
            $link = $project_parts[1];
            echo "<li class='project'>$judul - <a href='$link' target='_blank'>Buka</a></li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>