/* this is not directly used - compress it as rvtree-min.js on http://javascriptcompressor.com/ or http://closure-compiler.appspot.com
Based on Matt Kruse <matt@mattkruse.com> http://www.mattkruse.com/ */
var XElement = {
	hasClass: function(element, className) {
		if (!element) return false;
		var elementClassName = element.className;
		return ( elementClassName.length > 0 && (elementClassName == className ||
						new RegExp("(^|\\s)" + className + "(\\s|$)").test(elementClassName)) );
	},

	addClass: function(element, className) {
		if (!element) return;
		if (!XElement.hasClass(element, className))
				element.className += (element.className ? ' ' : '') + className;
		return element;
	},

	toggleClasses: function(element, class1, class2) {
		if (!element) return;
		var classNames = element.className.split(/\s+/);
		var i1=-1, i2=-1;
		for (var i=0; i<classNames.length; i++)
		{
				if (classNames[i]==class1) i1=i;
				if (classNames[i]==class2) i2=i;
		}
		if (i1>=0)
		{
				classNames.splice(i1,1);
				if (i2>=i1)
						i2--;
		}
		else
				classNames.push(class1);
	 
		if (i2>=0)
				classNames.splice(i2,1);
		else
				classNames.push(class2);
		element.className = classNames.join(' ');
		return element;
	}
};

var RVTree =
{
	options :
	{
		nodeClosedClass: "liClosed",
		nodeOpenClass: "liOpen",
		nodeBulletClass: "liBullet",
		nodeLinkClass: "bullet"
	},

	convertTree: function (root)
	{
		if (!document.createElement)
			return; // Without createElement, we can't do anything
		if (window.attachEvent && !window.opera)
		{
			if ( new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})").exec( navigator.userAgent ) != null )
				RVTree.options.IEVersion = parseFloat( RegExp.$1 );
		}
		RVTree._processList(root, true);
	},

	_processList: function(ul, isRoot)
	{
		if (!ul.childNodes || ul.childNodes.length==0) 
			return;

		for (var i=0; i<ul.childNodes.length; i++)
		{ //Iterate LIs
			var item = ul.childNodes[i];
			if (item.nodeName != "LI")
				continue;

			// Iterate things in this LI
			var subLists = false;
			for (var sitemi=0;sitemi<item.childNodes.length;sitemi++)
			{
				var sitem = item.childNodes[sitemi];
				if (sitem.nodeName=="UL")
				{
					subLists = true;
					RVTree._processList(sitem, false);
				}
			}

			var s= document.createElement("SPAN");
			var t= '\u00A0'; // &nbsp;
			s.className = RVTree.options.nodeLinkClass;
			if (subLists)
			{
				// This LI has UL's in it, so it's a +/- node
				if ( !XElement.hasClass(item, RVTree.options.nodeOpenClass) )
					XElement.addClass(item, RVTree.options.nodeClosedClass);

				// If it's just text, make the text work as the link also
				if (item.firstChild.nodeName=="#text")
				{
					t = t+item.firstChild.nodeValue;
					item.removeChild(item.firstChild);
				}
				s.onclick = function ()
				{
					XElement.toggleClasses(this.parentNode, RVTree.options.nodeOpenClass, RVTree.options.nodeClosedClass );
					return false;
				}
			}
			else
			{// No sublists
				if ( XElement.hasClass(item, RVTree.options.nodeClosedClass) )
				{
					s.onclick = function()
					{
						var nodes = this.parentNode.getElementsByTagName("A");
						if (nodes.length)
							document.location = nodes[0].href;
					}
				}
				else
					XElement.addClass(item, RVTree.options.nodeBulletClass);
			}

			item.style.listStyleType='none';
			if (isRoot && RVTree.options.IEVersion && RVTree.options.IEVersion < 8)
				item.style.marginLeft="-16px"; // thats IE6,IE7 ; IE8 seems more compliant
			if (s)
			{
				s.appendChild(document.createTextNode(t));
				item.insertBefore(s,item.firstChild);
			}
		}
		ul.style.marginLeft = 0;
		ul.style.paddingLeft = isRoot ? 0 : "8px";
	}
};

(function() {
	if (typeof _rvTreeAutoQueue != "undefined" && _rvTreeAutoQueue.length)
	{
			for (var i=0; i<_rvTreeAutoQueue.length; i++)
					RVTree.convertTree(_rvTreeAutoQueue[i]);
	}
	_rvTreeAutoQueue = {
		push: function(elt) {
			RVTree.convertTree(elt);
		}
	}
})();
