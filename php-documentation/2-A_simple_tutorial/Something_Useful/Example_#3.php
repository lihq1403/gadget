<?php
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
    ?>
    <h3>strpos() 肯定没有返回假 (FALSE)</h3>
    <p>正在使用 Internet Explorer</p>
    <?php
} else {
    ?>
    <h3>strpos() 肯定返回假 (FALSE)</h3>
    <center><b>没有使用 Internet Explorer</b></center>
    <?php
}
?>