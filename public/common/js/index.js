$(function(){
//回到顶部
	$('.contact-top').hide();	
	
	$(window).scroll(function(){
		// console.log($(this).scrollTop());
		
		//当window的scrolltop距离大于1时，go to 
		 if($(this).scrollTop() > 100){
			$('.contact-top').fadeIn();
		}else{
			$('.contact-top').fadeOut();
		}
	});
	
	$('.contact-top').click(function(){
		$('html ,body').animate({scrollTop: 0}, 300);
		return false;
	});

		
});