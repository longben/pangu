Element.getOpacity = function(element){  
	var opacity;  
	if (opacity = Element.getStyle(element, "opacity"))  return parseFloat(opacity);  
	if (opacity = (Element.getStyle(element, "filter") || '').match(/alpha\(opacity=(.*)\)/))  
	if(opacity[1]) return parseFloat(opacity[1]) / 100; return 1.0;  
}

Element.setOpacity = function(element, value){  
	element= $(element);  
	var els = element.style;  
	if (value == 1){  
		els.opacity = '0.999999';  
		if(/MSIE/.test(navigator.userAgent)) els.filter = Element.getStyle(element,'filter').replace(/alpha\([^\)]*\)/gi,'');  
	} else {  
		if(value < 0.00001) value = 0;  els.opacity = value; 
		if(/MSIE/.test(navigator.userAgent)) els.filter = Element.getStyle(element,'filter').replace(/alpha\([^\)]*\)/gi,'') + "alpha(opacity="+value*100+")";  
	}   
}


var ErrorDialog = Class.create();

ErrorDialog.prototype = {
	initialize: function(message, options) {
		this.message = message;
		
		if((typeof Prototype=='undefined') || parseFloat(Prototype.Version.split(".")[0] + "." + Prototype.Version.split(".")[1]) < 1.4){
			var t = "JavaScript ErrorDialog Framework requires the Prototype JavaScript framework >= 1.4.0";
			this.message = t;
			alert(t);
			return;
		}

		this.options = Object.extend({
			width:   350,
			height:  150,
			bgcolor: 'black',
			color:   'threedlightshadow',
			opacity: 0.15,
			title:   ".:系统提示信息:."
		}, options);

		this.elements = {};
		this.setup();
	},

	setup: function() {
		if (this.resizeObserver) return;
		var fontFamily = 'Lucida Grande, Verdana, sans-serif';

		this.createElement('background', 'div', document.body, {
			absolutize: true,
			opacity:    this.options.opacity,
			style:      {top: 0, left: 0, backgroundColor: this.options.bgcolor, zIndex: 100}
			//properties: {onclick: this.close.bind(this)}
		});

		this.createElement('dialog', 'div', document.body, {
			absolutize: true,
			style: {backgroundColor: 'white', zIndex: 102, borderStyle: 'solid',borderWidth: '2px',borderColor: this.options.color}
			//properties: {onclick: this.close.bind(this)}
		});


		this.createElement('content', 'div', this.elements.dialog, {
			style:      {padding: '0px'}
			//properties: {onclick: this.close.bind(this)}
		});

		this.createElement('title', 'h1', this.elements.content, {
			style:      {backgroundColor: this.options.color, padding: '2px,2px,2px,10px',margin:0,fontFamily: fontFamily, fontSize: '15px',color : "#FFFFFF"},
			innerHTML:  this.options.title,
			properties: {onclick: this.close.bind(this)}
		});

		this.createElement('closeButton', 'div', this.elements.dialog, {
			style:      {position: 'absolute',fontFamily: 'webdings', cursor:'hand', fontSize: '15px', margin: 0, zIndex: 104},
			innerHTML:  'r',
			properties: {onclick: this.close.bind(this)}
		});

		this.createElement('message', 'div', this.elements.content, {
			style:      {fontFamily: fontFamily, overflow: 'auto', padding: '5px',margin: '5px'},
			innerHTML:  this.message
		});

		this.createElement('buttons', 'div', this.elements.dialog, {
		  style:      {textAlign: 'center', fontFamily: fontFamily, fontSize: '13px', 
					   marginTop: '10px'}
		});

		// reload button
		var reloadButton = this.createElement('reload', 'button', this.elements.buttons, {
		  innerHTML:  '刷新本页',
		  style:      {marginRight: '10px'},
		  properties: {onclick: function() {window.location.reload()}}
		});
		
		reloadButton.setAttribute("disabled","true");
		
		// continue button
		this.createElement('continue', 'button', this.elements.buttons, {
		  innerHTML:  '关闭窗口',
		  style:      {cursor: 'pointer'},
		  properties: {onclick: this.close.bind(this)}
		});

		this.createElement('space', 'div', this.elements.dialog, {
		  style:      {textAlign: 'center', fontFamily: fontFamily, fontSize: '13px', 
					   marginTop: '10px'}
		});

		this.layout();
		this.hiddenSelect();
		this.resizeObserver = this.layout.bind(this);
		Event.observe(window, 'resize', this.resizeObserver);
		Event.observe(window, 'scroll', this.resizeObserver);

		window.setInterval(this.close,30000);
	},
	
	hiddenSelect: function(){
		var selects = document.getElementsByTagName("select");
        for (i = 0; i != selects.length; i++) {
                selects[i].style.visibility = "hidden";
        }		
	},
	
	showSelect: function(){
		var selects = document.getElementsByTagName("select");
        for (i = 0; i != selects.length; i++) {
                selects[i].style.visibility = "visible";
        }		
	},
	
	layout: function() {
		var scrollOffsets = {};
		Position.prepare.apply(scrollOffsets);
		var left = scrollOffsets.deltaX, top = scrollOffsets.deltaY;
		var bodyDimensions = Element.getDimensions(document.body);
		var bodyHeight = bodyDimensions.height, bodyWidth = bodyDimensions.width;
		var contentWidth  = window.innerWidth  || document.clientWidth  || document.body.clientWidth;
		var contentHeight = window.innerHeight || document.clientHeight || document.body.clientHeight;

		var dialogLeft = (contentWidth  - this.options.width)  / 2;
		var dialogTop  = (contentHeight - this.options.height) / 2;

		//this.position('background', {top: 0, left: 0, width: screen.availWidth, height: screen.availHeight});
		this.position('background', {top: 0, left: 0, width:  Math.max(bodyWidth, contentWidth), height: Math.max(bodyHeight, contentHeight)});
		this.position('dialog', {top: top + dialogTop, left: left + dialogLeft,	width: this.options.width - 20, height: this.options.height - 20});
		this.position('closeButton', {top: 1, left: this.options.width - 40});

		var messageOffset = Position.positionedOffset(this.elements.message);
		var messageHeight = this.options.height - messageOffset[1];
		this.position('message', {height: messageHeight});
	},

	createElement: function(name, tagName, parent, options) {
		var element = document.createElement(tagName);
		parent.appendChild(element);
		if (options.absolutize) Position.absolutize(element);
		if (options.style)      Element.setStyle(element, options.style);
		if (options.properties) Object.extend(element, options.properties);
		if (options.opacity)    Element.setOpacity(element, options.opacity);
		if (options.innerHTML)  Element.update(element, options.innerHTML);
		this.elements[name] = element;
		return element;
	},
	

	position: function(name, options) {
		var element = this.elements[name];
		['top', 'left', 'width', 'height'].each(function(property) {
		if (options[property]) element.style[property] = options[property].toString() + 'px';
		});
	},

	close: function() {
		if (!this.resizeObserver) return;
		Element.remove(this.elements.title);
		Element.remove(this.elements.message);
		Element.remove(this.elements.content);
		Element.remove(this.elements.closeButton);
		Element.remove(this.elements.dialog);
		Element.remove(this.elements.background);

		Event.stopObserving(window, 'resize', this.resizeObserver);
		Event.stopObserving(window, 'scroll', this.resizeObserver);
		this.resizeObserver = null;
		this.showSelect();
	}
}

