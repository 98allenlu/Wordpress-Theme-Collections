<div class="wrapper bottom lab-stripe <?php echo $module->custom_container_classes; ?> <?php echo ($module->image_side == 'image-left') ? 'image-left' : 'image-right'; ?>">

  <div class="container-fluid">

    <div class="row align-items-center <?php echo ($module->image_side == 'image-left') ? 'flex-lg-row' : 'flex-lg-row-reverse' ?>">

      <div class="col-lg-6 image-area">

        <figure class="stripe-img pr-lg-4"><img src="<?php echo $module->image['url']; ?>"></figure>

      </div>

      <div class="col-lg-6 content-area">

        <h2 class="title"><?php echo $module->title; ?></h2>

        <p><?php echo $module->copy; ?></p>

      </div>

    </div>

  </div>

</div>
