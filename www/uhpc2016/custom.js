/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* 
    Created on : Mar 28, 2015, 1:30:00 P.M.
    Author     : Aaron Rowe
*/

jQuery( document ).ready(function() {
	
	var registerButtonHeight = 0;
	var regLinkCloneHigh;
  	var regLinkCloneLow;
  	var regLinkOriginal;
	var initialPageTitleSize = 0;
  
	var url = window.location;
	var baseURL = url.protocol + "//" + url.host + "/" + url.pathname.split("/")[1];
	
  jQuery('.header-reg-container, .navbar-header-reg, a.maximenuck.register').hover(function(){
    jQuery('a.register').addClass('register-hover');
  }, function(){
    jQuery('a.register').removeClass('register-hover');
  });
  
	jQuery(".collapseContainer .date-header-row").click(function () {
		if(!jQuery(this).siblings("div.collapsed-content").is(':animated')){
				if(jQuery(this).siblings("div.collapsed-content").hasClass("active")){
					if(jQuery('.templateTwo-container').length){
						jQuery(this).children(".collapse-image").attr("src","/images/display/concept2plus.png");
					}else{
						jQuery(this).children(".collapse-image").attr("src","/images/display/isu-plus.png");
					}
			}else{
				if(jQuery('.templateTwo-container').length){
						jQuery(this).children(".collapse-image").attr("src","/images/display/concept2minus.png");
					}else{
						jQuery(this).children(".collapse-image").attr("src","/images/display/isu-minus.png");
					}
			}
		jQuery(this).siblings("div.collapsed-content").slideToggle(500, function () {
			if(jQuery(this).hasClass("active")){
				jQuery(this).removeClass("active");
			}
			else {
				jQuery(this).addClass("active");
			}
		});
		}
	});
	
  	jQuery('.site-background').css('background-image', 'url(' + jQuery('.site-background img').attr('src') + ')');

  	//Collapse agenda containers
		jQuery(".collapseContainer").children("div").not(".date-header-row").slideUp(0);
      	adjustHeaderColsForImage();
  		adjustFooterTextTemplateTwo();
		adjustSecondaryColumnTemplateTwo();
		adjustFooterTextTemplateThree();
		
		jQuery('.templateTwo-container .navbar-toggle').click(function(){
			jQuery('.templateTwo-container .t3-navbar-collapse').animate({width:'toggle'},250);
		});
		
  
  	addPDFIcons();
	setTemplateTwoCollapseImage();
  
	jQuery(window).load(function() {
      
      	var customHeaderSelector = '.homePage .templateOne-container .t3-content h1, .homePage .templateThree-container .t3-content h1,' +
        	' .custom-header h2 > a, .custom-header h3 > a,'+
            ' .custom-header h4 > a, .custom-header h5 > a, .custom-header h6 > a';
        
        var customDateSelector = '.homePage .templateOne-container .t3-content h2, .homePage .templateTwo-container .t3-content h2,' +
            '.date-header-row h1, .date-header-row h2, .date-header-row h3, .date-header-row h4, .date-header-row h5, .date-header-row h6';
      
	  
      	jQuery(customHeaderSelector).fitText(1 ,{maxFontSize: '56px', minFontSize: '30px'});
		jQuery(customDateSelector).fitText(1 ,{maxFontSize: '25px', minFontSize: '20px'});
		
		jQuery('.templateOne-container .custom-header h1 > a').fitText(1 ,{maxFontSize: calculateHeaderTextSizeLimit('.templateOne-container', 56, 3)+'px', minFontSize: '30px'});
		
		jQuery('.homePage .templateTwo-container .t3-content h1').fitText(1.25 ,{maxFontSize: '50px', minFontSize: '30px'});
		
		jQuery('.templateTwo-container .t3-header h1 > a').fitText(0.8 ,{maxFontSize: '48px', minFontSize: '40px'});
		
		jQuery('.templateThree-container .custom-header h1 > a').fitText(1 ,{maxFontSize: '48px', minFontSize: '36px'});
		jQuery('.templateThree-container .t3-content h2:not(.date-header)').fitText(1 ,{maxFontSize: '36px', minFontSize: '20px'});
		
		getTemplateTwoColHeight();
		
		initialPageTitleSize = jQuery('.page-title').height()
		adjustPageTitleTemplateTwo();
    });
	
	var timeout;
	jQuery(window).resize(function(){
		clearTimeout(timeout);
		timeout = setTimeout(afterResize, 100);
	});

		function afterResize(){
			adjustSecondaryColumnTemplateTwo();
			getTemplateTwoColHeight();
			adjustPageTitleTemplateTwo();
		}
  
  jQuery('a.register:first').parent().addClass('registerLarge');
  jQuery('a.register:first').clone().appendTo('.header-reg-container,.navbar-header-reg');

  function setTemplateTwoCollapseImage(){
	if(jQuery('.templateTwo-container').length){
		jQuery(".collapse-image").attr("src","/images/display/concept2plus.png");
	}
  }
  
  function getTemplateTwoColHeight(){
	if(jQuery('.templateTwo-container').length){
		var bodyHeight = jQuery('body').outerHeight();
		var adjustSelector = "";
		if(jQuery('.mobile-header:visible').length){
			var totalHeight = jQuery('.templateTwo-container > .mobile-header .collapse-button-row').outerHeight() + jQuery('.templateTwo-container > .mobile-header .maximenuckh').outerHeight() + jQuery('.templateTwo-container > .mobile-header .t3-footer').outerHeight();
			adjustSelector = ".templateTwo-container .mobile-column-wrapper";
		}else{
			var totalHeight = jQuery('.templateTwo-container > .container .t3-header').outerHeight() + jQuery('.templateTwo-container .custom-menu').outerHeight() + jQuery('.templateTwo-container .t3-footer').outerHeight();
			adjustSelector = ".templateTwo-container .primary-col";
		}
		
		var newHeight = (totalHeight > bodyHeight ? totalHeight : bodyHeight);
		jQuery(adjustSelector).height(newHeight);
		jQuery('.t3-wrapper').height(newHeight);
	}
  }
  
  function adjustHeaderColsForImage(){
    if(!jQuery('.logo-image-col img').length){
      jQuery('.logo-image-col').css('display', 'none');
      jQuery('.event-header-col-container').unwrap().wrap("<div class=\"event-header-col col-xs-12 col-sm-12 col-md-12 col-lg-12\"></div>");
    }
  }
  
  function addPDFIcons(){
     	jQuery('a[href$=".pdf"]').prepend('<img src="/images/display/PDFicon.png" alt="PDF Icon"/>'); 
  }
  
  function calculateHeaderTextSizeLimit(templateContainer, defaultSize, lineLimit){
		var count = jQuery(templateContainer + ' .custom-header h1 > a').text().length;
		var lengthRatio = count/16;
		var newSize = defaultSize;
		if(lengthRatio > lineLimit){
			newSize = Math.floor((3/lengthRatio) * defaultSize);
		}
		
		return newSize;
  }
  
  function adjustPageTitleTemplateTwo(){
	if(jQuery('.templateTwo-container').length){
		if(jQuery('.page-title').length && jQuery(window).width() <= 767){
			if(initialPageTitleSize > jQuery('.absolute-banner').height()){
				jQuery('.page-title').css('font-size', '30px');
			}else{
				jQuery('.page-title').css('font-size', '3em');
			}
		}else{
			jQuery('.page-title').css('font-size', '4em');
		}
		
	}
  }
  
  function adjustFooterTextTemplateTwo(){
	if(jQuery('.templateTwo-container').length){
      var lastFooter = jQuery('.custom-footer-module-2 p:last-child');
      lastFooter.html(lastFooter.html().replace(/&nbsp;|\|/g, ''));
      lastFooter.children('a:not(:first-child)').each(function(){
          jQuery(this).wrap("<p></p>");
      });
      lastFooter.addClass('last-footer');
	}
  }
  
  function adjustSecondaryColumnTemplateTwo(){
	if(jQuery('.templateTwo-container').length){
	
		if(jQuery(window).width() <= 767 && jQuery(window).width() > 600){
          if(jQuery('.custom-side-bar .custom .img-col').length == 0){
           		jQuery('.custom-side-bar .custom').children(':first-child').wrap('<div class="col-xs-5 img-col"></div>');
				jQuery('.custom-side-bar .custom').children().not(':first-child').wrap('<div class="col-xs-7 desc-col"></div>');
          }
		}else{
			jQuery('.custom-side-bar .custom .img-col').children(':first-child').unwrap();
			jQuery('.custom-side-bar .custom .desc-col').children(':first-child').unwrap();
		}
	}
  }
  
  function adjustFooterTextTemplateThree(){
	if(jQuery('.templateThree-container').length){
      var footerOneAnchors = jQuery('.custom-footer-module .custom-footer-2 p a');
	  var html = footerOneAnchors.parent('p').html().replace(/ ,|,/g, '');
      footerOneAnchors.parent('p').html(html);
      jQuery('.custom-footer-module .custom-footer-2 p a').wrap("<p></p>");
      
      var lastFooter = jQuery('.custom-footer-module-2 p');
	  var footerHtml = lastFooter.html();
	  var firstIndex = footerHtml.indexOf("&nbsp;|&nbsp;");
	  var lastIndex = footerHtml.lastIndexOf("&nbsp;|&nbsp;");
	  var newHtml = footerHtml.substring(0, firstIndex) + "<p>" + footerHtml.substring(firstIndex + 13, lastIndex) + "</p>" + footerHtml.substring(lastIndex + 13, footerHtml.length);
	  lastFooter.html(newHtml);
	}
  }
  
  function checkOverlapRegisterButton(){
	if(jQuery('.templateOne-container').length || jQuery('templateThree-container').length){
		var overlaps = (function () {
			function getPositions( elem ) {
				var pos, width, height;
				pos = jQuery( elem ).position();
				width = jQuery( elem ).width();
				height = jQuery( elem ).height();
				return [ [ pos.left, pos.left + width ], [ pos.top, pos.top + height ] ];
			}

			function comparePositions( p1, p2 ) {
				var r1, r2;
				r1 = p1[0] < p2[0] ? p1 : p2;
				r2 = p1[0] < p2[0] ? p2 : p1;
				return r1[1] > r2[0] || r1[0] === r2[0];
			}

			return function ( a, b ) {
				var pos1 = getPositions( a ),
					pos2 = getPositions( b );
				return comparePositions( pos1[0], pos2[0] ) && comparePositions( pos1[1], pos2[1] );
			};
		})();
		
		if(overlaps(jQuery('a.register')[0], jQuery('ul.nav li:nth-last-child(2)')[0])){
			jQuery('.header-reg-container').css('display', 'block');
			jQuery('a.register').css('display', 'none');
		}else{
			jQuery('a.register').css('display', 'block');
			jQuery('.header-reg-container').css('display', 'none');
		}
	}
  }
  

});
