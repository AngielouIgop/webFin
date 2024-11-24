<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
    <link rel="stylesheet" href="css/content.css">
</head>
<body class="body">

<div class="search-container">
        <form action="index.php" method="GET">
            <input type="hidden" name="command" value="searchContent">
            <input type="text" name="keyword" placeholder="Search by Title or Content Type" required>
            <button type="submit">Search</button>
        </form>
</div>

<!-- Centering the grid container for content -->
<div class="grid-container">
    <?php if (!empty($content)): ?>
        <?php foreach ($content as $MyContent): ?>
            <div class="grid-item">
                <h3>
                    <a href="index.php?command=viewcontentdet&id=<?= $MyContent->ID; ?>">
                        <?= htmlspecialchars($MyContent->Title); ?>
                    </a>
                </h3>
                <p><?= htmlspecialchars($MyContent->Summary); ?></p>
                
                <div class="actions">
                    <a href="index.php?command=editContent&ID=<?= $MyContent->ID; ?>">Edit</a> |
                    <a href="index.php?command=deleteRec&ID=<?= $MyContent->ID; ?>" 
                       onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars($MyContent->Title); ?>?')">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No content found for your search.</p>
    <?php endif; ?>
</div>

</body>
</html>
