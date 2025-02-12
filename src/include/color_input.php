<li class="list-group-item">
    <label for="<?=$setting?>_<?=$theme_name?>" class="form-label">
        <?=$setting_formal?>:
    </label>
    <div class="d-flex flex-row justify-content-start gap-3 align-items-center">
        <input
            type="color" class="form-control form-control-color"
            id="<?=$setting?>_<?=$theme_name?>" name="<?=$setting?>_<?=$theme_name?>"
            aria-describedby="<?=$group?>_help_<?=$theme_name?>"
            value="<?=clean_hex_color($setting_value)?>"
            onchange="document.getElementById(this.id + '_value').innerHTML = `= ${this.value}`"
        >
        <i id="<?=$setting?>_<?=$theme_name?>_value">= <?=clean_hex_color($setting_value)?></i>
    </div>
</li>