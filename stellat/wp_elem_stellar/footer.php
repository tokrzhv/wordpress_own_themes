<?php global $stellaroptions; ?>
</div>
<footer id="footer">
        <section>
            <h2><?php echo $stellaroptions['about-title'];?></h2>
            <p><?php echo $stellaroptions['about-description']?></p>
            <ul class="actions">
                <li><a href="generic.html" class="button">Learn More</a></li>
            </ul>
        </section>
        <section>
            <h2><?php echo $stellaroptions['contact-title']?></h2>
            <dl class="alt">
                <dt>Adress</dt>
                <dd><?php echo $stellaroptions['contact-address']?></dd>
                <dt>Phone</dt>
                <dd><?php echo $stellaroptions['contact-phone']?></dd>
                <dt>Email</dt>
                <dd><a href="#"><?php echo $stellaroptions['contact-email']?></a></dd>
            </dl>
            <ul class="icons">
                <?php foreach ($stellaroptions['social-icon'] as $idx => $arr){
                    if (isset($arr['enabled']) && !empty($arr['enabled'])){?>
                    <li><a href="#" class="icon brands <?php echo $arr['icon']?> alt"><span class="label"><?php echo $arr['name']?></span></a></li>
                    <?php } }?>
            </ul>
        </section>
    </footer>
</div>

<?php wp_footer();?>

    </body>
</html>