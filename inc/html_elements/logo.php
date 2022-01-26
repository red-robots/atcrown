<?php
function atc10k_logo($class = '') {
  return sprintf('<a href="%s" class="%s">
    <span class="logo__content">AROUND THE <strong class="logo__strong">CROWN</strong></span>
  </a>',  home_url(), classes(['logo', $class]));
}