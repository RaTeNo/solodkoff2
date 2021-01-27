$(function(){
	// Проверка браузера
	if ( !supportsCssVars() ) {
		$('body').html('<div style="text-align: center; padding: 30px; font-family: Arial, sans-serif;">Ваш браузер устарел рекомендуем обновить его до последней версии<br> или использовать другой более современный</div>')
	}


	// Ленивая загрузка
	setTimeout(function(){
		observer = lozad('.lozad', {
			rootMargin: '200px 0px',
			threshold: 0,
			loaded: function(el) {
				el.classList.add('loaded')
			}
		})

		observer.observe()
	}, 200)


	// Анимированное появление страницы
	$('body').addClass('show')


	// Установка ширины стандартного скроллбара
	$(':root').css('--scroll_width', widthScroll())


	// Кнопка 'Вверх'
	$('body').on('click', '.buttonUp a', function(e) {
		e.preventDefault()

		$('body, html').stop(false, false).animate({
			scrollTop: 0
		}, 1000)
	})


	// Фокус при клике на название поля
	$('body').on('click', '.form .label', function() {
    	$(this).closest('.line').find('.input, textarea').focus()
	})


	// Мини всплывающие окна
	firstClick = false

	$('.mini_modal_link').click(function(e){
	    e.preventDefault()

	    let modalId = $(this).data('modal-id')

	    if( $(this).hasClass('active') ){
	        $(this).removeClass('active')
	      	$('.mini_modal').removeClass('active')

	        firstClick = false

			if( $(window).width() < 1024 ){
				$('body').css('cursor', 'default')
			}
	    }else{
	        $('.mini_modal_link').removeClass('active')
	        $(this).addClass('active')

	        $('.mini_modal').removeClass('active')
	        $(modalId).addClass('active')

	        firstClick = true

			if( $(window).width() < 1024 ){
				$('body').css('cursor', 'pointer')
			}
	    }
	})

	// Закрываем всплывашку при клике за её пределами
	$(document).click(function(e){
	    if ( !firstClick && $(e.target).closest('.mini_modal').length == 0 ){
	        $('.mini_modal, .mini_modal_link').removeClass('active')

			if( $(window).width() < 1024 ){
				$('body').css('cursor', 'default')
			}
	    }

	    firstClick = false
	})


	// Моб. меню
	$('body').on('click', 'header .mob_menu_link', function(e) {
    	e.preventDefault()

		if( $(this).hasClass('active') ) {
			$(this).removeClass('active')

        	$('header .bottom').fadeOut(200)
        	$('body').removeClass('lock')
		} else {
			$(this).addClass('active')

			$('header .bottom').fadeIn(300)
        	$('body').addClass('lock')
		}
    })
})



// Вспомогательные функции
function widthScroll() {
    let div = document.createElement('div')
    div.style.overflowY = 'scroll'
    div.style.width = '50px'
    div.style.height = '50px'
    div.style.visibility = 'hidden'
    document.body.appendChild(div)

    let scrollWidth = div.offsetWidth - div.clientWidth
    document.body.removeChild(div)

    return scrollWidth
}


var supportsCssVars = function() {
    var s = document.createElement('style'),
        support

    s.innerHTML = ":root { --tmp-var: bold; }"
    document.head.appendChild(s)
    support = !!(window.CSS && window.CSS.supports && window.CSS.supports('font-weight', 'var(--tmp-var)'))
    s.parentNode.removeChild(s)

    return support
}

$(window).scroll(function(){
	// Кнопка 'Вверх'
	if( $(window).scrollTop() > $(window).innerHeight() ) {
		$('.buttonUp').fadeIn(300)
	} else {
		$('.buttonUp').fadeOut(200)
	}
})