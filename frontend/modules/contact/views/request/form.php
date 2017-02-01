<?php

use derekisbusy\contact\frontend\widgets\ContactForm;

?>
<div class="contact-request-index">
    <?= ContactForm::widget(['model' => $model]); ?>
</div>
