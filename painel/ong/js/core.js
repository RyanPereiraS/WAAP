$(document).ready(function() {
	var util = "https://www.slicecollections.com.br/";
	
	$("#auth").on('submit', function(e) {
		e.preventDefault();
		$("#submit").prop('disabled', true);
		$.ajax({
			type: 'POST',
			url: util + '/home/performAuth',
			data: $(this).serialize(),
			dataType: 'JSON',
			complete: function(result) {
				console.log(result.responseText);
				var r = JSON.parse(result.responseText);
				
				$("#submit").html(r.message);
				if (r.response == 'ok') {
					setTimeout(function() {
						location.reload();
					}, 1500);
				} else {
					setTimeout(function() {
						$("#submit").html("Entrar");
						$("#submit").prop('disabled', false);
					}, 1500);
				}
			}
		});
	});
	
    $(window).on('load', function() {
        var w = $(window);
        //setTimeout(() => {
            $('body').css('overflow', '')
            /*$('.loader').css({
                "animation": 'fadeOut 1s',
                "opacity": '0',
                "z-index": '-1'
            })

            setTimeout(() => {
                $('.loader').remove()
            }, 1500)*/
			
			$(".om").on('click', function(e) {
                var button = $(this)
                if (button.hasClass("is-active")) {
                    button.removeClass("is-active")
                    $("body").removeClass("menu-opened")
                } else {
                    button.addClass("is-active")
                    $("body").addClass("menu-opened")
                }
            })
            
            $(".content").on("click", function(e) {
                var body = $("body");
                if (body.hasClass("menu-opened")) {
                    body.removeClass("menu-opened")
                    $(".om").removeClass("is-active")
                }
            })

            $('[data-animate]').each(function() {
                var current = $(this)
                var animation = current.data('animate')
                var duration = current.data('duration')
                var delay = current.data('delay')
                var width = current.data('width')

                if (width !== 'undefined' && w.width() < width) {
                    current.addClass('animated')
                    return
                }
                    
                duration = duration == 'undefined' ? '.6' : duration
                delay = delay == 'undefined' ? '.0' : delay
                

                current.waypoint(function() {
                    current.addClass('animated ' + animation).css({
                        'animation-duration': duration + 's',
                        'animation-delay': delay + 's'
                    })
                },
                { offset: '100%' })
            })
        //}, 1000)
    })
})