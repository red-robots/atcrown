<style>
  .emaillist-textarea {
    width: 100%;
    height: 300px;
  }
</style>
<?php
$q = new WP_Query([
  'post_type' => 'atc10k_email',
  'nopaging' => true,
]);
$emails = array_map(function($item) { return $item->post_title; } , $q->posts);
?>
<h1>Newsletter Signup - Email List</h1>
<p>These are all of the emails that have been entered on the website to receive emails</p>
<textarea class="emaillist-textarea"><?= implode(', ', $emails) ?></textarea>
