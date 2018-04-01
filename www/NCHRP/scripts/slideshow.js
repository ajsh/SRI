// A very simple javascript slide show using custom effects from moo.fx
// copyright 2006, University of Minnesota

fx.SlideShow = Class.create();
fx.SlideShow.prototype = Object.extend(new fx.Base(), {
	initialize: function(el, options) {
		// properties initialization
		this.el = $(el);
		this.setOptions(options);
		this.options = options;
		if(!this.options.interval) this.options.interval = 7000;

		this.imgfader = new fx.Combo(el, {duration: 2000});
		this.imgArray = new Array();
		
		var container = new Array();
		$S('#slidelist img.slide').each(function(element) {
			container.push(new Array(element.getAttribute('src'), element.getAttribute('alt')));
		});
		
		this.imgArray = container;
		this.slideshowTimer = null;
		this.started = false;
		this.length = this.imgArray.length;
		this.counter = 0;
	},
	
	start: function() {
		// already started, do nothing
		if(this.started) { return; }
		// check DOM support
		if(!document.getElementById) { return };
		
		var imgDisplay = document.getElementById('display');
		var description = document.getElementById('description');
		if(imgDisplay.getAttribute('rel') == "simpless") {
			imgDisplay.src =  this.imgArray[0][0];
			description.innerHTML = this.imgArray[0][1];
			setTimeout(this.update.bind(this), this.options.interval);
			this.started = true;
			this.counter++;
		}
	},
	
	update: function() {
		if(!this.started) { return; }
		this.imgfader.toggle();
		setTimeout(this.switchimg.bind(this), this.options.duration+500);
	},
	
	switchimg: function() {
		if(!this.started) { return; }
		var i = this.counter % this.length;
		var imgDisplay = document.getElementById('display');
		var description = document.getElementById('description');
		imgDisplay.src = this.imgArray[i][0];
		description.innerHTML = this.imgArray[i][1];
		this.imgfader.toggle();
		setTimeout(this.update.bind(this), this.options.interval);
		this.counter++;
	},
	
	stop: function() {
		// slide show is not running, so nothing to stop
		if(!this.started) { return; }
		this.counter = 0;		
		this.started = false;
	}
});