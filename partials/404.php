<?php 
ob_start();
$title = '404';
http_response_code(404);
?>

<div class="quatre">
    <h1 class="quatre">404 non trouvé</h1>
</div>

<?php
require_once __DIR__.'/footer.php';
exit; 
?>
