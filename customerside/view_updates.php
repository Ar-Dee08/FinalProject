<?php
// Include necessary files
include 'includes/header.php'; // Common header
require '../vscode/dbcon.php'; // Database connection

// Fetch all active news records
$query = "SELECT post_id, title, caption, post_img, post_url, date_webposted FROM news_update WHERE record_status = 'Active' ORDER BY date_webposted DESC";
$result = $con->query($query);

?>

    <div class="customer-container">
        <h1 style="font-family: 'Inter', sans-serif; font-weight: bold; color: black; text-align:center;">News & Updates</h1><hr>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="news-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="news-item">
                        <div>
                        <h2 style="font-family: 'Inter', sans-serif; font-weight: bold; color: black;"><?= htmlspecialchars($row['title']); ?></h2>
                        <p class="date"><?= htmlspecialchars(date("F j, Y", strtotime($row['date_webposted']))); ?></p>
                        </div>
                        <div class="news-details">
                        <?php if (!empty($row['post_img'])): ?>
                            <div class="news-image">
                                <img src="../adminside/record_images/post_images/<?= htmlspecialchars($row['post_img']); ?>" alt="<?= htmlspecialchars($row['title']); ?>" class="responsive-img">
                            </div>
                        <?php endif; ?>
                            <div>
                        <p><?= htmlspecialchars($row['caption']); ?></p>

                        <?php if (!empty($row['post_url'])): ?>
                            <a href="<?= htmlspecialchars($row['post_url']); ?>" target="_blank" class="btn btn-primary" style="color: black; text-decoration: underline; margin-left: 10px;">
                                Read More
                            </a>
                            <style>
                                .btn-primary:hover {
                                    background-color: #1E4A50;
                                }
                                .responsive-img {
                                    width: 70%;
                                    max-width: 100%;
                                    height: auto;
                                }
                                .customer-container {
                                    width: 70%;
                                    padding: 50px 15px;
                                    background-color: #CEDFE3;
                                    padding: 30px;    
                                    border-radius: 5px;
                                    max-width: 95%;
                                    margin: 3% auto;    
                                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                                    font-family: 'Inter', sans-serif;
                                    transition: transform 0.3s ease, box-shadow 0.3s ease;
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
            <a href="homecustomer.php" class="btn btn-secondary" style="background-color: #458D9E; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <?php include 'includes/footer.php'; ?>
</footer>
</html>
