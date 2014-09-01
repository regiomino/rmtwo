<?php

?>
<div class="wrapper-m">
    <div class="wrapper-m-inner">
        test
    </div>
</div>

<div class= "grid-l">
<?php
$block = module_invoke('rm_cart', 'block_view', 'rm_checkout_block');
    print render($block['content']);
?>
</div>

