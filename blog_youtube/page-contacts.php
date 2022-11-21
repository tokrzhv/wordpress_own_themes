<?php get_header()?>
<main class="main">
    <section class="contacts">
        <div class="container contacts__container">
            <h1 class="visually-hidden">Contacts</h1>
            <div class="contacts__left">
                <h2 class="contacts__title blog-title">Contacts info</h2>
                <a href="tel:<?php if (!dynamic_sidebar('sidebar-1'));?>" class="phone phone--contacts"><?php if (!dynamic_sidebar('sidebar-1'));?></a>
                <address class="address">Shevchenka Street, City of Kyiv, Ukraine</address>
                <ul class="social list-reset">
                    <li class="social__item"><a href="#" class="social__link social__link--fb" aria-label="fb"></a></li>
                    <li class="social__item"><a href="#" class="social__link social__link--insta" aria-label="inst"></a></li>
                    <li class="social__item"><a href="#" class="social__link social__link--tw" aria-label="tvtr"></a></li>
                </ul>
            </div>
            <div class="contacts__right">
                <div class="contacts-form-wrapper">
                    <h2 class="contacts__title blog-title">Write to us</h2>
                    <form action="<?php echo admin_url('admin-ajax.php?action=callback_mail')?>" class="callback-form">
                        <input type="text" name="name" class="form-input callback-form__input" placeholder="name">
                        <input type="tel" name="tel" class="form-input callback-form__input" placeholder="Phone">
                        <textarea class="form-input callback-form__textarea" name="msg" placeholder="message"></textarea>
                        <button class="callback-form__btn form-btn btn-reset">
                            <span>Send</span>
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                    <path
                                        d="M19.5857 9.85046L1.01474 1.27924C0.719033 1.14496 0.366184 1.22496 0.160475 1.47924C-0.046663 1.73352 -0.0538057 2.09494 0.143332 2.35636L6.25033 10.499L0.143332 18.6417C-0.0538057 18.9031 -0.046663 19.2659 0.159046 19.5188C0.297614 19.6917 0.504752 19.7845 0.714747 19.7845C0.816173 19.7845 0.917599 19.7631 1.01331 19.7188L19.5843 11.1476C19.8386 11.0304 20 10.7776 20 10.499C20 10.2205 19.8386 9.9676 19.5857 9.85046Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer()?>
