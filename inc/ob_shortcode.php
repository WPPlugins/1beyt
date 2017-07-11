<?php
function yek_byet_func() 
{
        global $wpdb;
        $sql="SELECT * FROM poems ORDER BY rand() LIMIT 1";
        $result=$wpdb->get_row($sql);
        
        $Verse1=$result->Verse1;
        $Verse2=$result->Verse2;
        $Des1=$result->Des1;
        ?>
        <p id="yek_byet" style="text-align: center;">
            <?php echo !empty($Verse1)?$Verse1:$default; ?><br />
            <?php echo !empty($Verse2)?$Verse2:$default; ?><br />
            <?php echo !empty($Des1)?$Des1:$default; ?><br />        
        </p>
          
        <?php
}
add_shortcode('yek_beyt','yek_byet_func');