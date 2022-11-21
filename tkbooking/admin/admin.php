<h1 class="tkbooking_title"><?php esc_html_e('Booking Settings', 'tkbooking')?></h1>
<?php settings_errors();?>
<div class="tkbooking_content">
    <form method="post" action="options.php">
        <?php
            settings_fields('booking_settings');
            do_settings_sections('tkbooking_settings');
            submit_button();

        ?>
    </form>
</div>