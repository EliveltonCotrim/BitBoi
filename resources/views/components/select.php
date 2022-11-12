<div>
    <select name="<?php echo $name ?>" id="" class="form-control" <?php echo (isset($required)  && $required == 'true') ? 'required' : ''; ?>>
        <option value="">Selecione!</option>
        <?php foreach ($options as $k => $option) {
        ?>
            <option value="<?php echo $k ?>" <?php echo isset($selected) && $k == $selected ? 'selected' : '' ?>>
                <?php echo $option  ?>
            </option>
        <?php
        }
        ?>
    </select>
</div>