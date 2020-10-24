<?php

/* @var $form_name string */
/* @var $field array */

?>
<div class="form-group">
    <label for="id-<?= $field['name'] ?>"><?= $field['label'] ?></label>
    <select class="form-control <?= $field['class'] ?>"
            id="id-<?= $field['name'] ?>"
            name="<?= $form_name ?>[<?= $field['name'] ?>]">
        <?php foreach($field['items'] as $item){ ?>
            <option value="<?= $item['value'] ?>" <?= $field['value'] === $item['value'] ? 'selected' : '' ?>>
                <?= $item['label'] ?>
            </option>
        <?php } ?>
    </select>
</div>