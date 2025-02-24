<?php

echo "
    <form action='./actions/nests.php' method='POST'>
    ";

echo "<div class='text-center mt-3'>";
if ($row['pokemon_id'] == "0") {
	echo "<font style='font-size:24px;'>".i8ln("ALL")."</font><br>";
} else {
	$PkmnImg = "$imgUrl/pokemon_icon_" . str_pad($row['pokemon_id'], 3, "0", STR_PAD_LEFT) . "_" . str_pad($row['form'], 2, "0", STR_PAD_LEFT) . ".png";
	echo "<img width=100 src='".$PkmnImg."'><br>";
	echo "<center><font size=5>".i8ln(get_mons($row['pokemon_id']))."</font></center>";
}
echo "</div>";

?>

<div class="modal-body">

    <?php

        echo "
        <input type='hidden' id='type' name='type' value='nests'>
        <input type='hidden' id='uid' name='uid' value='" . $row['uid'] . "'>
        ";
        ?>

    <?php if (@$disable_location <> "True") { ?>
    <div class="form-row align-items-center">
        <div class="col-sm-12 my-1">
            <?php
            if ( $row['distance'] == 0 ) {
               $area_check="checked";
               $distance_check="";
               $style="style='display:none;'";
            } else {
               $area_check="";
               $distance_check="checked";
               $style="";
            }
            ?>
            <div class="input-group">
                <div class="btn-group btn-group-toggle ml-1" data-toggle="buttons" style="width:100%;">
                <label class="btn btn-secondary">
		    <input type="radio" name="use_areas_nest" id="use_areas_<?php echo $nest_unique_id; ?>" value="areas" <?php echo $area_check; ?> 
                    onclick="areas('<?php echo $nest_unique_id; ?>')">
                    <?php echo i8ln("Use Areas"); ?>
                </label>
                <label class="btn btn-secondary mr-2">
		    <input type="radio" name="use_areas_nest" id="use_areas_<?php echo $nest_unique_id; ?>" value="distance" <?php echo $distance_check; ?> 
                    onclick="areas('<?php echo $nest_unique_id; ?>')">
                    <?php echo i8ln("Set Distance"); ?>
                </label>
                </div>
            </div>
            <div class="input-group mt-2">
                <input type="number" id='distance_<?php echo $nest_unique_id; ?>' name='distance' value='<?php echo $row['distance'] ?>' <?php echo $style; ?>
                    min='0' class="form-control text-center">
                <div class="input-group-append" id="distance_label_<?php echo $nest_unique_id; ?>" <?php echo $style; ?>>
                    <span class="input-group-text"><?php echo i8ln("meters"); ?></span>
                </div>
	    </div>
        </div>
    </div>
    <?php } else { ?>
        <input type="hidden" id='distance' name='distance' value='<?php echo $row['distance'] ?>' min='0'>
    <?php } ?>

    <hr>

    <div class="form-row align-items-center">
        <div class="col-sm-12 my-1">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo i8ln("Spawns/Hour"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                </div>
                <input type='number' id='min_spawns' name='min_spawns' size=1 value='<?php echo $row['min_spawn_avg'] ?>'
                    min='0' max='100' class="form-control text-center">
                <div class="input-group-append">
                    <div class="input-group-text"><?php echo i8ln("MIN"); ?></div>
                </div>
            </div>
        </div>
    </div>



    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <div class="input-group">
            <div class="input-group-prepend">
		<div class="input-group-text"><?php echo i8ln("Clean"); ?></div>
            </div>
        </div>
        <?php
                if ($row['clean'] == 0) {
                        $checked0 = 'checked';
                } else {
                        $checked0 = '';
                }
                if ($row['clean'] == 1) {
                        $checked1 = 'checked';
                } else {
                        $checked1 = '';
                }
                ?>
        <label class="btn btn-secondary">
	    <input type="radio" name="clean" id="clean_0" value="clean_0" <?php echo $checked0; ?>> <?php echo i8ln("No"); ?>
        </label>
        <label class="btn btn-secondary">
	    <input type="radio" name="clean" id="clean_1" value="clean_1" <?php echo $checked1; ?>> <?php echo i8ln("Yes"); ?>
        </label>
    </div>

    <?php if (isset($allowed_templates["nests"])) {
        echo '<div class="form-row align-items-center">
            <div class="col-sm-12 my-1">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Template</div>
                            </div>
                        </div>';
                        foreach ( $allowed_templates["nests"] as $key => $name ) {
                            echo '<label class="btn btn-secondary">';
                            echo '<input type="radio" name="template" id="' . $key . '" value="' . $key . '" ' . (($key == $row['template']) ? 'checked' : '') . '>';
                            echo $name . '</label>';
                        }
                echo '</div>
            </div>
        </div>';
     } ?>
</div>
<div class="modal-footer">
    <!--
    <button class="btn btn-danger" type="submit" name='delete' value='Delete'>
        <span class="icon text-white-50">
            <i class="fas fa-trash"></i>
        </span>
    </button>
    -->
    <input class="btn btn-primary" type='submit' name='update' value='<?php echo i8ln("Update"); ?>'>
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo i8ln("Cancel"); ?></button>
</div>

</form>
