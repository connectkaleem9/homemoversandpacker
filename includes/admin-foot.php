<?php
/** Closes the markup opened by includes/admin-layout.php. */
declare(strict_types=1);
?>
  </div>
</main>

<footer class="admin-foot">
  <p>Signed in as <strong><?= e(admin_username()) ?></strong> · <?= e(date('j M Y, H:i')) ?></p>
</footer>

</body>
</html>
