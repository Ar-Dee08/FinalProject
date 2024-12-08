<?php
// Include necessary files
include 'includes/header.php'; // Common header
require '../vscode/dbcon.php'; // Database connection

// Fetch all active news records
$query = "SELECT post_id, title, caption, post_img, post_url, date_webposted FROM news_update WHERE record_status = 'Active' ORDER BY date_webposted DESC";
$result = $con->query($query);

?>

    <div class="customer-container">
        <h1 style="font-family: 'Inter', sans-serif; font-weight: bold; color: black;">News & Updates</h1><hr>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="news-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="news-item">
                        <div>
                        <h2><?= htmlspecialchars($row['title']); ?></h2>
                        <p class="date"><?= htmlspecialchars(date("F j, Y", strtotime($row['date_webposted']))); ?></p>
                        </div>
                        <div class="news-details">
                        <?php if (!empty($row['post_img'])): ?>
                            <div class="news-image">
                                <img src="../adminside/record_images/post_images/<?= htmlspecialchars($row['post_img']); ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                            </div>
                        <?php endif; ?>
                            <div>
                        <p><?= htmlspecialchars($row['caption']); ?></p>

                        <?php if (!empty($row['post_url'])): ?>
                            <a href="<?= htmlspecialchars($row['post_url']); ?>" target="_blank" class="btn btn-primary" style="color: black; text-decoration: underline;">
                                Read More
                            </a>
                            <style>
                                .btn-primary:hover {
                                    background-color: #1E4A50;
                                }
                            </style>
                            </div>
                            </div>
                            <hr>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No news and updates available at the moment.</p>
        <?php endif; ?>

        <div class="back-link">
            <a href="index.php" class="btn btn-secondary" style="background-color: #458D9E; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <?php include 'includes/footer.php'; ?>
</footer>
</html>
