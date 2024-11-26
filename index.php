<?php

require_once('./includes/config.php');
require_once('./includes/functions.php');
require_once('./includes/header.php');

$page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
$page = ($page !== false && $page > 0) ? $page : 1;

try {
    $quotes = getQuotesForPage($page);
    if (empty($quotes)) {
        throw new Exception('No quotes found for this page.');
    }

    $totalPages = getTotalPages();
    if ($totalPages < 1) {
        throw new Exception('No pages available.');
    }

} catch (Exception $e) {
    error_log($e->getMessage());
    // Prepare a error message to display to the user
    $errorMessage = 'An error occurred while fetching quotes. Please try again later.';

    // Show a more specific message based on the exception type (if needed)
    if ($e->getMessage() === 'No quotes found for this page.') {
        $errorMessage = 'There are no quotes available for the selected page. Please try another page.';
    } elseif ($e->getMessage() === 'No pages available.') {
        $errorMessage = 'No pages are available at the moment. Please try again later.';
    }

        // Display a user-friendly error message with an option to try again later
    echo '<div class="container" style="margin-top: 80px;">
        <p class="notification is-danger">' . htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') . '</p>
        </div>';
    require_once('./includes/footer.php');
    exit;
}
?>

<?php foreach ($quotes as $quote): ?>
    <div id="quotes-container" class="quotes-container">
        <div class="quote-box">
            <p class="content quote-text"><?php echo nl2br(escapeHtml($quote['content'])); ?></p>
            <hr>
                <a href="k/<?php echo urlencode(escapeHtml($quote['slug'])); ?>" class="button is-rounded is-danger read-more">
                   மேலும் வாசிக்க
                </a>
        </div>
    </div>
<?php endforeach; ?>

<div class="pagination-container" style="margin-bottom: 50px;">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>" class="pagination-button">Previous</a>
    <?php endif; ?>
    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page + 1; ?>" class="pagination-button">Next</a>
    <?php endif; ?>
</div>

<?php require_once('./includes/footer.php'); ?>
