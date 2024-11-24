<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contentDet.css">
    <title>Content Details</title>
</head>

<body class="body">
    <div class="card">
        <div class="flex-container">
            <div class="label">
                <strong>Image</strong>
            </div>
            <div class="data image-container">
            <img src="<?php echo !empty($contentDetails->images) && file_exists($contentDetails->images) ? $contentDetails->images : 'images/default-image.png'; ?>" alt="Content Image">

            </div>

            <div class="label">
                <strong>Title</strong>
            </div>
            <div class="data">
                <?php echo $contentDetails->Title; ?>
            </div>

            <div class="label">
                <strong>Summary</strong>
            </div>
            <div class="data">
                <?php echo $contentDetails->Summary; ?>
            </div>

            <div class="label">
                <strong>Description</strong>
            </div>
            <div class="data">
                <?php echo $contentDetails->Descriptions; ?>
            </div>

            <div class="label">
                <strong>Content Type</strong>
            </div>
            <div class="data">
                <?php echo $contentDetails->ContentType; ?>
            </div>
        </div>
    </div>
</body>

</html>
