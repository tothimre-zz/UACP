/* begin Page */

/* Generated with Artisteer version 2.2.0.17981, file checksum is A9B5EF42. */

var artEventHelper = {
	'bind': function(obj, evt, fn) {
		if (obj.addEventListener)
			obj.addEventListener(evt, fn, false);
		else if (obj.attachEvent)
			obj.attachEvent('on' + evt, fn);
		else
			obj['on' + evt] = fn;
	}
};

var userAgent = navigator.userAgent.toLowerCase();
var browser = {
	version: (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1],
	safari: /webkit/.test(userAgent) && !/chrome/.test(userAgent),
	chrome: /chrome/.test(userAgent),
	opera: /opera/.test(userAgent),
	msie: /msie/.test(userAgent) && !/opera/.test(userAgent),
	mozilla: /mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent)
};

var artLoadEvent = (function() {
	

	var list = [];

	var done = false;
	var ready = function() {
		if (done) return;
		done = true;
		for (var i = 0; i < list.length; i++)
			list[i]();
	};

	if (document.addEventListener && !browser.opera)
		document.addEventListener('DOMContentLoaded', ready, false);

	if (browser.msie && window == top) {
		(function() {
			try {
				document.documentElement.doScroll('left');
			} catch (e) {
				setTimeout(arguments.callee, 10);
				return;
			}
			ready();
		})();
	}

	if (browser.opera) {
		document.addEventListener('DOMContentLoaded', function() {
			for (var i = 0; i < document.styleSheets.length; i++) {
				if (document.styleSheets[i].disabled) {
					setTimeout(arguments.callee, 10);
					return;
				}
			}
			ready();
		}, false);
	}

	if (browser.safari) {
		var numStyles;
		(function() {
			if (document.readyState != 'loaded' && document.readyState != 'complete') {
				setTimeout(arguments.callee, 10);
				return;
			}
			if ('undefined' == typeof numStyles) {
				numStyles = document.getElementsByTagName('style').length;
				var links = document.getElementsByTagName('link');
				for (var i = 0; i < links.length; i++) {
					numStyles += (links[i].getAttribute('rel') == 'stylesheet') ? 1 : 0;
				}
				if (document.styleSheets.length != numStyles) {
					setTimeout(arguments.callee, 0);
					return;
				}
			}
			ready();
		})();
	}

	artEventHelper.bind(window, 'load', ready);

	return ({
		add: function(f) {
			list.push(f);
		}
	})
})();

(function() {
	// fix ie blinking
	var m = document.uniqueID && document.compatMode && !window.XMLHttpRequest && document.execCommand;
	try { if (!!m) { m('BackgroundImageCache', false, true); } }
	catch (oh) { };
})();

function xGetElementsByClassName(clsName, parentEle, tagName) {
	var elements = null;
	var found = [];
	var s = String.fromCharCode(92);
	var re = new RegExp('(?:^|' + s + 's+)' + clsName + '(?:$|' + s + 's+)');
	if (!parentEle) parentEle = document;
	if (!tagName) tagName = '*';
	elements = parentEle.getElementsByTagName(tagName);
	if (elements) {
		for (var i = 0; i < elements.length; ++i) {
			if (elements[i].className.search(re) != -1) {
				found[found.length] = elements[i];
			}
		}
	}
	return found;
}

var styleUrlCached = null;
function GetStyleUrl() {
	if (null == styleUrlCached) {
		var ns;
		styleUrlCached = '';
		ns = document.getElementsByTagName('link');
		for (var i = 0; i < ns.length; i++) {
			var l = ns[i];
			if (l.href && /style\.css(\?.*)?$/.test(l.href)) {
				return styleUrlCached = l.href.replace(/style\.css(\?.*)?$/, '');
			}
		}

		ns = document.getElementsByTagName('style');
		for (var i = 0; i < ns.length; i++) {
			var matches = new RegExp('import\\s+"([^"]+\\/)style\\.css"').exec(ns[i].innerHTML);
			if (null != matches && matches.length > 0)
				return styleUrlCached = matches[1];
		}
	}
	return styleUrlCached;
}

function fixPNG(element) {
	if (/MSIE (5\.5|6).+Win/.test(navigator.userAgent)) {
		var src;
		if (element.tagName == 'IMG') {
			if (/\.png$/.test(element.src)) {
				src = element.src;
				element.src = GetStyleUrl() + 'images/spacer.gif';
			}
		}
		else {
			src = element.currentStyle.backgroundImage.match(/url\("(.+\.png)"\)/i);
			if (src) {
				src = src[1];
				element.runtimeStyle.backgroundImage = 'none';
			}
		}
		if (src) element.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "')";
	}
}

function artHasClass(el, cls) {
    return (el && el.className && (' ' + el.className + ' ').indexOf(' ' + cls + ' ') != -1);
}/* end Page */

/* begin Menu */
function Insert_Separators() {
	var menus = xGetElementsByClassName("art-menu", document);
	for (var i = 0; i < menus.length; i++) {
		var menu = menus[i];
		var childs = menu.childNodes;
		var listItems = [];
		for (var j = 0; j < childs.length; j++) {
			var el = childs[j];
			if (String(el.tagName).toLowerCase() == "li") listItems.push(el);
		}
		for (var j = 0; j < listItems.length - 1; j++) {
			var span = document.createElement('span');
			span.className = 'art-menu-separator';
			var li = document.createElement('li');
			li.appendChild(span);
			listItems[j].parentNode.insertBefore(li, listItems[j].nextSibling);
		}
	}
}
artLoadEvent.add(Insert_Separators);

function Menu_IE6Setup() {
	var isIE6 = navigator.userAgent.toLowerCase().indexOf("msie") != -1
    && navigator.userAgent.toLowerCase().indexOf("msie 7") == -1;
	if (!isIE6) return;
	var aTmp2, i, j, oLI, aUL, aA;
	var aTmp = xGetElementsByClassName("art-menu", document, "ul");
	for (i = 0; i < aTmp.length; i++) {
		aTmp2 = aTmp[i].getElementsByTagName("li");
		for (j = 0; j < aTmp2.length; j++) {
			oLI = aTmp2[j];
			aUL = oLI.getElementsByTagName("ul");
			if (aUL && aUL.length) {
				oLI.UL = aUL[0];
				aA = oLI.getElementsByTagName("a");
				if (aA && aA.length)
					oLI.A = aA[0];
				oLI.onmouseenter = function() {
					this.className += " art-menuhover";
					this.UL.className += " art-menuhoverUL";
					if (this.A) this.A.className += " art-menuhoverA";
				};
				oLI.onmouseleave = function() {
					this.className = this.className.replace(/art-menuhover/, "");
					this.UL.className = this.UL.className.replace(/art-menuhoverUL/, "");
					if (this.A) this.A.className = this.A.className.replace(/art-menuhoverA/, "");
				};
			}
		}
	}
}
artLoadEvent.add(Menu_IE6Setup);
/* end Menu */

/* begin Button */
function artButtonsSetupJsHover(className) {
	var tags = ["input", "a", "button"];
	for (var j = 0; j < tags.length; j++){
		var buttons = xGetElementsByClassName(className, document, tags[j]);
		for (var i = 0; i < buttons.length; i++) {
			var button = buttons[i];
			if (!button.tagName || !button.parentNode) return;
			if (!artHasClass(button.parentNode, 'art-button-wrapper')) {
				if (!artHasClass(button, 'art-button')) button.className += ' art-button';
				var wrapper = document.createElement('span');
				wrapper.className = "art-button-wrapper";
				if (artHasClass(button, 'active')) wrapper.className += ' active';
				var spanL = document.createElement('span');
				spanL.className = "l";
				spanL.innerHTML = " ";
				wrapper.appendChild(spanL);
				var spanR = document.createElement('span');
				spanR.className = "r";
				spanR.innerHTML = " ";
				wrapper.appendChild(spanR);
				button.parentNode.insertBefore(wrapper, button);
				wrapper.appendChild(button);
			}
			artEventHelper.bind(button, 'mouseover', function(e) {
				e = e || window.event;
				wrapper = (e.target || e.srcElement).parentNode;
				wrapper.className += " hover";
			});
			artEventHelper.bind(button, 'mouseout', function(e) {
				e = e || window.event;
				button = e.target || e.srcElement;
				wrapper = button.parentNode;
				wrapper.className = wrapper.className.replace(/hover/, "");
				if (!artHasClass(button, 'active')) wrapper.className = wrapper.className.replace(/active/, "");
			});
			artEventHelper.bind(button, 'mousedown', function(e) {
				e = e || window.event;
				button = e.target || e.srcElement;
				wrapper = button.parentNode;
				if (!artHasClass(button, 'active')) wrapper.className += " active";
			});
			artEventHelper.bind(button, 'mouseup', function(e) {
				e = e || window.event;
				button = e.target || e.srcElement;
				wrapper = button.parentNode;
				if (!artHasClass(button, 'active')) wrapper.className = wrapper.className.replace(/active/, "");
			});
		}
	}
}
artLoadEvent.add(function() { artButtonsSetupJsHover("art-button"); });
/* end Button */


