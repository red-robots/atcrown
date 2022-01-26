<?php

$template = block_field('content', false);
$body = atc10k_parse_contact_form_reply($template);
?>
<section class="contactform">
  <form method="post">
    <input name="contactform-template" type="hidden" value="<?= htmlentities($template) ?>">
    <div class="contactform__content">
      <?= $body ?>
    </div>
    <footer class="contactform__footer">
      <button type="submit" class="contactform__submit">Send</button>
    </footer>
  </form>
</section>
<script>
function checkContactFormInput(input) {
  const ACTIVE_CLASS = 'contactform__input--active';
  if (input.value) {
    input.classList.add(ACTIVE_CLASS);
  } else {
    input.classList.remove(ACTIVE_CLASS);
  }
}
document.addEventListener('DOMContentLoaded', function(e) {
  var inputs = document.querySelectorAll('.contactform__input--text');
  if (!inputs) {
    return;
  }
  Object.keys(inputs).forEach(function(key) {
    checkContactFormInput(inputs[key]);
  });
});
document.addEventListener('keyup', function(e) {
  if (e.target.classList.contains('contactform__input--text')) {
    checkContactFormInput(e.target);
  }
});
</script>