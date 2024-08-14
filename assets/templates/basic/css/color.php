<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here
$secondColor = "#ff8"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}


function checkhexcolor2($secondColor){
    return preg_match('/^#[a-f0-9]{6}$/i', $secondColor);
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor2($secondColor)) {
    $secondColor = "#336699";
}
?>

.cmn--btn{
    background: <?php echo $color ?>;
}

.btn__grp a:nth-of-type(2n) {
    color: <?php echo $color ?>;
    border-color: <?php echo $color ?>;
}

.btn__grp a:nth-of-type(2n):hover{
    background: <?php echo $color ?>;
}

.btn--base, .page-item.active .page-link{
    background: <?php echo $color ?> !important;
}

.page-item.active .page-link {
    
    border-color: <?php echo $color ?> !important;
}

.cmn--btn:not(button):hover {
    color: <?php echo $color ?>;
    border-color: <?php echo $color ?>;
}

.text--base{
    color: <?php echo $color ?> !important;
}

.change-language span, .feature__item-icon{
    color: <?php echo $color ?>;
}

.about__thumb .thumb::before {
    background: <?php echo $color ?>1a;
}

.section__cate::before, .section__cate::after, .feature__item::before, .team__item:hover::after, .cmn--table thead, .post__item .post__date, .faq__item.open .faq__title .right--icon::before, .account__section-wrapper .account__section-content .section__header .section__title::after{
    background-color: <?php echo $color ?>;
}

.video-button::before, .video-button::after{
    background-color: <?php echo $color ?> !important;
}

.section__cate, .about__item .icon, .pricing-feature span{
    color: <?php echo $color ?>;
}

.video-button {
    background: <?php echo $color ?>ba;
}

.feature__item-icon {
    background: <?php echo $color ?>1a;
}

.team__item .team__thumb {
    border: 4px solid <?php echo $color ?>;
}

.team__item:hover .team__thumb {
    box-shadow: 0 0 0 4px <?php echo $color ?>33, 0 0 0 8px <?php echo $color ?>33, 0 0 0 12px <?php echo $color ?>33, 0 0 0 16px <?php echo $color ?>33, 0 0 0 20px <?php echo $color ?>33;
}

.nav--tabs li a.active {
    color: <?php echo $color ?>;
    border-bottom: 2px solid <?php echo $color ?>;
}

.post__item .post__content a {
    background-image: linear-gradient(transparent calc(100% - 2px), <?php echo $color ?> 2px);
}

.post__title a:hover, .ratings, .client__item-body .date, .faq__item.open .faq__title .title, .widget__post .widget__post__content span, .contact-area .contact-content .contact-content-botom .subtitle, .contact-area .contact-content .contact-content-botom .contact-info li .icon, .contact-area .contact-content .contact-content-botom .contact-info li .cont a, .footer-links li::after{
    color: <?php echo $color ?>;
}

.blog-sidebar {
    border: 1px solid <?php echo $color ?>1a;
}

.form--control:focus {
    border-color: <?php echo $color ?>33;
}

.contact-area .form--control{
    border-color: <?php echo $color ?>ff;
}

.form-control:focus {
    border-color: <?php echo $color ?>;
}

.btn--title, .badge--title, .bg--title, .preloader, .pricing-deco{
    background-color: <?php echo $secondColor ?> !important;
}