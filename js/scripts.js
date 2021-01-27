$(() => {
	// Меню

	 $('.subscribe .submit_btn').on('click',function(event){
        event.preventDefault();     
        var dataForAjax="action=my_action2&";
        var addressForAjax = myajax.url;
        var valid = true;
        
        $(this).closest('form').find('input:not([type=submit]),textarea').each(function(i,elem){
            if(this.value.length<3&&$(this).hasClass('required')){
                valid = false;
                $(this).addClass('notCorrect');             
            }
            if($(this).attr('name')=='email'&&$(this).hasClass('required')){
                var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
                if(!pattern.test($(this).val())){
                    valid = false;
                    $(this).addClass('notCorrect');                 
                }
            }
            if($(this).attr('name')=='agree' && !$(this).prop("checked")){  
                $(this).addClass('notCorrect'); 
                valid = false;
            }

            if(i>0)
            {
                dataForAjax+='&';
            }
            dataForAjax+=this.name+'='+this.value;
        })
        
        if(!valid){
            return false;
        }
        $.ajax({
            type: 'POST',
            data: dataForAjax,
            url: addressForAjax,
            success: function(response) {
                setTimeout(function() {                         
                    $("form").trigger("reset");
                }, 1000);
                $(".subscribe form .exp").html("Спасибо! Вы успешно подписались! Не забудьте подтвердить почту!");
                $("form .line, form .submit").hide();

                               
            }
        });
    });



	$('header .menu_btn').click((e) => {
		e.preventDefault()

		$('header .menu_btn').addClass('active')
		$('body').addClass('menu_open')
		$('#menu').addClass('show')
	})

	$('#menu .close').click((e) => {
		e.preventDefault()

		$('header .menu_btn').removeClass('active')
		$('body').removeClass('menu_open')
		$('#menu').removeClass('show')
	})

	if (is_touch_device()) {
		// Закрытие меню свайпом слево на право
		let ts

		$('body').on('touchstart', (e) => { ts = e.originalEvent.touches[0].clientX })

		$('body').on('touchend', (e) => {
			let te = e.originalEvent.changedTouches[0].clientX

			if ($('body').hasClass('menu_open') && ts > te + 50) {
				// Свайп справо на лево
			} else if (ts < te - 50) {
				// Свайп слева на право
				$('header .menu_btn').removeClass('active')
				$('body').removeClass('menu_open')
				$('#menu').removeClass('show')
			}
		})
	}
})


$(window).on('load', () => {
	// Выравнивание элементов в сетке
	$('.posts .row').each(function(){
		postHeight($(this), parseInt($(this).css('--posts_count')))
	})
})



$(window).resize(() => {
	// Выравнивание элементов в сетке
	$('.posts .row').each(function(){
		postHeight($(this), parseInt($(this).css('--posts_count')))
	})
})



// Выравнивание товаров
function postHeight(context, step){
	let start  = 0,
		finish = step,
		$posts = context.find('.post')

	$posts.find('.name, .desc').height('auto')

	$posts.each(function(){
		setHeight( $posts.slice(start, finish).find('.name') )
		setHeight( $posts.slice(start, finish).find('.desc') )

		start  = start + step
		finish = finish + step
	})
}