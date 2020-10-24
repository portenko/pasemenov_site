<?php

/* @var $form_name string */
/* @var $field array */

?>

<div class="form-group">
  <label for="id-<?= $field['name'] ?>"><?= $field['label'] ?></label>
  <textarea type="<?= $field['type'] ?>"
            class="form-control <?= $field['class'] ?>"
            name="<?= $form_name ?>[<?= $field['name'] ?>]"
            id="id-<?= $field['name'] ?>"
            placeholder="<?= $field['placeholder'] ?>"
            rows="3"><?= $field['value'] ?></textarea>
</div>