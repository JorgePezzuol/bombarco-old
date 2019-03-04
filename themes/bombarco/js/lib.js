/* Modernizr 2.8.3 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-multiplebgs-opacity-rgba-textshadow-cssanimations-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-inlinesvg-svg-shiv-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes-load-cssclassprefix:mdzr_
 */
;window.Modernizr=function(a,b,c){function B(a){j.cssText=a}function C(a,b){return B(n.join(a+";")+(b||""))}function D(a,b){return typeof a===b}function E(a,b){return!!~(""+a).indexOf(b)}function F(a,b){for(var d in a){var e=a[d];if(!E(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function G(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:D(f,"function")?f.bind(d||b):f}return!1}function H(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+p.join(d+" ")+d).split(" ");return D(b,"string")||D(b,"undefined")?F(e,b):(e=(a+" "+q.join(d+" ")+d).split(" "),G(e,b,c))}var d="2.8.3",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l=":)",m={}.toString,n=" -webkit- -moz- -o- -ms- ".split(" "),o="Webkit Moz O ms",p=o.split(" "),q=o.toLowerCase().split(" "),r={svg:"http://www.w3.org/2000/svg"},s={},t={},u={},v=[],w=v.slice,x,y=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},z={}.hasOwnProperty,A;!D(z,"undefined")&&!D(z.call,"undefined")?A=function(a,b){return z.call(a,b)}:A=function(a,b){return b in a&&D(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=w.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(w.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(w.call(arguments)))};return e}),s.rgba=function(){return B("background-color:rgba(150,255,150,.5)"),E(j.backgroundColor,"rgba")},s.multiplebgs=function(){return B("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(j.background)},s.backgroundsize=function(){return H("backgroundSize")},s.borderimage=function(){return H("borderImage")},s.borderradius=function(){return H("borderRadius")},s.boxshadow=function(){return H("boxShadow")},s.textshadow=function(){return b.createElement("div").style.textShadow===""},s.opacity=function(){return C("opacity:.55"),/^0.55$/.test(j.opacity)},s.cssanimations=function(){return H("animationName")},s.cssgradients=function(){var a="background-image:",b="gradient(linear,left top,right bottom,from(#9f9),to(white));",c="linear-gradient(left top,#9f9, white);";return B((a+"-webkit- ".split(" ").join(b+a)+n.join(c+a)).slice(0,-a.length)),E(j.backgroundImage,"gradient")},s.cssreflections=function(){return H("boxReflect")},s.csstransforms=function(){return!!H("transform")},s.csstransforms3d=function(){var a=!!H("perspective");return a&&"webkitPerspective"in g.style&&y("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},s.csstransitions=function(){return H("transition")},s.fontface=function(){var a;return y('@font-face {font-family:"font";src:url("https://")}',function(c,d){var e=b.getElementById("smodernizr"),f=e.sheet||e.styleSheet,g=f?f.cssRules&&f.cssRules[0]?f.cssRules[0].cssText:f.cssText||"":"";a=/src/i.test(g)&&g.indexOf(d.split(" ")[0])===0}),a},s.generatedcontent=function(){var a;return y(["#",h,"{font:0/0 a}#",h,':after{content:"',l,'";visibility:hidden;font:3px/1 a}'].join(""),function(b){a=b.offsetHeight>=3}),a},s.svg=function(){return!!b.createElementNS&&!!b.createElementNS(r.svg,"svg").createSVGRect},s.inlinesvg=function(){var a=b.createElement("div");return a.innerHTML="<svg/>",(a.firstChild&&a.firstChild.namespaceURI)==r.svg};for(var I in s)A(s,I)&&(x=I.toLowerCase(),e[x]=s[I](),v.push((e[x]?"":"no-")+x));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)A(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" mdzr_"+(b?"":"no-")+a),e[a]=b}return e},B(""),i=k=null,function(a,b){function l(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function m(){var a=s.elements;return typeof a=="string"?a.split(" "):a}function n(a){var b=j[a[h]];return b||(b={},i++,a[h]=i,j[i]=b),b}function o(a,c,d){c||(c=b);if(k)return c.createElement(a);d||(d=n(c));var g;return d.cache[a]?g=d.cache[a].cloneNode():f.test(a)?g=(d.cache[a]=d.createElem(a)).cloneNode():g=d.createElem(a),g.canHaveChildren&&!e.test(a)&&!g.tagUrn?d.frag.appendChild(g):g}function p(a,c){a||(a=b);if(k)return a.createDocumentFragment();c=c||n(a);var d=c.frag.cloneNode(),e=0,f=m(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function q(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return s.shivMethods?o(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(s,b.frag)}function r(a){a||(a=b);var c=n(a);return s.shivCSS&&!g&&!c.hasCSS&&(c.hasCSS=!!l(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),k||q(a,c),a}var c="3.7.0",d=a.html5||{},e=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,f=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g,h="_html5shiv",i=0,j={},k;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",g="hidden"in a,k=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){g=!0,k=!0}})();var s={elements:d.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:c,shivCSS:d.shivCSS!==!1,supportsUnknownElements:k,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:r,createElement:o,createDocumentFragment:p};a.html5=s,r(b)}(this,b),e._version=d,e._prefixes=n,e._domPrefixes=q,e._cssomPrefixes=p,e.testProp=function(a){return F([a])},e.testAllProps=H,e.testStyles=y,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" mdzr_js mdzr_"+v.join(" mdzr_"):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};





/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
    def: 'easeOutQuad',
    swing: function (x, t, b, c, d) {
        //alert(jQuery.easing.default);
        return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
    },
    easeInQuad: function (x, t, b, c, d) {
        return c*(t/=d)*t + b;
    },
    easeOutQuad: function (x, t, b, c, d) {
        return -c *(t/=d)*(t-2) + b;
    },
    easeInOutQuad: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t + b;
        return -c/2 * ((--t)*(t-2) - 1) + b;
    },
    easeInCubic: function (x, t, b, c, d) {
        return c*(t/=d)*t*t + b;
    },
    easeOutCubic: function (x, t, b, c, d) {
        return c*((t=t/d-1)*t*t + 1) + b;
    },
    easeInOutCubic: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t + b;
        return c/2*((t-=2)*t*t + 2) + b;
    },
    easeInQuart: function (x, t, b, c, d) {
        return c*(t/=d)*t*t*t + b;
    },
    easeOutQuart: function (x, t, b, c, d) {
        return -c * ((t=t/d-1)*t*t*t - 1) + b;
    },
    easeInOutQuart: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
        return -c/2 * ((t-=2)*t*t*t - 2) + b;
    },
    easeInQuint: function (x, t, b, c, d) {
        return c*(t/=d)*t*t*t*t + b;
    },
    easeOutQuint: function (x, t, b, c, d) {
        return c*((t=t/d-1)*t*t*t*t + 1) + b;
    },
    easeInOutQuint: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
        return c/2*((t-=2)*t*t*t*t + 2) + b;
    },
    easeInSine: function (x, t, b, c, d) {
        return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
    },
    easeOutSine: function (x, t, b, c, d) {
        return c * Math.sin(t/d * (Math.PI/2)) + b;
    },
    easeInOutSine: function (x, t, b, c, d) {
        return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
    },
    easeInExpo: function (x, t, b, c, d) {
        return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
    },
    easeOutExpo: function (x, t, b, c, d) {
        return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
    },
    easeInOutExpo: function (x, t, b, c, d) {
        if (t==0) return b;
        if (t==d) return b+c;
        if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
        return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
    },
    easeInCirc: function (x, t, b, c, d) {
        return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
    },
    easeOutCirc: function (x, t, b, c, d) {
        return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
    },
    easeInOutCirc: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
        return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
    },
    easeInElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
    },
    easeOutElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
    },
    easeInOutElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
        return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
    },
    easeInBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c*(t/=d)*t*((s+1)*t - s) + b;
    },
    easeOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
    },
    easeInOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158; 
        if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
        return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
    },
    easeInBounce: function (x, t, b, c, d) {
        return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
    },
    easeOutBounce: function (x, t, b, c, d) {
        if ((t/=d) < (1/2.75)) {
            return c*(7.5625*t*t) + b;
        } else if (t < (2/2.75)) {
            return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
        } else if (t < (2.5/2.75)) {
            return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
        } else {
            return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
        }
    },
    easeInOutBounce: function (x, t, b, c, d) {
        if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
        return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
    }
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */







/**
 * BxSlider v4.1.1 - Fully loaded, responsive content slider
 * http://bxslider.com
 *
 * Copyright 2013, Steven Wanderski - http://stevenwanderski.com - http://bxcreative.com
 * Written while drinking Belgian ales and listening to jazz
 *
 * Released under the MIT license - http://opensource.org/licenses/MIT
 */

;(function($){

    var plugin = {};

    var defaults = {

        // GENERAL
        mode: 'horizontal',
        slideSelector: '',
        infiniteLoop: true,
        hideControlOnEnd: false,
        speed: 500,
        easing: null,
        slideMargin: 0,
        startSlide: 0,
        randomStart: false,
        captions: false,
        ticker: false,
        tickerHover: false,
        adaptiveHeight: false,
        adaptiveHeightSpeed: 500,
        video: false,
        useCSS: true,
        preloadImages: 'visible',
        responsive: true,

        // TOUCH
        touchEnabled: true,
        swipeThreshold: 50,
        oneToOneTouch: true,
        preventDefaultSwipeX: true,
        preventDefaultSwipeY: false,

        // PAGER
        pager: true,
        pagerType: 'full',
        pagerShortSeparator: ' / ',
        pagerSelector: null,
        buildPager: null,
        pagerCustom: null,

        // CONTROLS
        controls: true,
        nextText: 'Next',
        prevText: 'Prev',
        nextSelector: null,
        prevSelector: null,
        autoControls: false,
        startText: 'Start',
        stopText: 'Stop',
        autoControlsCombine: false,
        autoControlsSelector: null,

        // AUTO
        auto: false,
        pause: 4000,
        autoStart: true,
        autoDirection: 'next',
        autoHover: false,
        autoDelay: 0,

        // CAROUSEL
        minSlides: 1,
        maxSlides: 1,
        moveSlides: 0,
        slideWidth: 0,

        // CALLBACKS
        onSliderLoad: function() {},
        onSlideBefore: function() {},
        onSlideAfter: function() {},
        onSlideNext: function() {},
        onSlidePrev: function() {}
    }

    $.fn.bxSlider = function(options){

        if(this.length == 0) return this;

        // support mutltiple elements
        if(this.length > 1){
            this.each(function(){$(this).bxSlider(options)});
            return this;
        }

        // create a namespace to be used throughout the plugin
        var slider = {};
        // set a reference to our slider element
        var el = this;
        plugin.el = this;

        /**
         * Makes slideshow responsive
         */
        // first get the original window dimens (thanks alot IE)
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();



        /**
         * ===================================================================================
         * = PRIVATE FUNCTIONS
         * ===================================================================================
         */

        /**
         * Initializes namespace settings to be used throughout plugin
         */
        var init = function(){
            // merge user-supplied options with the defaults
            slider.settings = $.extend({}, defaults, options);
            // parse slideWidth setting
            slider.settings.slideWidth = parseInt(slider.settings.slideWidth);
            // store the original children
            slider.children = el.children(slider.settings.slideSelector);
            // check if actual number of slides is less than minSlides / maxSlides
            if(slider.children.length < slider.settings.minSlides) slider.settings.minSlides = slider.children.length;
            if(slider.children.length < slider.settings.maxSlides) slider.settings.maxSlides = slider.children.length;
            // if random start, set the startSlide setting to random number
            if(slider.settings.randomStart) slider.settings.startSlide = Math.floor(Math.random() * slider.children.length);
            // store active slide information
            slider.active = { index: slider.settings.startSlide }
            // store if the slider is in carousel mode (displaying / moving multiple slides)
            slider.carousel = slider.settings.minSlides > 1 || slider.settings.maxSlides > 1;
            // if carousel, force preloadImages = 'all'
            if(slider.carousel) slider.settings.preloadImages = 'all';
            // calculate the min / max width thresholds based on min / max number of slides
            // used to setup and update carousel slides dimensions
            slider.minThreshold = (slider.settings.minSlides * slider.settings.slideWidth) + ((slider.settings.minSlides - 1) * slider.settings.slideMargin);
            slider.maxThreshold = (slider.settings.maxSlides * slider.settings.slideWidth) + ((slider.settings.maxSlides - 1) * slider.settings.slideMargin);
            // store the current state of the slider (if currently animating, working is true)
            slider.working = false;
            // initialize the controls object
            slider.controls = {};
            // initialize an auto interval
            slider.interval = null;
            // determine which property to use for transitions
            slider.animProp = slider.settings.mode == 'vertical' ? 'top' : 'left';
            // determine if hardware acceleration can be used
            slider.usingCSS = slider.settings.useCSS && slider.settings.mode != 'fade' && (function(){
                // create our test div element
                var div = document.createElement('div');
                // css transition properties
                var props = ['WebkitPerspective', 'MozPerspective', 'OPerspective', 'msPerspective'];
                // test for each property
                for(var i in props){
                    if(div.style[props[i]] !== undefined){
                        slider.cssPrefix = props[i].replace('Perspective', '').toLowerCase();
                        slider.animProp = '-' + slider.cssPrefix + '-transform';
                        return true;
                    }
                }
                return false;
            }());
            // if vertical mode always make maxSlides and minSlides equal
            if(slider.settings.mode == 'vertical') slider.settings.maxSlides = slider.settings.minSlides;
            // save original style data
            el.data("origStyle", el.attr("style"));
            el.children(slider.settings.slideSelector).each(function() {
              $(this).data("origStyle", $(this).attr("style"));
            });
            // perform all DOM / CSS modifications
            setup();
        }

        /**
         * Performs all DOM and CSS modifications
         */
        var setup = function(){
            // wrap el in a wrapper
            el.wrap('<div class="bx-wrapper"><div class="bx-viewport"></div></div>');
            // store a namspace reference to .bx-viewport
            slider.viewport = el.parent();
            // add a loading div to display while images are loading
            slider.loader = $('<div class="bx-loading" />');
            slider.viewport.prepend(slider.loader);
            // set el to a massive width, to hold any needed slides
            // also strip any margin and padding from el
            el.css({
                width: slider.settings.mode == 'horizontal' ? (slider.children.length * 100 + 215) + '%' : 'auto',
                position: 'relative'
            });
            // if using CSS, add the easing property
            if(slider.usingCSS && slider.settings.easing){
                el.css('-' + slider.cssPrefix + '-transition-timing-function', slider.settings.easing);
            // if not using CSS and no easing value was supplied, use the default JS animation easing (swing)
            }else if(!slider.settings.easing){
                slider.settings.easing = 'swing';
            }
            var slidesShowing = getNumberSlidesShowing();
            // make modifications to the viewport (.bx-viewport)
            slider.viewport.css({
                width: '100%',
                overflow: 'hidden',
                position: 'relative'
            });
            slider.viewport.parent().css({
                maxWidth: getViewportMaxWidth()
            });
            // make modification to the wrapper (.bx-wrapper)
            if(!slider.settings.pager) {
                slider.viewport.parent().css({
                margin: '0 auto 0px'
                });
            }
            // apply css to all slider children
            slider.children.css({
                'float': slider.settings.mode == 'horizontal' ? 'left' : 'none',
                listStyle: 'none',
                position: 'relative'
            });
            // apply the calculated width after the float is applied to prevent scrollbar interference
            slider.children.css('width', getSlideWidth());
            // if slideMargin is supplied, add the css
            if(slider.settings.mode == 'horizontal' && slider.settings.slideMargin > 0) slider.children.css('marginRight', slider.settings.slideMargin);
            if(slider.settings.mode == 'vertical' && slider.settings.slideMargin > 0) slider.children.css('marginBottom', slider.settings.slideMargin);
            // if "fade" mode, add positioning and z-index CSS
            if(slider.settings.mode == 'fade'){
                slider.children.css({
                    position: 'absolute',
                    zIndex: 0,
                    display: 'none'
                });
                // prepare the z-index on the showing element
                slider.children.eq(slider.settings.startSlide).css({zIndex: 50, display: 'block'});
            }
            // create an element to contain all slider controls (pager, start / stop, etc)
            slider.controls.el = $('<div class="bx-controls" />');
            // if captions are requested, add them
            if(slider.settings.captions) appendCaptions();
            // check if startSlide is last slide
            slider.active.last = slider.settings.startSlide == getPagerQty() - 1;
            // if video is true, set up the fitVids plugin
            if(slider.settings.video) el.fitVids();
            // set the default preload selector (visible)
            var preloadSelector = slider.children.eq(slider.settings.startSlide);
            if (slider.settings.preloadImages == "all") preloadSelector = slider.children;
            // only check for control addition if not in "ticker" mode
            if(!slider.settings.ticker){
                // if pager is requested, add it
                if(slider.settings.pager) appendPager();
                // if controls are requested, add them
                if(slider.settings.controls) appendControls();
                // if auto is true, and auto controls are requested, add them
                if(slider.settings.auto && slider.settings.autoControls) appendControlsAuto();
                // if any control option is requested, add the controls wrapper
                if(slider.settings.controls || slider.settings.autoControls || slider.settings.pager) slider.viewport.after(slider.controls.el);
            // if ticker mode, do not allow a pager
            }else{
                slider.settings.pager = false;
            }
            // preload all images, then perform final DOM / CSS modifications that depend on images being loaded
            loadElements(preloadSelector, start);
        }

        var loadElements = function(selector, callback){
            var total = selector.find('img, iframe').length;
            if (total == 0){
                callback();
                return;
            }
            var count = 0;
            selector.find('img, iframe').each(function(){
                $(this).one('load', function() {
                  if(++count == total) callback();
                }).each(function() {
                  if(this.complete) $(this).load();
                });
            });
        }

        /**
         * Start the slider
         */
        var start = function(){
            // if infinite loop, prepare additional slides
            if(slider.settings.infiniteLoop && slider.settings.mode != 'fade' && !slider.settings.ticker){
                var slice = slider.settings.mode == 'vertical' ? slider.settings.minSlides : slider.settings.maxSlides;
                var sliceAppend = slider.children.slice(0, slice).clone().addClass('bx-clone');
                var slicePrepend = slider.children.slice(-slice).clone().addClass('bx-clone');
                el.append(sliceAppend).prepend(slicePrepend);
            }
            // remove the loading DOM element
            slider.loader.remove();
            // set the left / top position of "el"
            setSlidePosition();
            // if "vertical" mode, always use adaptiveHeight to prevent odd behavior
            if (slider.settings.mode == 'vertical') slider.settings.adaptiveHeight = true;
            // set the viewport height
            slider.viewport.height(getViewportHeight());
            // make sure everything is positioned just right (same as a window resize)
            el.redrawSlider();
            // onSliderLoad callback
            slider.settings.onSliderLoad(slider.active.index);
            // slider has been fully initialized
            slider.initialized = true;
            // bind the resize call to the window
            if (slider.settings.responsive) $(window).bind('resize', resizeWindow);
            // if auto is true, start the show
            if (slider.settings.auto && slider.settings.autoStart) initAuto();
            // if ticker is true, start the ticker
            if (slider.settings.ticker) initTicker();
            // if pager is requested, make the appropriate pager link active
            if (slider.settings.pager) updatePagerActive(slider.settings.startSlide);
            // check for any updates to the controls (like hideControlOnEnd updates)
            if (slider.settings.controls) updateDirectionControls();
            // if touchEnabled is true, setup the touch events
            if (slider.settings.touchEnabled && !slider.settings.ticker) initTouch();
        }

        /**
         * Returns the calculated height of the viewport, used to determine either adaptiveHeight or the maxHeight value
         */
        var getViewportHeight = function(){
            var height = 0;
            // first determine which children (slides) should be used in our height calculation
            var children = $();
            // if mode is not "vertical" and adaptiveHeight is false, include all children
            if(slider.settings.mode != 'vertical' && !slider.settings.adaptiveHeight){
                children = slider.children;
            }else{
                // if not carousel, return the single active child
                if(!slider.carousel){
                    children = slider.children.eq(slider.active.index);
                // if carousel, return a slice of children
                }else{
                    // get the individual slide index
                    var currentIndex = slider.settings.moveSlides == 1 ? slider.active.index : slider.active.index * getMoveBy();
                    // add the current slide to the children
                    children = slider.children.eq(currentIndex);
                    // cycle through the remaining "showing" slides
                    for (i = 1; i <= slider.settings.maxSlides - 1; i++){
                        // if looped back to the start
                        if(currentIndex + i >= slider.children.length){
                            children = children.add(slider.children.eq(i - 1));
                        }else{
                            children = children.add(slider.children.eq(currentIndex + i));
                        }
                    }
                }
            }
            // if "vertical" mode, calculate the sum of the heights of the children
            if(slider.settings.mode == 'vertical'){
                children.each(function(index) {
                  height += $(this).outerHeight();
                });
                // add user-supplied margins
                if(slider.settings.slideMargin > 0){
                    height += slider.settings.slideMargin * (slider.settings.minSlides - 1);
                }
            // if not "vertical" mode, calculate the max height of the children
            }else{
                height = Math.max.apply(Math, children.map(function(){
                    return $(this).outerHeight(false);
                }).get());
            }
            return height;
        }

        /**
         * Returns the calculated width to be used for the outer wrapper / viewport
         */
        var getViewportMaxWidth = function(){
            var width = '100%';
            if(slider.settings.slideWidth > 0){
                if(slider.settings.mode == 'horizontal'){
                    width = (slider.settings.maxSlides * slider.settings.slideWidth) + ((slider.settings.maxSlides - 1) * slider.settings.slideMargin);
                }else{
                    width = slider.settings.slideWidth;
                }
            }
            return width;
        }

        /**
         * Returns the calculated width to be applied to each slide
         */
        var getSlideWidth = function(){
            // start with any user-supplied slide width
            var newElWidth = slider.settings.slideWidth;
            // get the current viewport width
            var wrapWidth = slider.viewport.width();
            // if slide width was not supplied, or is larger than the viewport use the viewport width
            if(slider.settings.slideWidth == 0 ||
                (slider.settings.slideWidth > wrapWidth && !slider.carousel) ||
                slider.settings.mode == 'vertical'){
                newElWidth = wrapWidth;
            // if carousel, use the thresholds to determine the width
            }else if(slider.settings.maxSlides > 1 && slider.settings.mode == 'horizontal'){
                if(wrapWidth > slider.maxThreshold){
                    // newElWidth = (wrapWidth - (slider.settings.slideMargin * (slider.settings.maxSlides - 1))) / slider.settings.maxSlides;
                }else if(wrapWidth < slider.minThreshold){
                    newElWidth = (wrapWidth - (slider.settings.slideMargin * (slider.settings.minSlides - 1))) / slider.settings.minSlides;
                }
            }
            return newElWidth;
        }

        /**
         * Returns the number of slides currently visible in the viewport (includes partially visible slides)
         */
        var getNumberSlidesShowing = function(){
            var slidesShowing = 1;
            if(slider.settings.mode == 'horizontal' && slider.settings.slideWidth > 0){
                // if viewport is smaller than minThreshold, return minSlides
                if(slider.viewport.width() < slider.minThreshold){
                    slidesShowing = slider.settings.minSlides;
                // if viewport is larger than minThreshold, return maxSlides
                }else if(slider.viewport.width() > slider.maxThreshold){
                    slidesShowing = slider.settings.maxSlides;
                // if viewport is between min / max thresholds, divide viewport width by first child width
                }else{
                    var childWidth = slider.children.first().width();
                    slidesShowing = Math.floor(slider.viewport.width() / childWidth);
                }
            // if "vertical" mode, slides showing will always be minSlides
            }else if(slider.settings.mode == 'vertical'){
                slidesShowing = slider.settings.minSlides;
            }
            return slidesShowing;
        }

        /**
         * Returns the number of pages (one full viewport of slides is one "page")
         */
        var getPagerQty = function(){
            var pagerQty = 0;
            // if moveSlides is specified by the user
            if(slider.settings.moveSlides > 0){
                if(slider.settings.infiniteLoop){
                    pagerQty = slider.children.length / getMoveBy();
                }else{
                    // use a while loop to determine pages
                    var breakPoint = 0;
                    var counter = 0
                    // when breakpoint goes above children length, counter is the number of pages
                    while (breakPoint < slider.children.length){
                        ++pagerQty;
                        breakPoint = counter + getNumberSlidesShowing();
                        counter += slider.settings.moveSlides <= getNumberSlidesShowing() ? slider.settings.moveSlides : getNumberSlidesShowing();
                    }
                }
            // if moveSlides is 0 (auto) divide children length by sides showing, then round up
            }else{
                pagerQty = Math.ceil(slider.children.length / getNumberSlidesShowing());
            }
            return pagerQty;
        }

        /**
         * Returns the number of indivual slides by which to shift the slider
         */
        var getMoveBy = function(){
            // if moveSlides was set by the user and moveSlides is less than number of slides showing
            if(slider.settings.moveSlides > 0 && slider.settings.moveSlides <= getNumberSlidesShowing()){
                return slider.settings.moveSlides;
            }
            // if moveSlides is 0 (auto)
            return getNumberSlidesShowing();
        }

        /**
         * Sets the slider's (el) left or top position
         */
        var setSlidePosition = function(){
            // if last slide, not infinite loop, and number of children is larger than specified maxSlides
            if(slider.children.length > slider.settings.maxSlides && slider.active.last && !slider.settings.infiniteLoop){
                if (slider.settings.mode == 'horizontal'){
                    // get the last child's position
                    var lastChild = slider.children.last();
                    var position = lastChild.position();
                    // set the left position
                    setPositionProperty(-(position.left - (slider.viewport.width() - lastChild.width())), 'reset', 0);
                }else if(slider.settings.mode == 'vertical'){
                    // get the last showing index's position
                    var lastShowingIndex = slider.children.length - slider.settings.minSlides;
                    var position = slider.children.eq(lastShowingIndex).position();
                    // set the top position
                    setPositionProperty(-position.top, 'reset', 0);
                }
            // if not last slide
            }else{
                // get the position of the first showing slide
                var position = slider.children.eq(slider.active.index * getMoveBy()).position();
                // check for last slide
                if (slider.active.index == getPagerQty() - 1) slider.active.last = true;
                // set the repective position
                if (position != undefined){
                    if (slider.settings.mode == 'horizontal') setPositionProperty(-position.left, 'reset', 0);
                    else if (slider.settings.mode == 'vertical') setPositionProperty(-position.top, 'reset', 0);
                }
            }
        }

        /**
         * Sets the el's animating property position (which in turn will sometimes animate el).
         * If using CSS, sets the transform property. If not using CSS, sets the top / left property.
         *
         * @param value (int)
         *  - the animating property's value
         *
         * @param type (string) 'slider', 'reset', 'ticker'
         *  - the type of instance for which the function is being
         *
         * @param duration (int)
         *  - the amount of time (in ms) the transition should occupy
         *
         * @param params (array) optional
         *  - an optional parameter containing any variables that need to be passed in
         */
        var setPositionProperty = function(value, type, duration, params){
            // use CSS transform
            if(slider.usingCSS){
                // determine the translate3d value
                var propValue = slider.settings.mode == 'vertical' ? 'translate3d(0, ' + value + 'px, 0)' : 'translate3d(' + value + 'px, 0, 0)';
                // add the CSS transition-duration
                el.css('-' + slider.cssPrefix + '-transition-duration', duration / 1000 + 's');
                if(type == 'slide'){
                    // set the property value
                    el.css(slider.animProp, propValue);
                    // bind a callback method - executes when CSS transition completes
                    el.bind('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(){
                        // unbind the callback
                        el.unbind('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd');
                        updateAfterSlideTransition();
                    });
                }else if(type == 'reset'){
                    el.css(slider.animProp, propValue);
                }else if(type == 'ticker'){
                    // make the transition use 'linear'
                    el.css('-' + slider.cssPrefix + '-transition-timing-function', 'linear');
                    el.css(slider.animProp, propValue);
                    // bind a callback method - executes when CSS transition completes
                    el.bind('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(){
                        // unbind the callback
                        el.unbind('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd');
                        // reset the position
                        setPositionProperty(params['resetValue'], 'reset', 0);
                        // start the loop again
                        tickerLoop();
                    });
                }
            // use JS animate
            }else{
                var animateObj = {};
                animateObj[slider.animProp] = value;
                if(type == 'slide'){
                    el.animate(animateObj, duration, slider.settings.easing, function(){
                        updateAfterSlideTransition();
                    });
                }else if(type == 'reset'){
                    el.css(slider.animProp, value)
                }else if(type == 'ticker'){
                    el.animate(animateObj, speed, 'linear', function(){
                        setPositionProperty(params['resetValue'], 'reset', 0);
                        // run the recursive loop after animation
                        tickerLoop();
                    });
                }
            }
        }

        /**
         * Populates the pager with proper amount of pages
         */
        var populatePager = function(){
            var pagerHtml = '';
            var pagerQty = getPagerQty();
            // loop through each pager item
            for(var i=0; i < pagerQty; i++){
                var linkContent = '';
                // if a buildPager function is supplied, use it to get pager link value, else use index + 1
                if(slider.settings.buildPager && $.isFunction(slider.settings.buildPager)){
                    linkContent = slider.settings.buildPager(i);
                    slider.pagerEl.addClass('bx-custom-pager');
                }else{
                    linkContent = i + 1;
                    slider.pagerEl.addClass('bx-default-pager');
                }
                // var linkContent = slider.settings.buildPager && $.isFunction(slider.settings.buildPager) ? slider.settings.buildPager(i) : i + 1;
                // add the markup to the string
                pagerHtml += '<div class="bx-pager-item"><a href="" data-slide-index="' + i + '" class="bx-pager-link">' + linkContent + '</a></div>';
            };
            // populate the pager element with pager links
            slider.pagerEl.html(pagerHtml);
        }

        /**
         * Appends the pager to the controls element
         */
        var appendPager = function(){
            if(!slider.settings.pagerCustom){
                // create the pager DOM element
                slider.pagerEl = $('<div class="bx-pager" />');
                // if a pager selector was supplied, populate it with the pager
                if(slider.settings.pagerSelector){
                    $(slider.settings.pagerSelector).html(slider.pagerEl);
                // if no pager selector was supplied, add it after the wrapper
                }else{
                    slider.controls.el.addClass('bx-has-pager').append(slider.pagerEl);
                }
                // populate the pager
                populatePager();
            }else{
                slider.pagerEl = $(slider.settings.pagerCustom);
            }
            // assign the pager click binding
            slider.pagerEl.delegate('a', 'click', clickPagerBind);
        }

        /**
         * Appends prev / next controls to the controls element
         */
        var appendControls = function(){
            slider.controls.next = $('<a class="bx-next" href="">' + slider.settings.nextText + '</a>');
            slider.controls.prev = $('<a class="bx-prev" href="">' + slider.settings.prevText + '</a>');
            // bind click actions to the controls
            slider.controls.next.bind('click', clickNextBind);
            slider.controls.prev.bind('click', clickPrevBind);
            // if nextSlector was supplied, populate it
            if(slider.settings.nextSelector){
                $(slider.settings.nextSelector).append(slider.controls.next);
            }
            // if prevSlector was supplied, populate it
            if(slider.settings.prevSelector){
                $(slider.settings.prevSelector).append(slider.controls.prev);
            }
            // if no custom selectors were supplied
            if(!slider.settings.nextSelector && !slider.settings.prevSelector){
                // add the controls to the DOM
                slider.controls.directionEl = $('<div class="bx-controls-direction" />');
                // add the control elements to the directionEl
                slider.controls.directionEl.append(slider.controls.prev).append(slider.controls.next);
                // slider.viewport.append(slider.controls.directionEl);
                slider.controls.el.addClass('bx-has-controls-direction').append(slider.controls.directionEl);
            }
        }

        /**
         * Appends start / stop auto controls to the controls element
         */
        var appendControlsAuto = function(){
            slider.controls.start = $('<div class="bx-controls-auto-item"><a class="bx-start" href="">' + slider.settings.startText + '</a></div>');
            slider.controls.stop = $('<div class="bx-controls-auto-item"><a class="bx-stop" href="">' + slider.settings.stopText + '</a></div>');
            // add the controls to the DOM
            slider.controls.autoEl = $('<div class="bx-controls-auto" />');
            // bind click actions to the controls
            slider.controls.autoEl.delegate('.bx-start', 'click', clickStartBind);
            slider.controls.autoEl.delegate('.bx-stop', 'click', clickStopBind);
            // if autoControlsCombine, insert only the "start" control
            if(slider.settings.autoControlsCombine){
                slider.controls.autoEl.append(slider.controls.start);
            // if autoControlsCombine is false, insert both controls
            }else{
                slider.controls.autoEl.append(slider.controls.start).append(slider.controls.stop);
            }
            // if auto controls selector was supplied, populate it with the controls
            if(slider.settings.autoControlsSelector){
                $(slider.settings.autoControlsSelector).html(slider.controls.autoEl);
            // if auto controls selector was not supplied, add it after the wrapper
            }else{
                slider.controls.el.addClass('bx-has-controls-auto').append(slider.controls.autoEl);
            }
            // update the auto controls
            updateAutoControls(slider.settings.autoStart ? 'stop' : 'start');
        }

        /**
         * Appends image captions to the DOM
         */
        var appendCaptions = function(){
            // cycle through each child
            slider.children.each(function(index){
                // get the image title attribute
                var title = $(this).find('img:first').attr('title');
                // append the caption
                if (title != undefined && ('' + title).length) {
                    $(this).append('<div class="bx-caption"><span>' + title + '</span></div>');
                }
            });
        }

        /**
         * Click next binding
         *
         * @param e (event)
         *  - DOM event object
         */
        var clickNextBind = function(e){
            // if auto show is running, stop it
            if (slider.settings.auto) el.stopAuto();
            el.goToNextSlide();
            e.preventDefault();
        }

        /**
         * Click prev binding
         *
         * @param e (event)
         *  - DOM event object
         */
        var clickPrevBind = function(e){
            // if auto show is running, stop it
            if (slider.settings.auto) el.stopAuto();
            el.goToPrevSlide();
            e.preventDefault();
        }

        /**
         * Click start binding
         *
         * @param e (event)
         *  - DOM event object
         */
        var clickStartBind = function(e){
            el.startAuto();
            e.preventDefault();
        }

        /**
         * Click stop binding
         *
         * @param e (event)
         *  - DOM event object
         */
        var clickStopBind = function(e){
            el.stopAuto();
            e.preventDefault();
        }

        /**
         * Click pager binding
         *
         * @param e (event)
         *  - DOM event object
         */
        var clickPagerBind = function(e){
            // if auto show is running, stop it
            if (slider.settings.auto) el.stopAuto();
            var pagerLink = $(e.currentTarget);
            var pagerIndex = parseInt(pagerLink.attr('data-slide-index'));
            // if clicked pager link is not active, continue with the goToSlide call
            if(pagerIndex != slider.active.index) el.goToSlide(pagerIndex);
            e.preventDefault();
        }

        /**
         * Updates the pager links with an active class
         *
         * @param slideIndex (int)
         *  - index of slide to make active
         */
        var updatePagerActive = function(slideIndex){
            // if "short" pager type
            var len = slider.children.length; // nb of children
            if(slider.settings.pagerType == 'short'){
                if(slider.settings.maxSlides > 1) {
                    len = Math.ceil(slider.children.length/slider.settings.maxSlides);
                }
                slider.pagerEl.html( (slideIndex + 1) + slider.settings.pagerShortSeparator + len);
                return;
            }
            // remove all pager active classes
            slider.pagerEl.find('a').removeClass('active');
            // apply the active class for all pagers
            slider.pagerEl.each(function(i, el) { $(el).find('a').eq(slideIndex).addClass('active'); });
        }

        /**
         * Performs needed actions after a slide transition
         */
        var updateAfterSlideTransition = function(){
            // if infinte loop is true
            if(slider.settings.infiniteLoop){
                var position = '';
                // first slide
                if(slider.active.index == 0){
                    // set the new position
                    position = slider.children.eq(0).position();
                // carousel, last slide
                }else if(slider.active.index == getPagerQty() - 1 && slider.carousel){
                    position = slider.children.eq((getPagerQty() - 1) * getMoveBy()).position();
                // last slide
                }else if(slider.active.index == slider.children.length - 1){
                    position = slider.children.eq(slider.children.length - 1).position();
                }
                if (slider.settings.mode == 'horizontal') { setPositionProperty(-position.left, 'reset', 0);; }
                else if (slider.settings.mode == 'vertical') { setPositionProperty(-position.top, 'reset', 0);; }
            }
            // declare that the transition is complete
            slider.working = false;
            // onSlideAfter callback
            slider.settings.onSlideAfter(slider.children.eq(slider.active.index), slider.oldIndex, slider.active.index);
        }

        /**
         * Updates the auto controls state (either active, or combined switch)
         *
         * @param state (string) "start", "stop"
         *  - the new state of the auto show
         */
        var updateAutoControls = function(state){
            // if autoControlsCombine is true, replace the current control with the new state
            if(slider.settings.autoControlsCombine){
                slider.controls.autoEl.html(slider.controls[state]);
            // if autoControlsCombine is false, apply the "active" class to the appropriate control
            }else{
                slider.controls.autoEl.find('a').removeClass('active');
                slider.controls.autoEl.find('a:not(.bx-' + state + ')').addClass('active');
            }
        }

        /**
         * Updates the direction controls (checks if either should be hidden)
         */
        var updateDirectionControls = function(){
            if(getPagerQty() == 1){
                slider.controls.prev.addClass('disabled');
                slider.controls.next.addClass('disabled');
            }else if(!slider.settings.infiniteLoop && slider.settings.hideControlOnEnd){
                // if first slide
                if (slider.active.index == 0){
                    slider.controls.prev.addClass('disabled');
                    slider.controls.next.removeClass('disabled');
                // if last slide
                }else if(slider.active.index == getPagerQty() - 1){
                    slider.controls.next.addClass('disabled');
                    slider.controls.prev.removeClass('disabled');
                // if any slide in the middle
                }else{
                    slider.controls.prev.removeClass('disabled');
                    slider.controls.next.removeClass('disabled');
                }
            }
        }

        /**
         * Initialzes the auto process
         */
        var initAuto = function(){
            // if autoDelay was supplied, launch the auto show using a setTimeout() call
            if(slider.settings.autoDelay > 0){
                var timeout = setTimeout(el.startAuto, slider.settings.autoDelay);
            // if autoDelay was not supplied, start the auto show normally
            }else{
                el.startAuto();
            }
            // if autoHover is requested
            if(slider.settings.autoHover){
                // on el hover
                el.hover(function(){
                    // if the auto show is currently playing (has an active interval)
                    if(slider.interval){
                        // stop the auto show and pass true agument which will prevent control update
                        el.stopAuto(true);
                        // create a new autoPaused value which will be used by the relative "mouseout" event
                        slider.autoPaused = true;
                    }
                }, function(){
                    // if the autoPaused value was created be the prior "mouseover" event
                    if(slider.autoPaused){
                        // start the auto show and pass true agument which will prevent control update
                        el.startAuto(true);
                        // reset the autoPaused value
                        slider.autoPaused = null;
                    }
                });
            }
        }

        /**
         * Initialzes the ticker process
         */
        var initTicker = function(){
            var startPosition = 0;
            // if autoDirection is "next", append a clone of the entire slider
            if(slider.settings.autoDirection == 'next'){
                el.append(slider.children.clone().addClass('bx-clone'));
            // if autoDirection is "prev", prepend a clone of the entire slider, and set the left position
            }else{
                el.prepend(slider.children.clone().addClass('bx-clone'));
                var position = slider.children.first().position();
                startPosition = slider.settings.mode == 'horizontal' ? -position.left : -position.top;
            }
            setPositionProperty(startPosition, 'reset', 0);
            // do not allow controls in ticker mode
            slider.settings.pager = false;
            slider.settings.controls = false;
            slider.settings.autoControls = false;
            // if autoHover is requested
            if(slider.settings.tickerHover && !slider.usingCSS){
                // on el hover
                slider.viewport.hover(function(){
                    el.stop();
                }, function(){
                    // calculate the total width of children (used to calculate the speed ratio)
                    var totalDimens = 0;
                    slider.children.each(function(index){
                      totalDimens += slider.settings.mode == 'horizontal' ? $(this).outerWidth(true) : $(this).outerHeight(true);
                    });
                    // calculate the speed ratio (used to determine the new speed to finish the paused animation)
                    var ratio = slider.settings.speed / totalDimens;
                    // determine which property to use
                    var property = slider.settings.mode == 'horizontal' ? 'left' : 'top';
                    // calculate the new speed
                    var newSpeed = ratio * (totalDimens - (Math.abs(parseInt(el.css(property)))));
                    tickerLoop(newSpeed);
                });
            }
            // start the ticker loop
            tickerLoop();
        }

        /**
         * Runs a continuous loop, news ticker-style
         */
        var tickerLoop = function(resumeSpeed){
            speed = resumeSpeed ? resumeSpeed : slider.settings.speed;
            var position = {left: 0, top: 0};
            var reset = {left: 0, top: 0};
            // if "next" animate left position to last child, then reset left to 0
            if(slider.settings.autoDirection == 'next'){
                position = el.find('.bx-clone').first().position();
            // if "prev" animate left position to 0, then reset left to first non-clone child
            }else{
                reset = slider.children.first().position();
            }
            var animateProperty = slider.settings.mode == 'horizontal' ? -position.left : -position.top;
            var resetValue = slider.settings.mode == 'horizontal' ? -reset.left : -reset.top;
            var params = {resetValue: resetValue};
            setPositionProperty(animateProperty, 'ticker', speed, params);
        }

        /**
         * Initializes touch events
         */
        var initTouch = function(){
            // initialize object to contain all touch values
            slider.touch = {
                start: {x: 0, y: 0},
                end: {x: 0, y: 0}
            }
            slider.viewport.bind('touchstart', onTouchStart);
        }

        /**
         * Event handler for "touchstart"
         *
         * @param e (event)
         *  - DOM event object
         */
        var onTouchStart = function(e){
            if(slider.working){
                e.preventDefault();
            }else{
                // record the original position when touch starts
                slider.touch.originalPos = el.position();
                var orig = e.originalEvent;
                // record the starting touch x, y coordinates
                slider.touch.start.x = orig.changedTouches[0].pageX;
                slider.touch.start.y = orig.changedTouches[0].pageY;
                // bind a "touchmove" event to the viewport
                slider.viewport.bind('touchmove', onTouchMove);
                // bind a "touchend" event to the viewport
                slider.viewport.bind('touchend', onTouchEnd);
            }
        }

        /**
         * Event handler for "touchmove"
         *
         * @param e (event)
         *  - DOM event object
         */
        var onTouchMove = function(e){
            var orig = e.originalEvent;
            // if scrolling on y axis, do not prevent default
            var xMovement = Math.abs(orig.changedTouches[0].pageX - slider.touch.start.x);
            var yMovement = Math.abs(orig.changedTouches[0].pageY - slider.touch.start.y);
            // x axis swipe
            if((xMovement * 3) > yMovement && slider.settings.preventDefaultSwipeX){
                e.preventDefault();
            // y axis swipe
            }else if((yMovement * 3) > xMovement && slider.settings.preventDefaultSwipeY){
                e.preventDefault();
            }
            if(slider.settings.mode != 'fade' && slider.settings.oneToOneTouch){
                var value = 0;
                // if horizontal, drag along x axis
                if(slider.settings.mode == 'horizontal'){
                    var change = orig.changedTouches[0].pageX - slider.touch.start.x;
                    value = slider.touch.originalPos.left + change;
                // if vertical, drag along y axis
                }else{
                    var change = orig.changedTouches[0].pageY - slider.touch.start.y;
                    value = slider.touch.originalPos.top + change;
                }
                setPositionProperty(value, 'reset', 0);
            }
        }

        /**
         * Event handler for "touchend"
         *
         * @param e (event)
         *  - DOM event object
         */
        var onTouchEnd = function(e){
            slider.viewport.unbind('touchmove', onTouchMove);
            var orig = e.originalEvent;
            var value = 0;
            // record end x, y positions
            slider.touch.end.x = orig.changedTouches[0].pageX;
            slider.touch.end.y = orig.changedTouches[0].pageY;
            // if fade mode, check if absolute x distance clears the threshold
            if(slider.settings.mode == 'fade'){
                var distance = Math.abs(slider.touch.start.x - slider.touch.end.x);
                if(distance >= slider.settings.swipeThreshold){
                    slider.touch.start.x > slider.touch.end.x ? el.goToNextSlide() : el.goToPrevSlide();
                    el.stopAuto();
                }
            // not fade mode
            }else{
                var distance = 0;
                // calculate distance and el's animate property
                if(slider.settings.mode == 'horizontal'){
                    distance = slider.touch.end.x - slider.touch.start.x;
                    value = slider.touch.originalPos.left;
                }else{
                    distance = slider.touch.end.y - slider.touch.start.y;
                    value = slider.touch.originalPos.top;
                }
                // if not infinite loop and first / last slide, do not attempt a slide transition
                if(!slider.settings.infiniteLoop && ((slider.active.index == 0 && distance > 0) || (slider.active.last && distance < 0))){
                    setPositionProperty(value, 'reset', 200);
                }else{
                    // check if distance clears threshold
                    if(Math.abs(distance) >= slider.settings.swipeThreshold){
                        distance < 0 ? el.goToNextSlide() : el.goToPrevSlide();
                        el.stopAuto();
                    }else{
                        // el.animate(property, 200);
                        setPositionProperty(value, 'reset', 200);
                    }
                }
            }
            slider.viewport.unbind('touchend', onTouchEnd);
        }

        /**
         * Window resize event callback
         */
        var resizeWindow = function(e){
            // get the new window dimens (again, thank you IE)
            var windowWidthNew = $(window).width();
            var windowHeightNew = $(window).height();
            // make sure that it is a true window resize
            // *we must check this because our dinosaur friend IE fires a window resize event when certain DOM elements
            // are resized. Can you just die already?*
            if(windowWidth != windowWidthNew || windowHeight != windowHeightNew){
                // set the new window dimens
                windowWidth = windowWidthNew;
                windowHeight = windowHeightNew;
                // update all dynamic elements
                el.redrawSlider();
            }
        }

        /**
         * ===================================================================================
         * = PUBLIC FUNCTIONS
         * ===================================================================================
         */

        /**
         * Performs slide transition to the specified slide
         *
         * @param slideIndex (int)
         *  - the destination slide's index (zero-based)
         *
         * @param direction (string)
         *  - INTERNAL USE ONLY - the direction of travel ("prev" / "next")
         */
        el.goToSlide = function(slideIndex, direction){
            // if plugin is currently in motion, ignore request
            if(slider.working || slider.active.index == slideIndex) return;
            // declare that plugin is in motion
            slider.working = true;
            // store the old index
            slider.oldIndex = slider.active.index;
            // if slideIndex is less than zero, set active index to last child (this happens during infinite loop)
            if(slideIndex < 0){
                slider.active.index = getPagerQty() - 1;
            // if slideIndex is greater than children length, set active index to 0 (this happens during infinite loop)
            }else if(slideIndex >= getPagerQty()){
                slider.active.index = 0;
            // set active index to requested slide
            }else{
                slider.active.index = slideIndex;
            }
            // onSlideBefore, onSlideNext, onSlidePrev callbacks
            slider.settings.onSlideBefore(slider.children.eq(slider.active.index), slider.oldIndex, slider.active.index);
            if(direction == 'next'){
                slider.settings.onSlideNext(slider.children.eq(slider.active.index), slider.oldIndex, slider.active.index);
            }else if(direction == 'prev'){
                slider.settings.onSlidePrev(slider.children.eq(slider.active.index), slider.oldIndex, slider.active.index);
            }
            // check if last slide
            slider.active.last = slider.active.index >= getPagerQty() - 1;
            // update the pager with active class
            if(slider.settings.pager) updatePagerActive(slider.active.index);
            // // check for direction control update
            if(slider.settings.controls) updateDirectionControls();
            // if slider is set to mode: "fade"
            if(slider.settings.mode == 'fade'){
                // if adaptiveHeight is true and next height is different from current height, animate to the new height
                if(slider.settings.adaptiveHeight && slider.viewport.height() != getViewportHeight()){
                    slider.viewport.animate({height: getViewportHeight()}, slider.settings.adaptiveHeightSpeed);
                }
                // fade out the visible child and reset its z-index value
                slider.children.filter(':visible').fadeOut(slider.settings.speed).css({zIndex: 0});
                // fade in the newly requested slide
                slider.children.eq(slider.active.index).css('zIndex', 51).fadeIn(slider.settings.speed, function(){
                    $(this).css('zIndex', 50);
                    updateAfterSlideTransition();
                });
            // slider mode is not "fade"
            }else{
                // if adaptiveHeight is true and next height is different from current height, animate to the new height
                if(slider.settings.adaptiveHeight && slider.viewport.height() != getViewportHeight()){
                    slider.viewport.animate({height: getViewportHeight()}, slider.settings.adaptiveHeightSpeed);
                }
                var moveBy = 0;
                var position = {left: 0, top: 0};
                // if carousel and not infinite loop
                if(!slider.settings.infiniteLoop && slider.carousel && slider.active.last){
                    if(slider.settings.mode == 'horizontal'){
                        // get the last child position
                        var lastChild = slider.children.eq(slider.children.length - 1);
                        position = lastChild.position();
                        // calculate the position of the last slide
                        moveBy = slider.viewport.width() - lastChild.outerWidth();
                    }else{
                        // get last showing index position
                        var lastShowingIndex = slider.children.length - slider.settings.minSlides;
                        position = slider.children.eq(lastShowingIndex).position();
                    }
                    // horizontal carousel, going previous while on first slide (infiniteLoop mode)
                }else if(slider.carousel && slider.active.last && direction == 'prev'){
                    // get the last child position
                    var eq = slider.settings.moveSlides == 1 ? slider.settings.maxSlides - getMoveBy() : ((getPagerQty() - 1) * getMoveBy()) - (slider.children.length - slider.settings.maxSlides);
                    var lastChild = el.children('.bx-clone').eq(eq);
                    position = lastChild.position();
                // if infinite loop and "Next" is clicked on the last slide
                }else if(direction == 'next' && slider.active.index == 0){
                    // get the last clone position
                    position = el.find('> .bx-clone').eq(slider.settings.maxSlides).position();
                    slider.active.last = false;
                // normal non-zero requests
                }else if(slideIndex >= 0){
                    var requestEl = slideIndex * getMoveBy();
                    position = slider.children.eq(requestEl).position();
                }

                /* If the position doesn't exist
                 * (e.g. if you destroy the slider on a next click),
                 * it doesn't throw an error.
                 */
                if ("undefined" !== typeof(position)) {
                    var value = slider.settings.mode == 'horizontal' ? -(position.left - moveBy) : -position.top;
                    // plugin values to be animated
                    setPositionProperty(value, 'slide', slider.settings.speed);
                }
            }
        }

        /**
         * Transitions to the next slide in the show
         */
        el.goToNextSlide = function(){
            // if infiniteLoop is false and last page is showing, disregard call
            if (!slider.settings.infiniteLoop && slider.active.last) return;
            var pagerIndex = parseInt(slider.active.index) + 1;
            el.goToSlide(pagerIndex, 'next');
        }

        /**
         * Transitions to the prev slide in the show
         */
        el.goToPrevSlide = function(){
            // if infiniteLoop is false and last page is showing, disregard call
            if (!slider.settings.infiniteLoop && slider.active.index == 0) return;
            var pagerIndex = parseInt(slider.active.index) - 1;
            el.goToSlide(pagerIndex, 'prev');
        }

        /**
         * Starts the auto show
         *
         * @param preventControlUpdate (boolean)
         *  - if true, auto controls state will not be updated
         */
        el.startAuto = function(preventControlUpdate){
            // if an interval already exists, disregard call
            if(slider.interval) return;
            // create an interval
            slider.interval = setInterval(function(){
                slider.settings.autoDirection == 'next' ? el.goToNextSlide() : el.goToPrevSlide();
            }, slider.settings.pause);
            // if auto controls are displayed and preventControlUpdate is not true
            if (slider.settings.autoControls && preventControlUpdate != true) updateAutoControls('stop');
        }

        /**
         * Stops the auto show
         *
         * @param preventControlUpdate (boolean)
         *  - if true, auto controls state will not be updated
         */
        el.stopAuto = function(preventControlUpdate){
            // if no interval exists, disregard call
            if(!slider.interval) return;
            // clear the interval
            clearInterval(slider.interval);
            slider.interval = null;
            // if auto controls are displayed and preventControlUpdate is not true
            if (slider.settings.autoControls && preventControlUpdate != true) updateAutoControls('start');
        }

        /**
         * Returns current slide index (zero-based)
         */
        el.getCurrentSlide = function(){
            return slider.active.index;
        }

        /**
         * Returns number of slides in show
         */
        el.getSlideCount = function(){
            return slider.children.length;
        }

        /**
         * Update all dynamic slider elements
         */
        el.redrawSlider = function(){
            // resize all children in ratio to new screen size
            slider.children.add(el.find('.bx-clone')).outerWidth(getSlideWidth());
            // adjust the height
            slider.viewport.css('height', getViewportHeight());
            // update the slide position
            if(!slider.settings.ticker) setSlidePosition();
            // if active.last was true before the screen resize, we want
            // to keep it last no matter what screen size we end on
            if (slider.active.last) slider.active.index = getPagerQty() - 1;
            // if the active index (page) no longer exists due to the resize, simply set the index as last
            if (slider.active.index >= getPagerQty()) slider.active.last = true;
            // if a pager is being displayed and a custom pager is not being used, update it
            if(slider.settings.pager && !slider.settings.pagerCustom){
                populatePager();
                updatePagerActive(slider.active.index);
            }
        }

        /**
         * Destroy the current instance of the slider (revert everything back to original state)
         */
        el.destroySlider = function(){
            // don't do anything if slider has already been destroyed
            if(!slider.initialized) return;
            slider.initialized = false;
            $('.bx-clone', this).remove();
            slider.children.each(function() {
                $(this).data("origStyle") != undefined ? $(this).attr("style", $(this).data("origStyle")) : $(this).removeAttr('style');
            });
            $(this).data("origStyle") != undefined ? this.attr("style", $(this).data("origStyle")) : $(this).removeAttr('style');
            $(this).unwrap().unwrap();
            if(slider.controls.el) slider.controls.el.remove();
            if(slider.controls.next) slider.controls.next.remove();
            if(slider.controls.prev) slider.controls.prev.remove();
            if(slider.pagerEl) slider.pagerEl.remove();
            $('.bx-caption', this).remove();
            if(slider.controls.autoEl) slider.controls.autoEl.remove();
            clearInterval(slider.interval);
            if(slider.settings.responsive) $(window).unbind('resize', resizeWindow);
        }

        /**
         * Reload the slider (revert all DOM changes, and re-initialize)
         */
        el.reloadSlider = function(settings){
            if (settings != undefined) options = settings;
            el.destroySlider();
            init();
        }

        init();

        // returns the current jQuery object
        return this;
    }

})(jQuery);








/*! Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 *
 */
(function(f){jQuery.fn.extend({slimScroll:function(h){var a=f.extend({width:"auto",height:"250px",size:"7px",color:"#000",position:"right",distance:"1px",start:"top",opacity:0.4,alwaysVisible:!1,disableFadeOut:!1,railVisible:!1,railColor:"#333",railOpacity:0.2,railDraggable:!0,railClass:"slimScrollRail",barClass:"slimScrollBar",wrapperClass:"slimScrollDiv",allowPageScroll:!1,wheelStep:20,touchScrollStep:200,borderRadius:"7px",railBorderRadius:"7px"},h);this.each(function(){function r(d){if(s){d=d||
window.event;var c=0;d.wheelDelta&&(c=-d.wheelDelta/120);d.detail&&(c=d.detail/3);f(d.target||d.srcTarget||d.srcElement).closest("."+a.wrapperClass).is(b.parent())&&m(c,!0);d.preventDefault&&!k&&d.preventDefault();k||(d.returnValue=!1)}}function m(d,f,h){k=!1;var e=d,g=b.outerHeight()-c.outerHeight();f&&(e=parseInt(c.css("top"))+d*parseInt(a.wheelStep)/100*c.outerHeight(),e=Math.min(Math.max(e,0),g),e=0<d?Math.ceil(e):Math.floor(e),c.css({top:e+"px"}));l=parseInt(c.css("top"))/(b.outerHeight()-c.outerHeight());
e=l*(b[0].scrollHeight-b.outerHeight());h&&(e=d,d=e/b[0].scrollHeight*b.outerHeight(),d=Math.min(Math.max(d,0),g),c.css({top:d+"px"}));b.scrollTop(e);b.trigger("slimscrolling",~~e);v();p()}function C(){window.addEventListener?(this.addEventListener("DOMMouseScroll",r,!1),this.addEventListener("mousewheel",r,!1),this.addEventListener("MozMousePixelScroll",r,!1)):document.attachEvent("onmousewheel",r)}function w(){u=Math.max(b.outerHeight()/b[0].scrollHeight*b.outerHeight(),D);c.css({height:u+"px"});
var a=u==b.outerHeight()?"none":"block";c.css({display:a})}function v(){w();clearTimeout(A);l==~~l?(k=a.allowPageScroll,B!=l&&b.trigger("slimscroll",0==~~l?"top":"bottom")):k=!1;B=l;u>=b.outerHeight()?k=!0:(c.stop(!0,!0).fadeIn("fast"),a.railVisible&&g.stop(!0,!0).fadeIn("fast"))}function p(){a.alwaysVisible||(A=setTimeout(function(){a.disableFadeOut&&s||(x||y)||(c.fadeOut("slow"),g.fadeOut("slow"))},1E3))}var s,x,y,A,z,u,l,B,D=30,k=!1,b=f(this);if(b.parent().hasClass(a.wrapperClass)){var n=b.scrollTop(),
c=b.parent().find("."+a.barClass),g=b.parent().find("."+a.railClass);w();if(f.isPlainObject(h)){if("height"in h&&"auto"==h.height){b.parent().css("height","auto");b.css("height","auto");var q=b.parent().parent().height();b.parent().css("height",q);b.css("height",q)}if("scrollTo"in h)n=parseInt(a.scrollTo);else if("scrollBy"in h)n+=parseInt(a.scrollBy);else if("destroy"in h){c.remove();g.remove();b.unwrap();return}m(n,!1,!0)}}else{a.height="auto"==a.height?b.parent().height():a.height;n=f("<div></div>").addClass(a.wrapperClass).css({position:"relative",
overflow:"hidden",width:a.width,height:a.height});b.css({overflow:"hidden",width:a.width,height:a.height});var g=f("<div></div>").addClass(a.railClass).css({width:a.size,height:"100%",position:"absolute",top:0,display:a.alwaysVisible&&a.railVisible?"block":"none","border-radius":a.railBorderRadius,background:a.railColor,opacity:a.railOpacity,zIndex:90}),c=f("<div></div>").addClass(a.barClass).css({background:a.color,width:a.size,position:"absolute",top:0,opacity:a.opacity,display:a.alwaysVisible?
"block":"none","border-radius":a.borderRadius,BorderRadius:a.borderRadius,MozBorderRadius:a.borderRadius,WebkitBorderRadius:a.borderRadius,zIndex:99}),q="right"==a.position?{right:a.distance}:{left:a.distance};g.css(q);c.css(q);b.wrap(n);b.parent().append(c);b.parent().append(g);a.railDraggable&&c.bind("mousedown",function(a){var b=f(document);y=!0;t=parseFloat(c.css("top"));pageY=a.pageY;b.bind("mousemove.slimscroll",function(a){currTop=t+a.pageY-pageY;c.css("top",currTop);m(0,c.position().top,!1)});
b.bind("mouseup.slimscroll",function(a){y=!1;p();b.unbind(".slimscroll")});return!1}).bind("selectstart.slimscroll",function(a){a.stopPropagation();a.preventDefault();return!1});g.hover(function(){v()},function(){p()});c.hover(function(){x=!0},function(){x=!1});b.hover(function(){s=!0;v();p()},function(){s=!1;p()});b.bind("touchstart",function(a,b){a.originalEvent.touches.length&&(z=a.originalEvent.touches[0].pageY)});b.bind("touchmove",function(b){k||b.originalEvent.preventDefault();b.originalEvent.touches.length&&
(m((z-b.originalEvent.touches[0].pageY)/a.touchScrollStep,!0),z=b.originalEvent.touches[0].pageY)});w();"bottom"===a.start?(c.css({top:b.outerHeight()-c.outerHeight()}),m(0,!0)):"top"!==a.start&&(m(f(a.start).position().top,null,!0),a.alwaysVisible||c.hide());C()}});return this}});jQuery.fn.extend({slimscroll:jQuery.fn.slimScroll})})(jQuery);




/**
 * jquery.dropdown.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2012, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {

	'use strict';

	$.DropDown = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.DropDown.defaults = {
		speed : 300,
		easing : 'ease',
		gutter : 0,
		// initial stack effect
		stack : true,
		// delay between each option animation
		delay : 0,
		// random angle and positions for the options
		random : false,
		// rotated [right||left||false] : the options will be rotated to thr right side or left side.
		// make sure to tune the transform origin in the stylesheet
		rotated : false,
		// effect to slide in the options. value is the margin to start with
		slidingIn : false,
		onOptionSelect : function(opt) { return false; }
	};

	$.DropDown.prototype = {

		_init : function( options ) {

			// options
			this.options = $.extend( true, {}, $.DropDown.defaults, options );
			this._layout();
			this._initEvents();

		},
		_layout : function() {

			var self = this;
			this.minZIndex = 1000;
			var value = this._transformSelect();
			this.opts = this.listopts.children( 'li' );
			this.optsCount = this.opts.length;
			this.size = { width : this.dd.width(), height : this.dd.height() };
			
			var elName = this.$el.attr( 'name' ), elId = this.$el.attr( 'id' ),
				inputName = elName !== undefined ? elName : elId !== undefined ? elId : 'cd-dropdown-' + ( new Date() ).getTime();

			this.inputEl = $( '<input type="hidden" name="' + inputName + '" value="' + value + '"></input>' ).insertAfter( this.selectlabel );
			
			this.selectlabel.css( 'z-index', this.minZIndex + this.optsCount );
			this._positionOpts();
			if( Modernizr.csstransitions ) {
				setTimeout( function() { self.opts.css( 'transition', 'all ' + self.options.speed + 'ms ' + self.options.easing ); }, 25 );
			}

		},
		_transformSelect : function() {

			var optshtml = '', selectlabel = '', value = -1;
			this.$el.children( 'option' ).each( function() {
				var $this = $( this ),
					val = isNaN( $this.attr( 'value' ) ) ? $this.attr( 'value' ) : Number( $this.attr( 'value' ) ) ,
					classes  = $this.attr( 'class' ),
					val_min  = $this.data( 'under' ),
					val_max  = $this.data( 'above' ),
					val_feet = $this.data( 'feet' ),
					selected = $this.attr( 'selected' ),
					label    = $this.text();

				
				if($this.hasClass('set-price')){	
					if( val !== -1 ) {
						optshtml += 
							classes !== undefined ? 
								'<li data-value="' + val + '"><span class="' + classes + ' set-price">' + label + '</span></li>' :
								'<li data-value="' + val + '"><span>' + label + '</span></li>';
					}
				} else {
					if( val !== -1 ) {
						optshtml += 
							classes !== undefined ? 
								'<li data-value="' + val + '"><span data-feet="' + val_feet + '" data-under="' + val_min + '" data-above="' + val_max + '" class="' + classes + '">' + label + '</span></li>' :
								'<li data-value="' + val + '"><span>' + label + '</span></li>';
					}
				}
				

				if( selected ) {
					selectlabel = label;
					value = val;
				}

			} );

			this.listopts = $( '<ul/>' ).append( optshtml );
			this.selectlabel = $( '<span/>' ).append( selectlabel );
			this.dd = $( '<div class="cd-dropdown"/>' ).append( this.selectlabel, this.listopts ).insertAfter( this.$el );
			this.$el.remove();

			return value;

		},
		_positionOpts : function( anim ) {

			var self = this;

			this.listopts.css( 'height', 'auto' );
			this.opts
				.each( function( i ) {
					$( this ).css( {
						zIndex : self.minZIndex + self.optsCount - 1 - i,
						top : self.options.slidingIn ? ( i + 1 ) * ( self.size.height + self.options.gutter ) : 0,
						left : 0,
						marginLeft : self.options.slidingIn ? i % 2 === 0 ? self.options.slidingIn : - self.options.slidingIn : 0,
						opacity : self.options.slidingIn ? 0 : 1,
						transform : 'none'
					} );
				} );

			if( !this.options.slidingIn ) {
				this.opts
					.eq( this.optsCount - 1 )
					.css( { top : this.options.stack ? 9 : 0, left : this.options.stack ? 4 : 0, width : this.options.stack ? this.size.width - 8 : this.size.width, transform : 'none' } )
					.end()
					.eq( this.optsCount - 2 )
					.css( { top : this.options.stack ? 6 : 0, left : this.options.stack ? 2 : 0, width : this.options.stack ? this.size.width - 4 : this.size.width, transform : 'none' } )
					.end()
					.eq( this.optsCount - 3 )
					.css( { top : this.options.stack ? 3 : 0, left : 0, transform : 'none' } );
			}

		},
		_initEvents : function() {
			
			var self = this;
			
			this.selectlabel.on( 'mousedown.dropdown', function( event ) {
				self.opened ? self.close() : self.open();
				return false;

			} );

			this.opts.on( 'click.dropdown', function() {
				if( self.opened ) {
					var opt = $( this );
					self.options.onOptionSelect( opt );
					self.inputEl.val( opt.data( 'value' ) );
					self.selectlabel.html( opt.html() );
					self.close();
				}
			} );

		},
		open : function() {
			var self = this;
			this.dd.addClass('cd-active');
			this.listopts.css( 'height', ( this.optsCount + 1 ) * ( this.size.height + this.options.gutter ) );
			this.opts.each( function( i ) {

				$( this ).css( {
					opacity : 1,
					top : self.options.rotated ? self.size.height + self.options.gutter : ( i + 1 ) * ( self.size.height + self.options.gutter ),
					left : self.options.random ? Math.floor( Math.random() * 11 - 5 ) : 0,
					width : self.size.width,
					marginLeft : 0,
					transform : self.options.random ?
						'rotate(' + Math.floor( Math.random() * 11 - 5 ) + 'deg)' :
						self.options.rotated ?
							self.options.rotated === 'right' ?
								'rotate(-' + ( i * 5 ) + 'deg)' :
								'rotate(' + ( i * 5 ) + 'deg)'
							: 'none',
					transitionDelay : self.options.delay && Modernizr.csstransitions ? self.options.slidingIn ? ( i * self.options.delay ) + 'ms' : ( ( self.optsCount - 1 - i ) * self.options.delay ) + 'ms' : 0
				} );

			} );
			this.opened = true;

		},
		close : function() {

			var self = this;
			this.dd.removeClass( 'cd-active' );
			if( this.options.delay && Modernizr.csstransitions ) {
				this.opts.each( function( i ) {
					$( this ).css( { 'transition-delay' : self.options.slidingIn ? ( ( self.optsCount - 1 - i ) * self.options.delay ) + 'ms' : ( i * self.options.delay ) + 'ms' } );
				} );
			}
			this._positionOpts( true );
			this.opened = false;

		}

	}

	$.fn.dropdown = function( options ) {
		var instance = $.data( this, 'dropdown' );
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				instance[ options ].apply( instance, args );
			});
		}
		else {
			this.each(function() {
				instance ? instance._init() : instance = $.data( this, 'dropdown', new $.DropDown( options, this ) );
			});
		}
		return instance;
	};

} )( jQuery, window );

/*
* $ lightbox_me
* By: Buck Wilson
* Version : 2.4
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*     http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/


(function($) {

    $.fn.lightbox_me = function(options) {

        return this.each(function() {

            var
                opts = $.extend({}, $.fn.lightbox_me.defaults, options),
                $overlay = $(),
                $self = $(this),
                $iframe = $('<iframe id="foo" style="z-index: ' + (opts.zIndex + 1) + ';border: none; margin: 0; padding: 0; position: absolute; width: 100%; height: 100%; top: 0; left: 0; filter: mask();"/>');

            if (opts.showOverlay) {
                //check if there's an existing overlay, if so, make subequent ones clear
               var $currentOverlays = $(".js_lb_overlay:visible");
                if ($currentOverlays.length > 0){
                    $overlay = $('<div class="lb_overlay_clear js_lb_overlay"/>');
                } else {
                    $overlay = $('<div class="' + opts.classPrefix + '_overlay js_lb_overlay"/>');
                }
            }

            /*----------------------------------------------------
               DOM Building
            ---------------------------------------------------- */
            $('body').append($self.hide()).append($overlay);


            /*----------------------------------------------------
               Overlay CSS stuffs
            ---------------------------------------------------- */

            // set css of the overlay
            if (opts.showOverlay) {
                setOverlayHeight(); // pulled this into a function because it is called on window resize.
                $overlay.css({ position: 'fixed', width: '100%', top: 0, left: 0, right: 0, bottom: 0, zIndex: (opts.zIndex + 2), display: 'none' });
                if (!$overlay.hasClass('lb_overlay_clear')){
                    $overlay.css(opts.overlayCSS);
                }
            }

            /*----------------------------------------------------
               Animate it in.
            ---------------------------------------------------- */
               //
            if (opts.showOverlay) {
                $overlay.fadeIn(opts.overlaySpeed, function() {
                    setSelfPosition();
                    $self[opts.appearEffect](opts.lightboxSpeed, function() { setOverlayHeight(); setSelfPosition(); opts.onLoad()});
                });
            } else {
                setSelfPosition();
                $self[opts.appearEffect](opts.lightboxSpeed, function() { opts.onLoad()});
            }

            /*----------------------------------------------------
               Hide parent if parent specified (parentLightbox should be jquery reference to any parent lightbox)
            ---------------------------------------------------- */
            if (opts.parentLightbox) {
                opts.parentLightbox.fadeOut(200);
            }


            /*----------------------------------------------------
               Bind Events
            ---------------------------------------------------- */
            if($(window).width() > 789){
                $(window).resize(setOverlayHeight)
                         .resize(setSelfPosition)
                         .scroll(setSelfPosition);
            }

            $(window).bind('keyup.lightbox_me', observeKeyPress);

            if (opts.closeClick) {
                //$overlay.click(function(e) { closeLightbox(); e.preventDefault; });
                $overlay.click(function(e) { e.preventDefault; });
            }
            $self.delegate(opts.closeSelector, "click", function(e) {
                closeLightbox(); e.preventDefault();
            });
            $self.bind('close', closeLightbox);
            $self.bind('reposition', setSelfPosition);



            /*--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
              -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */


            /*----------------------------------------------------
               Private Functions
            ---------------------------------------------------- */

            /* Remove or hide all elements */
            function closeLightbox() {
                var s = $self[0].style;
                if (opts.destroyOnClose) {
                    $self.add($overlay).remove();
                    
                } else {
                    $self.add($overlay).hide();
                    //$self.add($overlay).remove();
                }

                //show the hidden parent lightbox
                if (opts.parentLightbox) {
                    opts.parentLightbox.fadeIn(200);
                }
                if (opts.preventScroll) {
                    $('body').css('overflow', '');
                }
                $iframe.remove();

                        // clean up events.
                $self.undelegate(opts.closeSelector, "click");
                $self.unbind('close', closeLightbox);
                $self.unbind('repositon', setSelfPosition);
                
                $(window).unbind('resize', setOverlayHeight);
                $(window).unbind('resize', setSelfPosition);
                $(window).unbind('scroll', setSelfPosition);
                $(window).unbind('keyup.lightbox_me');
                opts.onClose();
            }


            /* Function to bind to the window to observe the escape/enter key press */
            function observeKeyPress(e) {
                if((e.keyCode == 27 || (e.DOM_VK_ESCAPE == 27 && e.which==0)) && opts.closeEsc) closeLightbox();
            }


            /* Set the height of the overlay
                    : if the document height is taller than the window, then set the overlay height to the document height.
                    : otherwise, just set overlay height: 100%
            */
            function setOverlayHeight() {
                if ($(window).height() < $(document).height()) {
                    $overlay.css({height: $(document).height() + 'px'});
                     $iframe.css({height: $(document).height() + 'px'});
                } else {
                    $overlay.css({height: '100%'});
                }
            }


            /* Set the position of the modal'd window ($self)
                    : if $self is taller than the window, then make it absolutely positioned
                    : otherwise fixed
            */
            function setSelfPosition() {
                var s = $self[0].style;

                // reset CSS so width is re-calculated for margin-left CSS
                $self.css({left: '50%', marginLeft: ($self.outerWidth() / 2) * -1,  zIndex: (opts.zIndex + 3) });


                /* we have to get a little fancy when dealing with height, because lightbox_me
                    is just so fancy.
                 */

                // if the height of $self is bigger than the window and self isn't already position absolute
                if (($self.height() + 80  >= $(window).height()) && ($self.css('position') != 'absolute')) {

                    // we are going to make it positioned where the user can see it, but they can still scroll
                    // so the top offset is based on the user's scroll position.
                    var topOffset = $(document).scrollTop() + 40;
                    $self.css({position: 'absolute', top: topOffset + 'px', marginTop: 0})
                } else if ($self.height()+ 80  < $(window).height()) {
                    //if the height is less than the window height, then we're gonna make this thing position: fixed.
                    if (opts.centered) {
                        $self.css({ position: 'absolute', top: '50%', marginTop: ($self.outerHeight() / 2) * -1})
                    } else {
                        $self.css({ position: 'fixed'}).css(opts.modalCSS);
                    }
                    if (opts.preventScroll) {
                        $('body').css('overflow', 'hidden');
                    }
                }
            }

        });



    };

    $.fn.lightbox_me.defaults = {

        // animation
        appearEffect: "fadeIn",
        appearEase: "",
        overlaySpeed: 250,
        lightboxSpeed: 300,

        // close
        closeSelector: ".close",
        closeClick: true,
        closeEsc: true,

        // behavior
        destroyOnClose: false,
        showOverlay: true,
        parentLightbox: false,
        preventScroll: false,

        // callbacks
        onLoad: function() {},
        onClose: function() {},

        // style
        classPrefix: 'lb',
        zIndex: 999,
        centered: false,
        modalCSS: {top: '40px'},
        overlayCSS: {background: 'black', opacity: .5}
    }

})(jQuery);

/*! LazyYT (lazy load Youtube videos plugin) - v0.3.4 - 2014-06-30
* Usage: <div class="lazyYT" data-youtube-id="laknj093n" ratio="16:9" data-parameters="rel=0">loading...</div>
* Copyright (c) 2014 Tyler Pearson; Licensed MIT */




;(function ($) {
    'use strict';

    function setUp($el) {
        var width = $el.data('width'),
            height = $el.data('height'),
            ratio = $el.data('ratio'),
            id = $el.data('youtube-id'),
            aspectRatio = ['16', '9'],
            paddingTop = 0,
            youtubeParameters = $el.data('parameters') || '';

        if (typeof width === 'undefined' || typeof height === 'undefined') {
          height = 0;
          width = '100%';
          aspectRatio = (ratio.split(":")[1] / ratio.split(":")[0]) * 100;
          paddingTop = aspectRatio + '%';
        }

        $el.css({
            'position': 'relative',
            'height': height,
            'width': width,
            'padding-top': paddingTop,
            'background': 'url(http://img.youtube.com/vi/' + id + '/hqdefault.jpg) center center no-repeat',
            'cursor': 'pointer',
            'background-size': 'cover'
        })
            .html('<class="lazyYT-title"></p><div class="lazyYT-button"></div>')
            .addClass('lazyYT-image-loaded');

        $.getJSON('https://gdata.youtube.com/feeds/api/videos/' + id + '?v=2&alt=json', function (data) {
            $('#lazyYT-title-' + id).text(data.entry.title.$t);
        });

        $el.on('click', function (e) {
            e.preventDefault();

            if  ($(this).parent().attr('id')=='lbox-videos'){ 
            if (!$el.hasClass('lazyYT-video-loaded') && $el.hasClass('lazyYT-image-loaded')) {
                $el.html('<iframe id="teste" width="' + width + '" height="' + height + '" src="http://www.youtube.com/embed/' + id + '?autoplay=1&' + youtubeParameters + 'amp;controls=0&amp;showinfo=0' + '" style="position:absolute; top:0; left:0; width:1100px; height:619px;" ; frameborder="0" allowfullscreen></iframe>')
                    .removeClass('lazyYT-image-loaded')
                    .addClass('lazyYT-video-loaded');  
              
             } 

            }

         });

    }

    $.fn.lazyYT = function () {
        return this.each(function () {
            var $el = $(this).css('cursor', 'pointer');
            setUp($el);
        });
    };


})(jQuery);

/*!
Video Controller by bqworks
https://github.com/bqworks/video-controller
*/
!function(a){"use strict";var b=window.navigator.userAgent.toLowerCase(),c=null!==b.match(/ipad/i)||null!==b.match(/ipod/i)||null!==b.match(/iphone/i),d=function(b,c){this.$video=a(b),this.options=c,this.settings={},this.player=null,this._init()};d.prototype={_init:function(){this.settings=a.extend({},this.defaults,this.options);var b=this,c=a.VideoController.players,d=this.$video.attr("id");for(var e in c)if("undefined"!=typeof c[e]&&c[e].isType(this.$video)){this.player=new c[e](this.$video);break}if(null!==this.player){var f=["ready","start","play","pause","ended"];a.each(f,function(c,e){var f="video"+e.charAt(0).toUpperCase()+e.slice(1);b.player.on(e,function(){b.trigger({type:f,video:d}),a.isFunction(b.settings[f])&&b.settings[f].call(b,{type:f,video:d})})})}},play:function(){c===!0&&this.player.isStarted()===!1||"playing"===this.player.getState()||this.player.play()},stop:function(){c===!0&&this.player.isStarted()===!1||"stopped"===this.player.getState()||this.player.stop()},pause:function(){c===!0&&this.player.isStarted()===!1||"paused"===this.player.getState()||this.player.pause()},replay:function(){(c!==!0||this.player.isStarted()!==!1)&&this.player.replay()},on:function(a,b){return this.$video.on(a,b)},off:function(a){return this.$video.off(a)},trigger:function(a){return this.$video.triggerHandler(a)},destroy:function(){this.player.isStarted()===!0&&this.stop(),this.player.off("ready"),this.player.off("start"),this.player.off("play"),this.player.off("pause"),this.player.off("ended")},defaults:{videoReady:function(){},videoStart:function(){},videoPlay:function(){},videoPause:function(){},videoEnded:function(){}}},a.VideoController={players:{},addPlayer:function(a,b){this.players[a]=b}},a.fn.videoController=function(b){var c=Array.prototype.slice.call(arguments,1);return this.each(function(){if("undefined"==typeof a(this).data("videoController")){var e=new d(this,b);a(this).data("videoController",e)}else if("undefined"!=typeof b){var f=a(this).data("videoController");"function"==typeof f[b]?f[b].apply(f,c):a.error(b+" does not exist in videoController.")}})};var e=function(b){this.$video=b,this.player=null,this.ready=!1,this.started=!1,this.state="",this.events=a({}),this._init()};e.prototype={_init:function(){},play:function(){},pause:function(){},stop:function(){},replay:function(){},isType:function(){},isReady:function(){return this.ready},isStarted:function(){return this.started},getState:function(){return this.state},on:function(a,b){return this.events.on(a,b)},off:function(a){return this.events.off(a)},trigger:function(a){return this.events.triggerHandler(a)}};var f={youtubeAPIAdded:!1,youtubeVideos:[]},g=function(b){this.init=!1;var c=window.YT&&window.YT.Player;if("undefined"!=typeof c)e.call(this,b);else if(f.youtubeVideos.push({video:b,scope:this}),f.youtubeAPIAdded===!1){f.youtubeAPIAdded=!0;var d=document.createElement("script");d.src="http://www.youtube.com/player_api";var g=document.getElementsByTagName("script")[0];g.parentNode.insertBefore(d,g),window.onYouTubePlayerAPIReady=function(){a.each(f.youtubeVideos,function(a,b){e.call(b.scope,b.video)})}}};g.prototype=new e,g.prototype.constructor=g,a.VideoController.addPlayer("YoutubeVideo",g),g.isType=function(a){if(a.is("iframe")){var b=a.attr("src");if(-1!==b.indexOf("youtube.com")||-1!==b.indexOf("youtu.be"))return!0}return!1},g.prototype._init=function(){this.init=!0,this._setup()},g.prototype._setup=function(){var a=this;this.player=new YT.Player(this.$video[0],{events:{onReady:function(){a.trigger({type:"ready"}),a.ready=!0},onStateChange:function(b){switch(b.data){case YT.PlayerState.PLAYING:a.started===!1&&(a.started=!0,a.trigger({type:"start"})),a.state="playing",a.trigger({type:"play"});break;case YT.PlayerState.PAUSED:a.state="paused",a.trigger({type:"pause"});break;case YT.PlayerState.ENDED:a.state="ended",a.trigger({type:"ended"})}}}})},g.prototype.play=function(){this.player.playVideo()},g.prototype.pause=function(){c===!0?this.stop():this.player.pauseVideo()},g.prototype.stop=function(){this.player.seekTo(1),this.player.stopVideo(),this.state="stopped"},g.prototype.replay=function(){this.player.seekTo(1),this.player.playVideo()},g.prototype.on=function(a,b){var c=this;if(this.init===!0)e.prototype.on.call(this,a,b);else var d=setInterval(function(){c.init===!0&&(clearInterval(d),e.prototype.on.call(c,a,b))},100)};var h={vimeoAPIAdded:!1,vimeoVideos:[]},i=function(b){if(this.init=!1,"undefined"!=typeof window.Froogaloop)e.call(this,b);else if(h.vimeoVideos.push({video:b,scope:this}),h.vimeoAPIAdded===!1){h.vimeoAPIAdded=!0;var c=document.createElement("script");c.src="http://a.vimeocdn.com/js/froogaloop2.min.js";var d=document.getElementsByTagName("script")[0];d.parentNode.insertBefore(c,d);var f=setInterval(function(){"undefined"!=typeof window.Froogaloop&&(clearInterval(f),a.each(h.vimeoVideos,function(a,b){e.call(b.scope,b.video)}))},100)}};i.prototype=new e,i.prototype.constructor=i,a.VideoController.addPlayer("VimeoVideo",i),i.isType=function(a){if(a.is("iframe")){var b=a.attr("src");if(-1!==b.indexOf("vimeo.com"))return!0}return!1},i.prototype._init=function(){this.init=!0,this._setup()},i.prototype._setup=function(){var a=this;this.player=$f(this.$video[0]),this.player.addEvent("ready",function(){a.ready=!0,a.trigger({type:"ready"}),a.player.addEvent("play",function(){a.started===!1&&(a.started=!0,a.trigger({type:"start"})),a.state="playing",a.trigger({type:"play"})}),a.player.addEvent("pause",function(){a.state="paused",a.trigger({type:"pause"})}),a.player.addEvent("finish",function(){a.state="ended",a.trigger({type:"ended"})})})},i.prototype.play=function(){this.player.api("play")},i.prototype.pause=function(){this.player.api("pause")},i.prototype.stop=function(){this.player.api("seekTo",0),this.player.api("pause"),this.state="stopped"},i.prototype.replay=function(){this.player.api("seekTo",0),this.player.api("play")},i.prototype.on=function(a,b){var c=this;if(this.init===!0)e.prototype.on.call(this,a,b);else var d=setInterval(function(){c.init===!0&&(clearInterval(d),e.prototype.on.call(c,a,b))},100)};var j=function(a){e.call(this,a)};j.prototype=new e,j.prototype.constructor=j,a.VideoController.addPlayer("HTML5Video",j),j.isType=function(a){return a.is("video")&&a.hasClass("video-js")===!1&&a.hasClass("sublime")===!1?!0:!1},j.prototype._init=function(){var a=this;this.player=this.$video[0],this.ready=!0,this.player.addEventListener("play",function(){a.started===!1&&(a.started=!0,a.trigger({type:"start"})),a.state="playing",a.trigger({type:"play"})}),this.player.addEventListener("pause",function(){a.state="paused",a.trigger({type:"pause"})}),this.player.addEventListener("ended",function(){a.state="ended",a.trigger({type:"ended"})})},j.prototype.play=function(){this.player.play()},j.prototype.pause=function(){this.player.pause()},j.prototype.stop=function(){this.player.currentTime=0,this.player.pause(),this.state="stopped"},j.prototype.replay=function(){this.player.currentTime=0,this.player.play()};var k=function(a){e.call(this,a)};k.prototype=new e,k.prototype.constructor=k,a.VideoController.addPlayer("VideoJSVideo",k),k.isType=function(a){return"undefined"==typeof a.attr("data-videojs-id")&&!a.hasClass("video-js")||"undefined"==typeof videojs?!1:!0},k.prototype._init=function(){var a=this,b=this.$video.hasClass("video-js")?this.$video.attr("id"):this.$video.attr("data-videojs-id");this.player=videojs(b),this.player.ready(function(){a.ready=!0,a.trigger({type:"ready"}),a.player.on("play",function(){a.started===!1&&(a.started=!0,a.trigger({type:"start"})),a.state="playing",a.trigger({type:"play"})}),a.player.on("pause",function(){a.state="paused",a.trigger({type:"pause"})}),a.player.on("ended",function(){a.state="ended",a.trigger({type:"ended"})})})},k.prototype.play=function(){this.player.play()},k.prototype.pause=function(){this.player.pause()},k.prototype.stop=function(){this.player.currentTime(0),this.player.pause(),this.state="stopped"},k.prototype.replay=function(){this.player.currentTime(0),this.player.play()};var l=function(a){e.call(this,a)};l.prototype=new e,l.prototype.constructor=l,a.VideoController.addPlayer("SublimeVideo",l),l.isType=function(a){return a.hasClass("sublime")&&"undefined"!=typeof sublime?!0:!1},l.prototype._init=function(){var a=this;sublime.ready(function(){a.player=sublime.player(a.$video.attr("id")),a.ready=!0,a.trigger({type:"ready"}),a.player.on("play",function(){a.started===!1&&(a.started=!0,a.trigger({type:"start"})),a.state="playing",a.trigger({type:"play"})}),a.player.on("pause",function(){a.state="paused",a.trigger({type:"pause"})}),a.player.on("stop",function(){a.state="stopped",a.trigger({type:"stop"})}),a.player.on("end",function(){a.state="ended",a.trigger({type:"ended"})})})},l.prototype.play=function(){this.player.play()},l.prototype.pause=function(){this.player.pause()},l.prototype.stop=function(){this.player.stop()},l.prototype.replay=function(){this.player.stop(),this.player.play()};var m=function(a){e.call(this,a)};m.prototype=new e,m.prototype.constructor=m,a.VideoController.addPlayer("JWPlayerVideo",m),m.isType=function(a){return"undefined"==typeof a.attr("data-jwplayer-id")&&!a.hasClass("jwplayer")&&0===a.find("object[data*='jwplayer']").length||"undefined"==typeof jwplayer?!1:!0},m.prototype._init=function(){var a,b=this;this.$video.hasClass("jwplayer")?a=this.$video.attr("id"):"undefined"!=typeof this.$video.attr("data-jwplayer-id")?a=this.$video.attr("data-jwplayer-id"):0!==this.$video.find("object[data*='jwplayer']").length&&(a=this.$video.find("object").attr("id")),this.player=jwplayer(a),this.player.onReady(function(){b.ready=!0,b.trigger({type:"ready"}),b.player.onPlay(function(){b.started===!1&&(b.started=!0,b.trigger({type:"start"})),b.state="playing",b.trigger({type:"play"})}),b.player.onPause(function(){b.state="paused",b.trigger({type:"pause"})}),b.player.onComplete(function(){b.state="ended",b.trigger({type:"ended"})})})},m.prototype.play=function(){this.player.play(!0)},m.prototype.pause=function(){this.player.pause(!0)},m.prototype.stop=function(){this.player.stop(),this.state="stopped"},m.prototype.replay=function(){this.player.seek(0),this.player.play(!0)}}(jQuery);



// Ion.RangeSlider | version 1.9.3 | https://github.com/IonDen/ion.rangeSlider
(function(c,ea,aa,M){var ba=0,r,N=function(){var c=M.userAgent,a=/msie\s\d+/i;return 0<c.search(a)&&(c=a.exec(c).toString(),c=c.split(" ")[1],9>c)?!0:!1}(),X="ontouchstart"in aa||0<M.msMaxTouchPoints,O=function(c){"number"!==typeof c&&(c=parseFloat(c));return isNaN(c)?null:c},H={init:function(fa){return this.each(function(){var a=c.extend({min:null,max:null,from:null,to:null,type:"single",step:null,prefix:"",postfix:"",maxPostfix:"",hasGrid:!1,gridMargin:0,hideMinMax:!1,hideFromTo:!1,prettify:!0,
disable:!1,values:null,onLoad:null,onChange:null,onFinish:null},fa),e=c(this),l=this,I=!1,g=null;if(!e.data("isActive")){e.data("isActive",!0);this.plugin_count=ba+=1;e.prop("value")&&(g=e.prop("value").split(";"));"single"===a.type?g&&1<g.length?("number"!==typeof a.min?a.min=parseFloat(g[0]):"number"!==typeof a.from&&(a.from=parseFloat(g[0])),"number"!==typeof a.max&&(a.max=parseFloat(g[1]))):g&&1===g.length&&"number"!==typeof a.from&&(a.from=parseFloat(g[0])):"double"===a.type&&(g&&1<g.length?
("number"!==typeof a.min?a.min=parseFloat(g[0]):"number"!==typeof a.from&&(a.from=parseFloat(g[0])),"number"!==typeof a.max?a.max=parseFloat(g[1]):"number"!==typeof a.to&&(a.to=parseFloat(g[1]))):g&&1===g.length&&("number"!==typeof a.min?a.min=parseFloat(g[0]):"number"!==typeof a.from&&(a.from=parseFloat(g[0]))));"number"===typeof e.data("min")&&(a.min=parseFloat(e.data("min")));"number"===typeof e.data("max")&&(a.max=parseFloat(e.data("max")));"number"===typeof e.data("from")&&(a.from=parseFloat(e.data("from")));
"number"===typeof e.data("to")&&(a.to=parseFloat(e.data("to")));e.data("step")&&(a.step=parseFloat(e.data("step")));e.data("type")&&(a.type=e.data("type"));e.data("prefix")&&(a.prefix=e.data("prefix"));e.data("postfix")&&(a.postfix=e.data("postfix"));e.data("maxpostfix")&&(a.maxPostfix=e.data("maxpostfix"));e.data("hasgrid")&&(a.hasGrid=e.data("hasgrid"));e.data("gridmargin")&&(a.gridMargin=+e.data("gridmargin"));e.data("hideminmax")&&(a.hideMinMax=e.data("hideminmax"));e.data("hidefromto")&&(a.hideFromTo=
e.data("hidefromto"));e.data("prettify")&&(a.prettify=e.data("prettify"));e.data("disable")&&(a.disable=e.data("disable"));e.data("values")&&(a.values=e.data("values").split(","));a.min=O(a.min);a.min||0===a.min||(a.min=10);a.max=O(a.max);a.max||0===a.max||(a.max=100);"[object Array]"!==Object.prototype.toString.call(a.values)&&(a.values=null);a.values&&0<a.values.length&&(a.min=0,a.max=a.values.length-1,a.step=1,I=!0);a.from=O(a.from);a.from||0===a.from||(a.from=a.min);a.to=O(a.to);a.to||0===a.to||
(a.to=a.max);a.step=O(a.step);a.step||(a.step=1);a.from<a.min&&(a.from=a.min);a.from>a.max&&(a.from=a.min);a.to<a.min&&(a.to=a.max);a.to>a.max&&(a.to=a.max);"double"===a.type&&(a.from>a.to&&(a.from=a.to),a.to<a.from&&(a.to=a.from));var z=function(b){b=b.toString();a.prettify&&(b=b.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g,"$1 "));return b},g='<span class="irs" id="irs-'+this.plugin_count+'"></span>';e[0].style.display="none";e.before(g);var n=e.prev(),C=c(ea.body),P=c(aa),p,D,E,A,B,w,x,m,s,q,H,Y,
v=!1,y=!1,J=!0,f={},U=0,Q=0,R=0,t=0,F=0,G=0,V=0,S=0,T=0,Z=0,u=0;parseInt(a.step,10)!==parseFloat(a.step)&&(u=a.step.toString().split(".")[1],u=Math.pow(10,u.length));this.updateData=function(b){c.extend(a,b);n.find("*").off();P.off("mouseup.irs"+l.plugin_count);C.off("mouseup.irs"+l.plugin_count);C.off("mouseleave.irs"+l.plugin_count);C.off("mousemove.irs"+l.plugin_count);n.html("");M()};this.removeSlider=function(){n.find("*").off();P.off("mouseup.irs"+l.plugin_count);C.off("mouseup.irs"+l.plugin_count);
C.off("mouseleave.irs"+l.plugin_count);C.off("mousemove.irs"+l.plugin_count);n.html("").remove();e.data("isActive",!1);e.show()};var M=function(){n.html('<span class="irs"><span class="irs-line"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span><span class="irs-min">0</span><span class="irs-max">1</span><span class="irs-from">0</span><span class="irs-to">0</span><span class="irs-single">0</span></span><span class="irs-grid"></span>');p=
n.find(".irs");D=p.find(".irs-min");E=p.find(".irs-max");A=p.find(".irs-from");B=p.find(".irs-to");w=p.find(".irs-single");Y=n.find(".irs-grid");a.hideFromTo&&(A[0].style.visibility="hidden",B[0].style.visibility="hidden",w[0].style.visibility="hidden");a.hideFromTo||(A[0].style.visibility="visible",B[0].style.visibility="visible",w[0].style.visibility="visible");a.hideMinMax&&(D[0].style.visibility="hidden",E[0].style.visibility="hidden",R=Q=0);a.hideMinMax||(D[0].style.visibility="visible",E[0].style.visibility=
"visible",a.values?(D.html(a.prefix+a.values[0]+a.postfix),E.html(a.prefix+a.values[a.values.length-1]+a.maxPostfix+a.postfix)):(D.html(a.prefix+z(a.min)+a.postfix),E.html(a.prefix+z(a.max)+a.maxPostfix+a.postfix)),Q=D.outerWidth(!1),R=E.outerWidth(!1));ga()},ga=function(){if("single"===a.type){if(p.append('<span class="irs-slider single"></span>'),x=p.find(".single"),x.on("mousedown",function(a){a.preventDefault();a.stopPropagation();K(a,c(this),null);y=v=!0;r=l.plugin_count;N&&c("*").prop("unselectable",
!0)}),X)x.on("touchstart",function(a){a.preventDefault();a.stopPropagation();K(a.originalEvent.touches[0],c(this),null);y=v=!0;r=l.plugin_count})}else"double"===a.type&&(p.append('<span class="irs-diapason"></span><span class="irs-slider from"></span><span class="irs-slider to"></span>'),m=p.find(".from"),s=p.find(".to"),H=p.find(".irs-diapason"),L(),m.on("mousedown",function(a){a.preventDefault();a.stopPropagation();c(this).addClass("last");s.removeClass("last");K(a,c(this),"from");y=v=!0;r=l.plugin_count;
N&&c("*").prop("unselectable",!0)}),s.on("mousedown",function(a){a.preventDefault();a.stopPropagation();c(this).addClass("last");m.removeClass("last");K(a,c(this),"to");y=v=!0;r=l.plugin_count;N&&c("*").prop("unselectable",!0)}),X&&(m.on("touchstart",function(a){a.preventDefault();a.stopPropagation();c(this).addClass("last");s.removeClass("last");K(a.originalEvent.touches[0],c(this),"from");y=v=!0;r=l.plugin_count}),s.on("touchstart",function(a){a.preventDefault();a.stopPropagation();c(this).addClass("last");
m.removeClass("last");K(a.originalEvent.touches[0],c(this),"to");y=v=!0;r=l.plugin_count})),a.to===a.max&&m.addClass("last"));var b=function(){r===l.plugin_count&&v&&(v=y=!1,q.removeAttr("id"),q=null,"double"===a.type&&L(),$(),N&&c("*").prop("unselectable",!1))};P.on("mouseup.irs"+l.plugin_count,function(){b()});if(N)C.on("mouseleave.irs"+l.plugin_count,function(){b()});C.on("mousemove.irs"+l.plugin_count,function(a){v&&(U=a.pageX,W())});n.on("mousedown",function(){r=l.plugin_count});n.on("mouseup",
function(b){if(r===l.plugin_count&&!v&&!a.disable){b=b.pageX;J=!1;b-=n.offset().left;var h=f.fromX+(f.toX-f.fromX)/2;S=0;V=p.width()-G;T=p.width()-G;"single"===a.type?(q=x,q.prop("id","irs-active-slider"),W(b)):"double"===a.type&&(q=b<=h?m:s,q.prop("id","irs-active-slider"),W(b),L());q.removeAttr("id");q=null}});X&&(P.on("touchend",function(){v&&(v=y=!1,q.removeAttr("id"),q=null,"double"===a.type&&L(),$())}),P.on("touchmove",function(a){v&&(U=a.originalEvent.touches[0].pageX,W())}));ca();ha();a.hasGrid&&
ia();a.disable?(n.addClass("irs-disabled"),n.append('<span class="irs-disable-mask"></span>')):(n.removeClass("irs-disabled"),n.find(".irs-disable-mask").remove())},ca=function(){t=p.width();G=x?x.width():m.width();F=t-G},K=function(b,d,h){ca();J=!1;q=d;q.prop("id","irs-active-slider");d=q.offset().left;Z=d+(b.pageX-d)-q.position().left;"single"===a.type?V=p.width()-G:"double"===a.type&&("from"===h?(S=0,T=parseInt(s.css("left"),10)):(S=parseInt(m.css("left"),10),T=p.width()-G))},L=function(){var a=
m.width(),d=c.data(m[0],"x")||parseInt(m[0].style.left,10)||m.position().left,h=(c.data(s[0],"x")||parseInt(s[0].style.left,10)||s.position().left)-d;H[0].style.left=d+a/2+"px";H[0].style.width=h+"px"},W=function(b){var d=U-Z,d=b?b:U-Z;"single"===a.type?(0>d&&(d=0),d>V&&(d=V)):"double"===a.type&&(d<S&&(d=S),d>T&&(d=T),L());c.data(q[0],"x",d);$();b=Math.round(d);q[0].style.left=b+"px"},$=function(){var b={input:e,slider:n,min:a.min,max:a.max,fromNumber:0,toNumber:0,fromPers:0,toPers:0,fromX:0,fromX_pure:0,
toX:0,toX_pure:0},d=a.max-a.min,h;"single"===a.type?(b.fromX=c.data(x[0],"x")||parseInt(x[0].style.left,10)||x.position().left,b.fromPers=b.fromX/F*100,h=d/100*b.fromPers+a.min,b.fromNumber=Math.round(h/a.step)*a.step,b.fromNumber<a.min&&(b.fromNumber=a.min),b.fromNumber>a.max&&(b.fromNumber=a.max),u&&(b.fromNumber=parseInt(b.fromNumber*u,10)/u),I&&(b.fromValue=a.values[b.fromNumber])):"double"===a.type&&(b.fromX=c.data(m[0],"x")||parseInt(m[0].style.left,10)||m.position().left,b.fromPers=b.fromX/
F*100,h=d/100*b.fromPers+a.min,b.fromNumber=Math.round(h/a.step)*a.step,b.fromNumber<a.min&&(b.fromNumber=a.min),b.toX=c.data(s[0],"x")||parseInt(s[0].style.left,10)||s.position().left,b.toPers=b.toX/F*100,d=d/100*b.toPers+a.min,b.toNumber=Math.round(d/a.step)*a.step,b.toNumber>a.max&&(b.toNumber=a.max),u&&(b.fromNumber=parseInt(b.fromNumber*u,10)/u,b.toNumber=parseInt(b.toNumber*u,10)/u),I&&(b.fromValue=a.values[b.fromNumber],b.toValue=a.values[b.toNumber]));f=b;da()},ha=function(){var b={input:e,
slider:n,min:a.min,max:a.max,fromNumber:a.from,toNumber:a.to,fromPers:0,toPers:0,fromX:0,fromX_pure:0,toX:0,toX_pure:0},d=a.max-a.min;"single"===a.type?(b.fromPers=0!==d?(b.fromNumber-a.min)/d*100:0,b.fromX_pure=F/100*b.fromPers,b.fromX=Math.round(b.fromX_pure),x[0].style.left=b.fromX+"px",c.data(x[0],"x",b.fromX_pure)):"double"===a.type&&(b.fromPers=0!==d?(b.fromNumber-a.min)/d*100:0,b.fromX_pure=F/100*b.fromPers,b.fromX=Math.round(b.fromX_pure),m[0].style.left=b.fromX+"px",c.data(m[0],"x",b.fromX_pure),
b.toPers=0!==d?(b.toNumber-a.min)/d*100:1,b.toX_pure=F/100*b.toPers,b.toX=Math.round(b.toX_pure),s[0].style.left=b.toX+"px",c.data(s[0],"x",b.toX_pure),L());f=b;da()},da=function(){var b,d,h,c,g,k;k=G/2;h="";"single"===a.type?(h=f.fromNumber===a.max?a.maxPostfix:"",A[0].style.display="none",B[0].style.display="none",h=I?a.prefix+a.values[f.fromNumber]+h+a.postfix:a.prefix+z(f.fromNumber)+h+a.postfix,w.html(h),g=w.outerWidth(!1),k=f.fromX-g/2+k,0>k&&(k=0),k>t-g&&(k=t-g),w[0].style.left=k+"px",a.hideMinMax||
a.hideFromTo||(D[0].style.display=k<Q?"none":"block",E[0].style.display=k+g>t-R?"none":"block"),e.prop("value",parseFloat(f.fromNumber))):"double"===a.type&&(h=f.toNumber===a.max?a.maxPostfix:"",I?(b=a.prefix+a.values[f.fromNumber]+a.postfix,d=a.prefix+a.values[f.toNumber]+h+a.postfix,h=f.fromNumber!==f.toNumber?a.prefix+a.values[f.fromNumber]+" \u2014 "+a.prefix+a.values[f.toNumber]+h+a.postfix:a.prefix+a.values[f.fromNumber]+h+a.postfix):(b=a.prefix+z(f.fromNumber)+a.postfix,d=a.prefix+z(f.toNumber)+
h+a.postfix,h=f.fromNumber!==f.toNumber?a.prefix+z(f.fromNumber)+" \u2014 "+a.prefix+z(f.toNumber)+h+a.postfix:a.prefix+z(f.fromNumber)+h+a.postfix),A.html(b),B.html(d),w.html(h),b=A.outerWidth(!1),d=f.fromX-b/2+k,0>d&&(d=0),d>t-b&&(d=t-b),A[0].style.left=d+"px",h=B.outerWidth(!1),c=f.toX-h/2+k,0>c&&(c=0),c>t-h&&(c=t-h),B[0].style.left=c+"px",g=w.outerWidth(!1),k=f.fromX+(f.toX-f.fromX)/2-g/2+k,0>k&&(k=0),k>t-g&&(k=t-g),w[0].style.left=k+"px",d+b<c?(w[0].style.display="none",A[0].style.display="block",
B[0].style.display="block"):(w[0].style.display="block",A[0].style.display="none",B[0].style.display="none"),a.hideMinMax||a.hideFromTo||(D[0].style.display=k<Q||d<Q?"none":"block",E[0].style.display=k+g>t-R||c+h>t-R?"none":"block"),e.prop("value",parseFloat(f.fromNumber)+";"+parseFloat(f.toNumber)));a.from=f.fromNumber;a.to=f.toNumber;ja()},ja=function(){"function"!==typeof a.onFinish||y||J||a.onFinish.call(this,f);"function"!==typeof a.onChange||J||a.onChange.call(this,f);"function"===typeof a.onLoad&&
!y&&J&&(a.onLoad.call(this,f),J=!1)},ia=function(){n.addClass("irs-with-grid");var b,d="",c=0,c=0,e="",f=t-2*a.gridMargin;for(b=0;20>=b;b+=1)c=Math.floor(f/20*b),c>=f&&(c=f-1),e+='<span class="irs-grid-pol small" style="left: '+c+'px;"></span>';for(b=0;4>=b;b+=1)c=Math.floor(f/4*b),c>=f&&(c=f-1),e+='<span class="irs-grid-pol" style="left: '+c+'px;"></span>',u?(d=a.min+(a.max-a.min)/4*b,d=d/a.step*a.step,d=parseInt(d*u,10)/u):(d=Math.round(a.min+(a.max-a.min)/4*b),d=Math.round(d/a.step)*a.step,d=z(d)),
I&&(a.hideMinMax?(d=Math.round(a.min+(a.max-a.min)/4*b),d=Math.round(d/a.step)*a.step,d=0===b||4===b?a.values[d]:""):d=""),0===b?e+='<span class="irs-grid-text" style="left: '+c+'px; text-align: left;">'+d+"</span>":4===b?(c-=100,e+='<span class="irs-grid-text" style="left: '+c+'px; text-align: right;">'+d+"</span>"):(c-=50,e+='<span class="irs-grid-text" style="left: '+c+'px;">'+d+"</span>");Y.html(e);Y[0].style.left=a.gridMargin+"px"};M()}})},update:function(c){return this.each(function(){this.updateData(c)})},
remove:function(){return this.each(function(){this.removeSlider()})}};c.fn.ionRangeSlider=function(r){if(H[r])return H[r].apply(this,Array.prototype.slice.call(arguments,1));if("object"!==typeof r&&r)c.error("Method "+r+" does not exist for jQuery.ionRangeSlider");else return H.init.apply(this,arguments)}})(jQuery,document,window,navigator);



/*

* Price Format jQuery Plugin
* Created By Eduardo Cuducos
* Currently maintained by Flavio Silveira flavio [at] gmail [dot] com
* Version: 2.0
* Release: 2014-01-26

*/

(function(e){e.fn.priceFormat=function(t){var n={prefix:"US$ ",suffix:"",centsSeparator:".",thousandsSeparator:",",limit:false,centsLimit:2,clearPrefix:false,clearSufix:false,allowNegative:false,insertPlusSign:false,clearOnEmpty:false};var t=e.extend(n,t);return this.each(function(){function m(e){if(n.is("input"))n.val(e);else n.html(e)}function g(){if(n.is("input"))r=n.val();else r=n.html();return r}function y(e){var t="";for(var n=0;n<e.length;n++){char_=e.charAt(n);if(t.length==0&&char_==0)char_=false;if(char_&&char_.match(i)){if(f){if(t.length<f)t=t+char_}else{t=t+char_}}}return t}function b(e){while(e.length<l+1)e="0"+e;return e}function w(t,n){if(!n&&(t===""||t==w("0",true))&&v)return"";var r=b(y(t));var i="";var f=0;if(l==0){u="";c=""}var c=r.substr(r.length-l,l);var h=r.substr(0,r.length-l);r=l==0?h:h+u+c;if(a||e.trim(a)!=""){for(var m=h.length;m>0;m--){char_=h.substr(m-1,1);f++;if(f%3==0)char_=a+char_;i=char_+i}if(i.substr(0,1)==a)i=i.substring(1,i.length);r=l==0?i:i+u+c}if(p&&(h!=0||c!=0)){if(t.indexOf("-")!=-1&&t.indexOf("+")<t.indexOf("-")){r="-"+r}else{if(!d)r=""+r;else r="+"+r}}if(s)r=s+r;if(o)r=r+o;return r}function E(e){var t=e.keyCode?e.keyCode:e.which;var n=String.fromCharCode(t);var i=false;var s=r;var o=w(s+n);if(t>=48&&t<=57||t>=96&&t<=105)i=true;if(t==8)i=true;if(t==9)i=true;if(t==13)i=true;if(t==46)i=true;if(t==37)i=true;if(t==39)i=true;if(p&&(t==189||t==109||t==173))i=true;if(d&&(t==187||t==107||t==61))i=true;if(!i){e.preventDefault();e.stopPropagation();if(s!=o)m(o)}}function S(){var e=g();var t=w(e);if(e!=t)m(t);if(parseFloat(e)==0&&v)m("")}function x(){n.val(s+g())}function T(){n.val(g()+o)}function N(){if(e.trim(s)!=""&&c){var t=g().split(s);m(t[1])}}function C(){if(e.trim(o)!=""&&h){var t=g().split(o);m(t[0])}}var n=e(this);var r="";var i=/[0-9]/;if(n.is("input"))r=n.val();else r=n.html();var s=t.prefix;var o=t.suffix;var u=t.centsSeparator;var a=t.thousandsSeparator;var f=t.limit;var l=t.centsLimit;var c=t.clearPrefix;var h=t.clearSuffix;var p=t.allowNegative;var d=t.insertPlusSign;var v=t.clearOnEmpty;if(d)p=true;n.bind("keydown.price_format",E);n.bind("keyup.price_format",S);n.bind("focusout.price_format",S);if(c){n.bind("focusout.price_format",function(){N()});n.bind("focusin.price_format",function(){x()})}if(h){n.bind("focusout.price_format",function(){C()});n.bind("focusin.price_format",function(){T()})}if(g().length>0){S();N();C()}})};e.fn.unpriceFormat=function(){return e(this).unbind(".price_format")};e.fn.unmask=function(){var t;var n="";if(e(this).is("input"))t=e(this).val();else t=e(this).html();for(var r in t){if(!isNaN(t[r])||t[r]=="-")n+=t[r]}return n}})(jQuery)