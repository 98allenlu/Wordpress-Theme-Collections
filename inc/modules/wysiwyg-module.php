<div class="wrapper bottom <?php echo $module->custom_container_classes; ?>">

  <div class="container-fluid">

    <div class="row">

      <div class="col-lg-12 content-area">

        <?php
        if($module->title) { ?>

          <h3 class="title"><?php echo apply_filters('the_title', wp_kses_post($module->title)); ?></h3>

        <?php } ?>

        <?php echo apply_filters('the_content', $module->wysiwyg); ?>

      </div>

    </div>

  </div>

</div>
