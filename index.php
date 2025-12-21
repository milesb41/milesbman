<?php
// Configuration
$zipFile = 'assets/data.zip'; // Path to your zip file
$extractTo = 'assets/extracted_files/'; // Where files will be put

if (file_exists($zipFile)) {
    $zip = new ZipArchive;
    if ($zip->open($zipFile) === TRUE) {
        // Create folder if it doesn't exist
        if (!is_dir($extractTo)) {
            mkdir($extractTo, 0755, true);
        }
        
        // Extract files
        $zip->extractTo($extractTo);
        $zip->close();
        $message = "Files extracted successfully!";
    } else {
        $message = "Failed to open zip file.";
    }
} else {
    $message = "Zip file not found in assets folder.";
}

// Get list of extracted files to display
$files = is_dir($extractTo) ? array_diff(scandir($extractTo), array('.', '..')) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zip Extractor Display</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .file-list { border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
        .status { color: green; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Extracted Assets</h1>
    <p class="status"><?php echo $message; ?></p>

    <div class="file-list">
        <h3>Files found in zip:</h3>
        <ul>
            <?php foreach ($files as $file): ?>
                <li><?php echo htmlspecialchars($file); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

</body>
</html>