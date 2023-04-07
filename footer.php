<footer>
<?php if (is_active_sidebar('camnewtheme-footer-widget')): ?>
  <div class="footer-calltoaction text-center">
    <div class="container">
      <div class="row">
          <aside class="camnewtheme-footer-widget">
            <?php dynamic_sidebar('camnewtheme-footer-widget'); ?>
          </aside>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <div class="copyright text-center">
    <p>&copy; Copyright Cameron Morgan.</p>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>