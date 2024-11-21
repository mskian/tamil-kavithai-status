<?php

require_once('./includes/single.php');

?>

<div id="quotes-container" class="quotes-container" style="margin-top: 120px;">
        <div class="quote-box">
        <button id="copy-button" class="is-small copy-btn" onclick="copyToClipboard()">
        <i class="fas fa-copy"></i>
        </button>
            <p class="content quote-text" id="quote-content"><?php echo nl2br($content); ?></p>
        </div>
            <br />
            <a href="/" class="button is-rounded is-danger read-more">
               🏠
            </a>
</div>

<?php require_once('./includes/footer.php'); ?>