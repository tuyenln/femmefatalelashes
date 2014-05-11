	jQuery(document).ready(function($) {
	
	    // add into table
	    $(document).on( 'click', 'a.compare_overhead', function(e){
	        e.preventDefault();
	
	        var button = $(this),
	            data = {
	                _yitnonce_ajax: yith_woocompare.nonceadd,
	                action: yith_woocompare.actionadd,
	                id: button.data('product_id'),
	                context: 'frontend'
	            },
	            widget_list = $('.yith-woocompare-widget ul.products-list');
			var compare_added_label_overhead = "<i class=\"icon-ok\"></i>";
	        // add ajax loader
	        button.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
	        widget_list.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
	
	        $.ajax({
	            type: 'post',
	            url: yith_woocompare.ajaxurl,
	            data: data,
	            dataType: 'json',
	            success: function(response){
	                button.unblock().addClass('added').html( compare_added_label_overhead );
	
	                // add the product in the widget
	                widget_list.unblock().html( response.widget_table );
	
	                if (yith_woocompare.auto_open == 'yes') $('body').trigger( 'yith_woocompare_open_popup', { response: response.table_url, button: button } );
	            }
	        });
	    });
	});


	jQuery(document).ready(function(e){
		e(document).on("click",".add_to_cart_button",function(){
			var t=e(this);
			if(t.is(".product_type_overhead")){
				if(!t.attr("data-product_id"))
				return!0;
				t.removeClass("added");
				t.addClass("loading");
				var n={action:"woocommerce_add_to_cart",product_id:t.attr("data-product_id"),quantity:t.attr("data-quantity")};
				e("body").trigger("adding_to_cart",[t,n]);e.post(woocommerce_params.ajax_url,n,function(n){
					if(!n)return;
					var r=window.location.toString();
					r=r.replace("add-to-cart","added-to-cart");
					if(n.error&&n.product_url){
						window.location=n.product_url;
						return
					}
					if(woocommerce_params.cart_redirect_after_add=="yes"){
						window.location=woocommerce_params.cart_url;
						return
					}
					t.removeClass("loading");
					fragments=n.fragments;
					cart_hash=n.cart_hash;
					fragments&&e.each(fragments,function(t,n){e(t).addClass("updating")});
					e(".shop_table.cart, .updating, .cart_totals").fadeTo("400","0.6").block({
						message:null,overlayCSS:{
							background:"transparent url("+woocommerce_params.ajax_loader_url+") no-repeat center",backgroundSize:"16px 16px",opacity:.6
						}}
					);
					t.addClass("added");
					t.parent().find(".added_to_cart").size()==0&&t.after(' <a href="'+woocommerce_params.cart_url+'" class="added_to_cart" title=""><i class="icon-ok"></i></a>');
					fragments&&e.each(fragments,function(t,n){e(t).replaceWith(n)});
					e(".widget_shopping_cart, .updating").stop(!0).css("opacity","1").unblock();
					e(".shop_table.cart").load(r+" .shop_table.cart:eq(0) > *",function(){e("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" id="add1" class="plus" />').prepend('<input type="button" value="-" id="minus1" class="minus" />');
					e(".shop_table.cart").stop(!0).css("opacity","1").unblock();
					e("body").trigger("cart_page_refreshed")});
					e(".cart_totals").load(r+" .cart_totals:eq(0) > *",function(){e(".cart_totals").stop(!0).css("opacity","1").unblock()});
					e("body").trigger("added_to_cart",[fragments,cart_hash])
				});
				return!1
			}
			return!0
		})
	});

    jQuery(document).ready(function(){
    	jQuery('.bxslider').bxSlider();
 
        jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#toTop').fadeIn();
            } else {
                jQuery('#toTop').fadeOut();
            }
        });
 
        jQuery('#toTop').click(function(){
            jQuery("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
    });
    

jQuery(document).ready(function(){

    function portfolio_quicksand() {
		
        // Setting Up Our Variables
        var $filter;
        var $container;
        var $containerClone;
        var $filterLink;
        var $filteredItems
		
        // Set Our Filter
        $filter = jQuery('.arconix-portfolio-features li.active a').attr('class');
		
        // Set Our Filter Link
        $filterLink = jQuery('.arconix-portfolio-features li a');
		
        // Set Our Container
        $container = jQuery('ul.arconix-portfolio-grid');
		
        // Clone Our Container
        $containerClone = $container.clone();
		
        // Apply our Quicksand to work on a click function
        // for each for the filter li link elements
        $filterLink.click(function(e) 
        {
            // Remove the active class
            jQuery('.arconix-portfolio-features li').removeClass('active');
			
            // Split each of the filter elements and override our filter
            $filter = jQuery(this).attr('class').split(' ');
			
            // Apply the 'active' class to the clicked link
            jQuery(this).parent().addClass('active');
			
            // If 'all' is selected, display all elements
            // else output all items referenced to the data-type
            if ($filter == 'all') {
                $filteredItems = $containerClone.find('li'); 
            }
            else {
                $filteredItems = $containerClone.find('li[data-type~=' + $filter + ']'); 
            }
			
            // Finally call the Quicksand function
            $container.quicksand($filteredItems, 
            {
                // The Duration for animation
                duration: 750,
                // the easing effect when animation
                easing: 'easeInOutQuad',
                // height adjustment becomes dynamic
                adjustHeight: 'dynamic' 
            });
			
            //Initalize our PrettyPhoto Script When Filtered
            /*$container.quicksand($filteredItems, 
                function () {
                    lightbox();
                }
                );*/
        });
    }
		
    if(jQuery().quicksand) {
        portfolio_quicksand();	
    }

});

// The toggle
jQuery(document).ready(function(){
	
	jQuery.cookie = function(name, value, options) {
	    if (typeof value != 'undefined') { // name and value given, set cookie
	        options = options || {};
	        if (value === null) {
	            value = '';
	            options = $.extend({}, options); // clone object since it's unexpected behavior if the expired property were changed
	            options.expires = -1;
	        }
	        var expires = '';
	        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
	            var date;
	            if (typeof options.expires == 'number') {
	                date = new Date();
	                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
	            } else {
	                date = options.expires;
	            }
	            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
	        }
	        // NOTE Needed to parenthesize options.path and options.domain
	        // in the following expressions, otherwise they evaluate to undefined
	        // in the packed version for some reason...
	        var path = options.path ? '; path=' + (options.path) : '';
	        var domain = options.domain ? '; domain=' + (options.domain) : '';
	        var secure = options.secure ? '; secure' : '';
	        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
	    } else { // only name given, get cookie
	        var cookieValue = null;
	        if (document.cookie && document.cookie != '') {
	            var cookies = document.cookie.split(';');
	            for (var i = 0; i < cookies.length; i++) {
	                var cookie = jQuery.trim(cookies[i]);
	                // Does this cookie string begin with the name we want?
	                if (cookie.substring(0, name.length + 1) == (name + '=')) {
	                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
	                    break;
	                }
	            }
	        }
	        return cookieValue;
	    }
	};	
	
	
	jQuery("#grid").click(function(){
		jQuery(this).addClass("active");
		jQuery("#list").removeClass("active");
		jQuery.cookie("gridcookie","grid",{path:"/"});
		jQuery("div.product").fadeOut(300,function(){
			jQuery(this).addClass("grid").removeClass("list").fadeIn(300)
		});
		//return!1
	});
	jQuery("#list").click(function(){
		jQuery(this).addClass("active");
		jQuery("#grid").removeClass("active");
		jQuery.cookie("gridcookie","list",{path:"/"});
		jQuery("div.product").fadeOut(300,function(){jQuery(this).removeClass("grid").addClass("list").fadeIn(300)});
		//return!1
	});
	
	jQuery.cookie("gridcookie")&&jQuery("div.product, #gridlist-toggle").addClass(jQuery.cookie("gridcookie"));
	
	if(jQuery.cookie("gridcookie")=="grid"){
		jQuery(".gridlist-toggle #grid").addClass("active");
		jQuery(".gridlist-toggle #list").removeClass("active")
	}
	if(jQuery.cookie("gridcookie")=="list"){
		jQuery(".gridlist-toggle #list").addClass("active");
		jQuery(".gridlist-toggle #grid").removeClass("active")
	}

	jQuery("#gridlist-toggle a").click(function(e){e.preventDefault()})
});

(function($){$.fn.quicksand=function(collection,customOptions){var options={duration:750,easing:'swing',attribute:'data-id',adjustHeight:'auto',adjustWidth:'auto',useScaling:false,enhancement:function(c){},selector:'> *',atomic:false,dx:0,dy:0,maxWidth:0,retainExisting:true};$.extend(options,customOptions);if($.browser.msie||(typeof($.fn.scale)=='undefined')){options.useScaling=false}var callbackFunction;if(typeof(arguments[1])=='function'){callbackFunction=arguments[1]}else if(typeof(arguments[2]=='function')){callbackFunction=arguments[2]}return this.each(function(i){var val;var animationQueue=[];var $collection;if(typeof(options.attribute)=='function'){$collection=$(collection)}else{$collection=$(collection).filter('['+options.attribute+']').clone()}var $sourceParent=$(this);var sourceHeight=$(this).css('height');var sourceWidth=$(this).css('width');var destHeight,destWidth;var adjustHeightOnCallback=false;var adjustWidthOnCallback=false;var offset=$($sourceParent).offset();var offsets=[];var $source=$(this).find(options.selector);var width=$($source).innerWidth();if($.browser.msie&&parseInt($.browser.version,10)<7){$sourceParent.html('').append($collection);return}var postCallbackPerformed=0;var postCallback=function(){$(this).css('margin','').css('position','').css('top','').css('left','').css('opacity','');if(!postCallbackPerformed){postCallbackPerformed=1;if(!options.atomic){var $toDelete=$sourceParent.find(options.selector);if(!options.retainExisting){$sourceParent.prepend($dest.find(options.selector));$toDelete.remove()}else{var $keepElements=$([]);$dest.find(options.selector).each(function(i){var $matchedElement=$([]);if(typeof(options.attribute)=='function'){var val=options.attribute($(this));$toDelete.each(function(){if(options.attribute(this)==val){$matchedElement=$(this);return false}})}else{$matchedElement=$toDelete.filter('['+options.attribute+'="'+$(this).attr(options.attribute)+'"]')}if($matchedElement.length>0){$keepElements=$keepElements.add($matchedElement);if(i===0){$sourceParent.prepend($matchedElement)}else{$matchedElement.insertAfter($sourceParent.find(options.selector).get(i-1))}}});$toDelete.not($keepElements).remove()}if(adjustHeightOnCallback){$sourceParent.css('height',destHeight)}if(adjustWidthOnCallback){$sourceParent.css('width',sourceWidth)}}options.enhancement($sourceParent);if(typeof callbackFunction=='function'){callbackFunction.call(this)}}if(false===options.adjustHeight){$sourceParent.css('height','auto')}if(false===options.adjustWidth){$sourceParent.css('width','auto')}};var $correctionParent=$sourceParent.offsetParent();var correctionOffset=$correctionParent.offset();if($correctionParent.css('position')=='relative'){if($correctionParent.get(0).nodeName.toLowerCase()!='body'){correctionOffset.top+=(parseFloat($correctionParent.css('border-top-width'))||0);correctionOffset.left+=(parseFloat($correctionParent.css('border-left-width'))||0)}}else{correctionOffset.top-=(parseFloat($correctionParent.css('border-top-width'))||0);correctionOffset.left-=(parseFloat($correctionParent.css('border-left-width'))||0);correctionOffset.top-=(parseFloat($correctionParent.css('margin-top'))||0);correctionOffset.left-=(parseFloat($correctionParent.css('margin-left'))||0)}if(isNaN(correctionOffset.left)){correctionOffset.left=0}if(isNaN(correctionOffset.top)){correctionOffset.top=0}correctionOffset.left-=options.dx;correctionOffset.top-=options.dy;$sourceParent.css('height',$(this).height());$sourceParent.css('width',$(this).width());$source.each(function(i){offsets[i]=$(this).offset()});$(this).stop();var dx=0;var dy=0;$source.each(function(i){$(this).stop();var rawObj=$(this).get(0);if(rawObj.style.position=='absolute'){dx=-options.dx;dy=-options.dy}else{dx=options.dx;dy=options.dy}rawObj.style.position='absolute';rawObj.style.margin='0';if(!options.adjustWidth){rawObj.style.width=(width+'px')}rawObj.style.top=(offsets[i].top-parseFloat(rawObj.style.marginTop)-correctionOffset.top+dy)+'px';rawObj.style.left=(offsets[i].left-parseFloat(rawObj.style.marginLeft)-correctionOffset.left+dx)+'px';if(options.maxWidth>0&&offsets[i].left>options.maxWidth){rawObj.style.display='none'}});var $dest=$($sourceParent).clone();var rawDest=$dest.get(0);rawDest.innerHTML='';rawDest.setAttribute('id','');rawDest.style.height='auto';rawDest.style.width=$sourceParent.width()+'px';$dest.append($collection);$dest.insertBefore($sourceParent);$dest.css('opacity',0.0);rawDest.style.zIndex=-1;rawDest.style.margin='0';rawDest.style.position='absolute';rawDest.style.top=offset.top-correctionOffset.top+'px';rawDest.style.left=offset.left-correctionOffset.left+'px';if(options.adjustHeight==='dynamic'){$sourceParent.animate({height:$dest.height()},options.duration,options.easing)}else if(options.adjustHeight==='auto'){destHeight=$dest.height();if(parseFloat(sourceHeight)<parseFloat(destHeight)){$sourceParent.css('height',destHeight)}else{adjustHeightOnCallback=true}}if(options.adjustWidth==='dynamic'){$sourceParent.animate({width:$dest.width()},options.duration,options.easing)}else if(options.adjustWidth==='auto'){destWidth=$dest.width();if(parseFloat(sourceWidth)<parseFloat(destWidth)){$sourceParent.css('width',destWidth)}else{adjustWidthOnCallback=true}}$source.each(function(i){var destElement=[];if(typeof(options.attribute)=='function'){val=options.attribute($(this));$collection.each(function(){if(options.attribute(this)==val){destElement=$(this);return false}})}else{destElement=$collection.filter('['+options.attribute+'="'+$(this).attr(options.attribute)+'"]')}if(destElement.length){if(!options.useScaling){animationQueue.push({element:$(this),dest:destElement,style:{top:$(this).offset().top,left:$(this).offset().left,opacity:""},animation:{top:destElement.offset().top-correctionOffset.top,left:destElement.offset().left-correctionOffset.left,opacity:1.0}})}else{animationQueue.push({element:$(this),dest:destElement,style:{top:$(this).offset().top,left:$(this).offset().left,opacity:""},animation:{top:destElement.offset().top-correctionOffset.top,left:destElement.offset().left-correctionOffset.left,opacity:1.0,scale:'1.0'}})}}else{if(!options.useScaling){animationQueue.push({element:$(this),style:{top:$(this).offset().top,left:$(this).offset().left,opacity:""},animation:{opacity:'0.0'}})}else{animationQueue.push({element:$(this),animation:{opacity:'0.0',style:{top:$(this).offset().top,left:$(this).offset().left,opacity:""},scale:'0.0'}})}}});$collection.each(function(i){var sourceElement=[];var destElement=[];if(typeof(options.attribute)=='function'){val=options.attribute($(this));$source.each(function(){if(options.attribute(this)==val){sourceElement=$(this);return false}});$collection.each(function(){if(options.attribute(this)==val){destElement=$(this);return false}})}else{sourceElement=$source.filter('['+options.attribute+'="'+$(this).attr(options.attribute)+'"]');destElement=$collection.filter('['+options.attribute+'="'+$(this).attr(options.attribute)+'"]')}var animationOptions;if(sourceElement.length===0&&destElement.length>0){if(!options.useScaling){animationOptions={opacity:'1.0'}}else{animationOptions={opacity:'1.0',scale:'1.0'}}var d=destElement.clone();var rawDestElement=d.get(0);rawDestElement.style.position='absolute';rawDestElement.style.margin='0';if(!options.adjustWidth){rawDestElement.style.width=width+'px'}rawDestElement.style.top=destElement.offset().top-correctionOffset.top+'px';rawDestElement.style.left=destElement.offset().left-correctionOffset.left+'px';d.css('opacity',0.0);if(options.useScaling){d.css('transform','scale(0.0)')}d.appendTo($sourceParent);if(options.maxWidth===0||destElement.offset().left<options.maxWidth){animationQueue.push({element:$(d),dest:destElement,animation:animationOptions})}}});$dest.remove();if(!options.atomic){options.enhancement($sourceParent);for(i=0;i<animationQueue.length;i++){animationQueue[i].element.animate(animationQueue[i].animation,options.duration,options.easing,postCallback)}}else{$toDelete=$sourceParent.find(options.selector);$sourceParent.prepend($dest.find(options.selector));for(i=0;i<animationQueue.length;i++){if(animationQueue[i].dest&&animationQueue[i].style){var destElement=animationQueue[i].dest;var destOffset=destElement.offset();destElement.css({position:'relative',top:(animationQueue[i].style.top-destOffset.top),left:(animationQueue[i].style.left-destOffset.left)});destElement.animate({top:"0",left:"0"},options.duration,options.easing,postCallback)}else{animationQueue[i].element.animate(animationQueue[i].animation,options.duration,options.easing,postCallback)}}$toDelete.remove()}})}})(jQuery);    
  