jQuery.noConflict();
(function($){
	$(document).ready(function(){		

		$('#events li a.img, .media-body a').click(function(e){
			e.preventDefault();

			var eleCopy = $(this).parents('.media'),
			marginTop = eleCopy.css('margin-top'),
			// ch = $('#events').height(),
			// ch = $('#carousel').height() ? $('#carousel').height() : $('#events').height(),
			ch = $('#carousel').height(),
			cw = $('.container').width(),
			b = 10,
			t = .5,
			d = .3,
			top = parseInt(marginTop.substr(0, marginTop.length-2)) + eleCopy.position().top - b,
			ele = $(this).parents('.media').clone().appendTo('#events'),
			img = ele.find('.img').css('display', window.innerWidth > 768 ? 'block' : 'none'),
			iw = img.data('width'),
			ih = img.data('height'),
			body = ele.find('.media-body'),
			detail = ele.find('.event-detail'),
			tl = new TimelineLite({onComplete: function(){
					detail.jScrollPane({hideFocus: true});
					$('<button class="close">&times;</button>').appendTo(body).click(function(){
						$(this).remove();
						tl.reverse();
					});
				},onReverseComplete: function(){
					ele.remove();
			}});

			console.log($('#carousel').height());

			function updateDimHeight(){
				body.css({'height': img.height()});
			}

			function updateDimWidth(){
				body.css({'width': ele.width() - 2 * b - 2});
			}

			if(window.innerWidth < 769){
				ele.css('margin-left', b);
				cw -= 2*b;
				body.css({'width': eleCopy.width() -  2 * b -  2});
			}else{
				body.css({'width': eleCopy.width() - b -  2});

				// tween width
				if(ih > ch) iw = iw * ch / ih - 2 * b;

				tl.add(TweenLite.to(ele, t, {ease:Power2.easeInOut, 'width': cw + 2 * b}), d);

				tl.add(TweenLite.to(detail, t, {ease:Power2.easeInOut, 'width': cw - (img.css('display') != 'none' ? iw + 2 * b : 0)}), d);

				tl.add(TweenLite.to(img, t, {ease:Power2.easeInOut, 'width': iw, onUpdate: updateDimWidth}), d);
			}			
			
			// tween height
			tl.add(TweenLite.to(ele.addClass('animate').css({'top': top}), t, {ease:Power2.easeInOut, 'top': - b, 'left': - b}), 0);
			
			tl.add(TweenLite.to(ele.find('.media-heading')
				, t, {ease:Power2.easeInOut, 'marginTop': 0}), 0);

			tl.add(TweenLite.to(img, t, {ease:Power2.easeInOut, 'height': ch, onUpdate: updateDimHeight}), 0);

			tl.add(TweenLite.to(detail, t, {ease:Power2.easeInOut, 'height': ch - eleCopy.find('.media-heading').height() - b}), 0);

			img.click(function(e){
				e.preventDefault();
				$.colorbox({href:img.attr('href')});
			});
		});


        var scrollpane = $('.scroll-pane').jScrollPane({autoReinitialise:true, hideFocus: true, mouseWheelSpeed: 24}),
        	api = scrollpane.data('jsp');
        
		$('#type-selection a').click(function(e){
			e.preventDefault();

			if(!$(this).parent().hasClass('active')){
				var cl = $(this).attr('class'),
					list = $('#product-selection li'),
					timeline = new TimelineLite({onComplete: function(){
						if(cl != 'all-products') list.css('display', 'inline-block').not('.' + cl).css('display', 'none');
							else list.css('display', 'inline-block');

						if(api) api.reinitialise();

						timeline.clear();

						list.each(function(){
							if($(this).css('display') != 'none') timeline.add(TweenLite.to($(this), .25, {overwrite: 'all', ease: Power2.easeInOut, autoAlpha: 1}), '-=0.23');
						});
					}});

				console.log(cl);

				list.each(function(i){
					

					if($(this).css('display') != 'none') {
						if(timeline.totalDuration()){
							timeline.add(TweenLite.to($(this), .15, {overwrite: 'all', ease: Power2.easeInOut, autoAlpha: 0}), '-=0.14');
						}else{
							timeline.add(TweenLite.to($(this), .15, {overwrite: 'all', ease: Power2.easeInOut, autoAlpha: 0}));
						}
					}
					
				});

				$('#type-selection li').removeClass('active').find(this).parent().addClass('active');
			}
		});

		$(window).resize(function(){
			if(api) api.reinitialise();

			$('#events .animate').remove();
		});

		$('.carousel').carousel();

        $('a.gallery').colorbox({
        	  rel: function(){
        	  		var rel = $(this).data('rel');
        	  		return !rel ? 'gal' : rel;
        	  }
        	, title: function(){
        			return $(this).data('title');
        	}
        });

        $(window).trigger('resize');
	});
}(jQuery));