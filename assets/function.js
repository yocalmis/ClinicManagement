
$.fn.stickynav = function ( options ){


	var 
	nav       = $(this),
	navHeight = nav.height(),
	windowN   = $(window);

	function scrollEvent() {

		var scrollTop = windowN.scrollTop();

		if (scrollTop == 0) {
			nav.removeClass('sticky');
		}

		if (scrollTop > navHeight) {

			setTimeout( function(){
				nav.addClass('sticky');
			});

		}
		else {

			nav.removeClass('sticky');

		}
	};
	scrollEvent();

	windowN.scroll(function() {
		scrollEvent();
	});
}


$( document ).ready(function() {

	var 
	pageURL     = $(location).attr('href'),
	linkURL     = $( "a[href='"+ pageURL +"']" );

	linkURL.addClass('sidenav__link--active').parents('.mine-trigger').addClass('mine-trigger-open mine-trigger-page').each(function() {

		var
		howmuchchildrens  = $(this).children('.mine-content').children('.mine-content__link').length,
		calcPixels      = (howmuchchildrens * 48) + 'px';
		$(this).children('.mine-content').siblings('.sidenav__link').addClass('sidenav__link--active');
		$(this).children('.mine-content').children('.sidenav__link--active').addClass('bcgNone');
		$(this).children('.mine-content').css('max-height', calcPixels);

	});

	var activeImageName = $('.sidenav__link--active').children('.sidenav__icon').css('background-image');
	$('.sidenav__link--active').children('.sidenav__icon').css({
		'background-image': 'none',
		'-webkit-mask': activeImageName + 'no-repeat 50% 50%',
		'mask': activeImageName + 'no-repeat 50% 50%',
		'background-color': 'var(--hover-color)'
	});


  /*if((window.location.href.indexOf("read") > -1) || (window.location.href.indexOf("edit") > -1)) {
    $('body').addClass('editPage');
    $('.iframeModal__backdrop, .iframeModal__close').on('click', function() {
      location.reload();
    });
 }*/


 /*$('.edit_button').addClass('editIframeTrigger');*/

 $('.iframeTrigger, .editIframeTrigger').on('click', function(e) {
 	e.preventDefault();
 	var 
 	iframeId  = $(this).attr('href'),
 	thisText  = $(this).text();

 	$('.iframeModal__backdrop').addClass('iframeModal__backdrop--active');
 	$('.iframeModal').addClass('iframModalActive');
 	if ($(this).hasClass('calculator')){
 		$('.iframeModal').addClass('calculatorIframe');
 	}
 	if ($(this).hasClass('editIframeTrigger')){
 		$('.iframeModal').addClass('editIframe');
 	}
 	$('.iframeModal__heading').text(thisText);


 	$('.iframeModal__iframe').attr('src', iframeId);

 });
 $('.iframeModal__backdrop, .iframeModal__close').on('click', function() {

 	if ($('.iframModalActive').hasClass('editIframe')){
 		location.reload();
 	}

 	$('.iframeModal').removeClass('iframModalActive');
 	if ($('.iframeModal').hasClass('calculatorIframe')){
 		$('.iframeModal').removeClass('calculatorIframe');
 	}
 	$('.iframeModal__heading').text('');
 	$('.iframeModal__iframe').attr('src', '');
 	$('.iframeModal__backdrop').removeClass('iframeModal__backdrop--active');
 });


 var winW = $(window).width();
 $('.s-n_h').height($('.side-header').height());
 $('.side-nav, .side-header, .y-n_r_i').addClass('noselect');
 $('.side-nav, .side-header, .y-n_r_i').find('i').addClass('material-icons');
 $('.side-header > h3').html($('.form-title-left > a').text());
 $('.form-title-left').hide()
 $('.form-title').hide();
 $('.o_s-n').click(function(){
 	$('.side-nav').addClass('side-nav-open');
 	$('.s-n_o').addClass('s-n_o_o');
 }); 
 $('.s-n_o').click(function(){
 	$('.side-nav').removeClass('side-nav-open');
 	$('.s-n_o').removeClass('s-n_o_o');
 });
 $('.side-header').stickynav();
 $('.m_s_msg').SumoSelect({
 	selectAll: true,
 	locale: ['Ok', 'Kapat', 'Hepsini Seç']
 });


	$('.mine-trigger').click(function(e){

		var 
		control_click		= $(this).hasClass('mine-trigger-open'),
		from_link			= control_click && $(e.target).closest('.mine-content__link').length == 1;
		howmuchchildrens	= $(this).children('.mine-content').children('.mine-content__link').length,
		calcPixels			= (howmuchchildrens * 48) + 'px';

		if (!control_click){
			$(this).addClass('mine-trigger-open');
			$(this).children('.mine-content').css('max-height', calcPixels);
		} else if (control_click  && !from_link) {
			$(this).removeClass('mine-trigger-open');
			$(this).children('.mine-content').css('max-height', 0);
		}
	});



 $('.y_r_y_b').click(function() {
 	setTimeout(function(){
 		window.location.reload();
 	});
 });


 if ( (winW < 768) && ($('.side-header > h3').width() > 300) ) {
 	$('.s-h_r').hide();
 }


 if (window.matchMedia('(min-width: 991px)').matches){
 	$('.side-nav').addClass('side-nav-open');
 }
 if (window.matchMedia('(max-width: 991px)').matches) {
 	$('.side-nav').removeClass('side-nav-open');
 }

 $('.y_r_m').on('mouseover', function(){

 	$(this).addClass('clickable');

 	$(this).not('.y_r_m > a').click(function() {

 		$(this).children('a').hide();
 		$(this).children('img').addClass('fullWH');
 		$('.s-n_o').addClass('s-n_o_o').css({
 			'cursor': 'zoom-out',
 			'cursor': '-webkit-zoom-out',
 			'background': 'rgba(0,0,0,.85)'
 		});
 		$('body').css('overflow', 'hidden');

 		$('.s-n_o_o').click(function() {

 			$('.y_r_m').children('a').show();
 			$('.fullWH').removeClass('fullWH');
 			$('.s-n_o').css({
 				'cursor': '',
 				'background': '',
 			}).removeClass('s-n_o_o');
 			$('body').css('overflow', 'auto');

 		});

 	});
 }).on('mouseout', function() {
 	$(this).removeClass('clickable');
 });






 $('.user-menu').click(function() {
 	var 
 	checkClick = $('.user-menu__trigger').hasClass('user-menu__trigger--active');

 	if (checkClick) {
 		$('.user-menu__trigger').removeClass('user-menu__trigger--active');
 		$('.user-menu__inner').removeClass('user-menu__inner--active');
 	}
 	else {
 		$('.user-menu__trigger').addClass('user-menu__trigger--active');
 		$('.user-menu__inner').addClass('user-menu__inner--active');
 	}


 });









 var a = document.getElementById("field-baslangic_saati");
 var b = document.getElementById("field-bitis_saati");

 if ( (a) || (b) ){
 	a.type="time";
 	b.type="time";

 }


});

$(window).resize(function(){
	if (window.matchMedia('(min-width: 991px)').matches)
	{
		$('.side-nav').addClass('side-nav-open');
	}
	if (window.matchMedia('(max-width: 991px)').matches) {
		$('.side-nav').removeClass('side-nav-open');
	}
});
$(document).mouseup(function(e) {
	var my_inner = $('.user-menu');

	if (!my_inner.is(e.target) && my_inner.has(e.target).length === 0) {
		$('.user-menu__trigger').removeClass('user-menu__trigger--active');
		$('.user-menu__inner').removeClass('user-menu__inner--active');
	}
});