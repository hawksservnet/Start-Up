!function(t,e){"object"==typeof exports&&"object"==typeof module?module.exports=e():"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?exports.Scrollbar=e():t.Scrollbar=e()}(this,function(){return function(t){function e(r){if(n[r])return n[r].exports;var o=n[r]={exports:{},id:r,loaded:!1};return t[r].call(o.exports,o,o.exports,e),o.loaded=!0,o.exports}var n={};return e.m=t,e.c=n,e.p="",e(0)}([function(t,e,n){t.exports=n(1)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if(t&&t.__esModule)return t;var e={};if(null!=t)for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&(e[n]=t[n]);return e.default=t,e}function i(t){if(Array.isArray(t)){for(var e=0,n=Array(t.length);e<t.length;e++)n[e]=t[e];return n}return(0,c.default)(t)}function u(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}var a=n(2),c=r(a),l=n(55),f=r(l),s=n(58),d=r(s),v=n(65),h=r(v);Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var p,y,g,_,b="function"==typeof h.default&&"symbol"==typeof d.default?function(t){return typeof t}:function(t){return t&&"function"==typeof h.default&&t.constructor===h.default&&t!==h.default.prototype?"symbol":typeof t},m=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),(0,f.default)(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),P=n(81),M=n(87),x=n(108),E=n(112),O=n(146),w=o(O);n(212);var S=(p=(0,M.apiMixin)(w),p((_=g=function(){function t(e,n){u(this,t),x.init.call(this,e,n),x.ScbList.set(e,this)}return m(t,[{key:"targets",get:function(){return E.getPrivateProp.call(this,"targets")}},{key:"offset",get:function(){return E.getPrivateProp.call(this,"offset")}},{key:"limit",get:function(){return E.getPrivateProp.call(this,"limit")}},{key:"containerElement",get:function(){return this.targets.container}},{key:"contentElement",get:function(){return this.targets.content}},{key:"scrollTop",get:function(){return this.offset.y}},{key:"scrollLeft",get:function(){return this.offset.x}}],[{key:"init",value:function(e,n){if(!e||1!==e.nodeType)throw new TypeError("expect element to be DOM Element, but got "+("undefined"==typeof e?"undefined":b(e)));if(x.ScbList.has(e))return x.ScbList.get(e);e.setAttribute("data-scrollbar","");var r=[].concat(i(e.childNodes)),o=document.createElement("div");o.innerHTML='\n            <article class="scroll-content"></article>\n            <aside class="scrollbar-track scrollbar-track-x">\n                <div class="scrollbar-thumb scrollbar-thumb-x"></div>\n            </aside>\n            <aside class="scrollbar-track scrollbar-track-y">\n                <div class="scrollbar-thumb scrollbar-thumb-y"></div>\n            </aside>\n            <canvas class="overscroll-glow"></canvas>\n        ';var u=o.querySelector(".scroll-content");return[].concat(i(o.childNodes)).forEach(function(t){return e.appendChild(t)}),r.forEach(function(t){return u.appendChild(t)}),new t(e,n)}},{key:"initAll",value:function(e){return[].concat(i(document.querySelectorAll(P.SELECTOR))).map(function(n){return t.init(n,e)})}},{key:"has",value:function(t){return x.ScbList.has(t)}},{key:"get",value:function(t){return x.ScbList.get(t)}},{key:"getAll",value:function(){return[].concat(i(x.ScbList.values()))}},{key:"destroy",value:function(e,n){return t.has(e)&&t.get(e).destroy(n)}},{key:"destroyAll",value:function(t){x.ScbList.forEach(function(e){e.destroy(t)})}}]),t}(),g.version="7.2.9",y=_))||y);e.default=S,t.exports=e.default},function(t,e,n){t.exports={default:n(3),__esModule:!0}},function(t,e,n){n(4),n(48),t.exports=n(12).Array.from},function(t,e,n){"use strict";var r=n(5)(!0);n(8)(String,"String",function(t){this._t=String(t),this._i=0},function(){var t,e=this._t,n=this._i;return n>=e.length?{value:void 0,done:!0}:(t=r(e,n),this._i+=t.length,{value:t,done:!1})})},function(t,e,n){var r=n(6),o=n(7);t.exports=function(t){return function(e,n){var i,u,a=String(o(e)),c=r(n),l=a.length;return c<0||c>=l?t?"":void 0:(i=a.charCodeAt(c),i<55296||i>56319||c+1===l||(u=a.charCodeAt(c+1))<56320||u>57343?t?a.charAt(c):i:t?a.slice(c,c+2):(i-55296<<10)+(u-56320)+65536)}}},function(t,e){var n=Math.ceil,r=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?r:n)(t)}},function(t,e){t.exports=function(t){if(void 0==t)throw TypeError("Can't call method on  "+t);return t}},function(t,e,n){"use strict";var r=n(9),o=n(10),i=n(25),u=n(15),a=n(26),c=n(27),l=n(28),f=n(44),s=n(46),d=n(45)("iterator"),v=!([].keys&&"next"in[].keys()),h="@@iterator",p="keys",y="values",g=function(){return this};t.exports=function(t,e,n,_,b,m,P){l(n,e,_);var M,x,E,O=function(t){if(!v&&t in k)return k[t];switch(t){case p:return function(){return new n(this,t)};case y:return function(){return new n(this,t)}}return function(){return new n(this,t)}},w=e+" Iterator",S=b==y,j=!1,k=t.prototype,T=k[d]||k[h]||b&&k[b],A=T||O(b),R=b?S?O("entries"):A:void 0,L="Array"==e?k.entries||T:T;if(L&&(E=s(L.call(new t)),E!==Object.prototype&&(f(E,w,!0),r||a(E,d)||u(E,d,g))),S&&T&&T.name!==y&&(j=!0,A=function(){return T.call(this)}),r&&!P||!v&&!j&&k[d]||u(k,d,A),c[e]=A,c[w]=g,b)if(M={values:S?A:O(y),keys:m?A:O(p),entries:R},P)for(x in M)x in k||i(k,x,M[x]);else o(o.P+o.F*(v||j),e,M);return M}},function(t,e){t.exports=!0},function(t,e,n){var r=n(11),o=n(12),i=n(13),u=n(15),a="prototype",c=function(t,e,n){var l,f,s,d=t&c.F,v=t&c.G,h=t&c.S,p=t&c.P,y=t&c.B,g=t&c.W,_=v?o:o[e]||(o[e]={}),b=_[a],m=v?r:h?r[e]:(r[e]||{})[a];v&&(n=e);for(l in n)f=!d&&m&&void 0!==m[l],f&&l in _||(s=f?m[l]:n[l],_[l]=v&&"function"!=typeof m[l]?n[l]:y&&f?i(s,r):g&&m[l]==s?function(t){var e=function(e,n,r){if(this instanceof t){switch(arguments.length){case 0:return new t;case 1:return new t(e);case 2:return new t(e,n)}return new t(e,n,r)}return t.apply(this,arguments)};return e[a]=t[a],e}(s):p&&"function"==typeof s?i(Function.call,s):s,p&&((_.virtual||(_.virtual={}))[l]=s,t&c.R&&b&&!b[l]&&u(b,l,s)))};c.F=1,c.G=2,c.S=4,c.P=8,c.B=16,c.W=32,c.U=64,c.R=128,t.exports=c},function(t,e){var n=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=n)},function(t,e){var n=t.exports={version:"2.4.0"};"number"==typeof __e&&(__e=n)},function(t,e,n){var r=n(14);t.exports=function(t,e,n){if(r(t),void 0===e)return t;switch(n){case 1:return function(n){return t.call(e,n)};case 2:return function(n,r){return t.call(e,n,r)};case 3:return function(n,r,o){return t.call(e,n,r,o)}}return function(){return t.apply(e,arguments)}}},function(t,e){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},function(t,e,n){var r=n(16),o=n(24);t.exports=n(20)?function(t,e,n){return r.f(t,e,o(1,n))}:function(t,e,n){return t[e]=n,t}},function(t,e,n){var r=n(17),o=n(19),i=n(23),u=Object.defineProperty;e.f=n(20)?Object.defineProperty:function(t,e,n){if(r(t),e=i(e,!0),r(n),o)try{return u(t,e,n)}catch(t){}if("get"in n||"set"in n)throw TypeError("Accessors not supported!");return"value"in n&&(t[e]=n.value),t}},function(t,e,n){var r=n(18);t.exports=function(t){if(!r(t))throw TypeError(t+" is not an object!");return t}},function(t,e){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}},function(t,e,n){t.exports=!n(20)&&!n(21)(function(){return 7!=Object.defineProperty(n(22)("div"),"a",{get:function(){return 7}}).a})},function(t,e,n){t.exports=!n(21)(function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a})},function(t,e){t.exports=function(t){try{return!!t()}catch(t){return!0}}},function(t,e,n){var r=n(18),o=n(11).document,i=r(o)&&r(o.createElement);t.exports=function(t){return i?o.createElement(t):{}}},function(t,e,n){var r=n(18);t.exports=function(t,e){if(!r(t))return t;var n,o;if(e&&"function"==typeof(n=t.toString)&&!r(o=n.call(t)))return o;if("function"==typeof(n=t.valueOf)&&!r(o=n.call(t)))return o;if(!e&&"function"==typeof(n=t.toString)&&!r(o=n.call(t)))return o;throw TypeError("Can't convert object to primitive value")}},function(t,e){t.exports=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}}},function(t,e,n){t.exports=n(15)},function(t,e){var n={}.hasOwnProperty;t.exports=function(t,e){return n.call(t,e)}},function(t,e){t.exports={}},function(t,e,n){"use strict";var r=n(29),o=n(24),i=n(44),u={};n(15)(u,n(45)("iterator"),function(){return this}),t.exports=function(t,e,n){t.prototype=r(u,{next:o(1,n)}),i(t,e+" Iterator")}},function(t,e,n){var r=n(17),o=n(30),i=n(42),u=n(39)("IE_PROTO"),a=function(){},c="prototype",l=function(){var t,e=n(22)("iframe"),r=i.length,o="<",u=">";for(e.style.display="none",n(43).appendChild(e),e.src="javascript:",t=e.contentWindow.document,t.open(),t.write(o+"script"+u+"document.F=Object"+o+"/script"+u),t.close(),l=t.F;r--;)delete l[c][i[r]];return l()};t.exports=Object.create||function(t,e){var n;return null!==t?(a[c]=r(t),n=new a,a[c]=null,n[u]=t):n=l(),void 0===e?n:o(n,e)}},function(t,e,n){var r=n(16),o=n(17),i=n(31);t.exports=n(20)?Object.defineProperties:function(t,e){o(t);for(var n,u=i(e),a=u.length,c=0;a>c;)r.f(t,n=u[c++],e[n]);return t}},function(t,e,n){var r=n(32),o=n(42);t.exports=Object.keys||function(t){return r(t,o)}},function(t,e,n){var r=n(26),o=n(33),i=n(36)(!1),u=n(39)("IE_PROTO");t.exports=function(t,e){var n,a=o(t),c=0,l=[];for(n in a)n!=u&&r(a,n)&&l.push(n);for(;e.length>c;)r(a,n=e[c++])&&(~i(l,n)||l.push(n));return l}},function(t,e,n){var r=n(34),o=n(7);t.exports=function(t){return r(o(t))}},function(t,e,n){var r=n(35);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==r(t)?t.split(""):Object(t)}},function(t,e){var n={}.toString;t.exports=function(t){return n.call(t).slice(8,-1)}},function(t,e,n){var r=n(33),o=n(37),i=n(38);t.exports=function(t){return function(e,n,u){var a,c=r(e),l=o(c.length),f=i(u,l);if(t&&n!=n){for(;l>f;)if(a=c[f++],a!=a)return!0}else for(;l>f;f++)if((t||f in c)&&c[f]===n)return t||f||0;return!t&&-1}}},function(t,e,n){var r=n(6),o=Math.min;t.exports=function(t){return t>0?o(r(t),9007199254740991):0}},function(t,e,n){var r=n(6),o=Math.max,i=Math.min;t.exports=function(t,e){return t=r(t),t<0?o(t+e,0):i(t,e)}},function(t,e,n){var r=n(40)("keys"),o=n(41);t.exports=function(t){return r[t]||(r[t]=o(t))}},function(t,e,n){var r=n(11),o="__core-js_shared__",i=r[o]||(r[o]={});t.exports=function(t){return i[t]||(i[t]={})}},function(t,e){var n=0,r=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++n+r).toString(36))}},function(t,e){t.exports="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",")},function(t,e,n){t.exports=n(11).document&&document.documentElement},function(t,e,n){var r=n(16).f,o=n(26),i=n(45)("toStringTag");t.exports=function(t,e,n){t&&!o(t=n?t:t.prototype,i)&&r(t,i,{configurable:!0,value:e})}},function(t,e,n){var r=n(40)("wks"),o=n(41),i=n(11).Symbol,u="function"==typeof i,a=t.exports=function(t){return r[t]||(r[t]=u&&i[t]||(u?i:o)("Symbol."+t))};a.store=r},function(t,e,n){var r=n(26),o=n(47),i=n(39)("IE_PROTO"),u=Object.prototype;t.exports=Object.getPrototypeOf||function(t){return t=o(t),r(t,i)?t[i]:"function"==typeof t.constructor&&t instanceof t.constructor?t.constructor.prototype:t instanceof Object?u:null}},function(t,e,n){var r=n(7);t.exports=function(t){return Object(r(t))}},function(t,e,n){"use strict";var r=n(13),o=n(10),i=n(47),u=n(49),a=n(50),c=n(37),l=n(51),f=n(52);o(o.S+o.F*!n(54)(function(t){Array.from(t)}),"Array",{from:function(t){var e,n,o,s,d=i(t),v="function"==typeof this?this:Array,h=arguments.length,p=h>1?arguments[1]:void 0,y=void 0!==p,g=0,_=f(d);if(y&&(p=r(p,h>2?arguments[2]:void 0,2)),void 0==_||v==Array&&a(_))for(e=c(d.length),n=new v(e);e>g;g++)l(n,g,y?p(d[g],g):d[g]);else for(s=_.call(d),n=new v;!(o=s.next()).done;g++)l(n,g,y?u(s,p,[o.value,g],!0):o.value);return n.length=g,n}})},function(t,e,n){var r=n(17);t.exports=function(t,e,n,o){try{return o?e(r(n)[0],n[1]):e(n)}catch(e){var i=t.return;throw void 0!==i&&r(i.call(t)),e}}},function(t,e,n){var r=n(27),o=n(45)("iterator"),i=Array.prototype;t.exports=function(t){return void 0!==t&&(r.Array===t||i[o]===t)}},function(t,e,n){"use strict";var r=n(16),o=n(24);t.exports=function(t,e,n){e in t?r.f(t,e,o(0,n)):t[e]=n}},function(t,e,n){var r=n(53),o=n(45)("iterator"),i=n(27);t.exports=n(12).getIteratorMethod=function(t){if(void 0!=t)return t[o]||t["@@iterator"]||i[r(t)]}},function(t,e,n){var r=n(35),o=n(45)("toStringTag"),i="Arguments"==r(function(){return arguments}()),u=function(t,e){try{return t[e]}catch(t){}};t.exports=function(t){var e,n,a;return void 0===t?"Undefined":null===t?"Null":"string"==typeof(n=u(e=Object(t),o))?n:i?r(e):"Object"==(a=r(e))&&"function"==typeof e.callee?"Arguments":a}},function(t,e,n){var r=n(45)("iterator"),o=!1;try{var i=[7][r]();i.return=function(){o=!0},Array.from(i,function(){throw 2})}catch(t){}t.exports=function(t,e){if(!e&&!o)return!1;var n=!1;try{var i=[7],u=i[r]();u.next=function(){return{done:n=!0}},i[r]=function(){return u},t(i)}catch(t){}return n}},function(t,e,n){t.exports={default:n(56),__esModule:!0}},function(t,e,n){n(57);var r=n(12).Object;t.exports=function(t,e,n){return r.defineProperty(t,e,n)}},function(t,e,n){var r=n(10);r(r.S+r.F*!n(20),"Object",{defineProperty:n(16).f})},function(t,e,n){t.exports={default:n(59),__esModule:!0}},function(t,e,n){n(4),n(60),t.exports=n(64).f("iterator")},function(t,e,n){n(61);for(var r=n(11),o=n(15),i=n(27),u=n(45)("toStringTag"),a=["NodeList","DOMTokenList","MediaList","StyleSheetList","CSSRuleList"],c=0;c<5;c++){var l=a[c],f=r[l],s=f&&f.prototype;s&&!s[u]&&o(s,u,l),i[l]=i.Array}},function(t,e,n){"use strict";var r=n(62),o=n(63),i=n(27),u=n(33);t.exports=n(8)(Array,"Array",function(t,e){this._t=u(t),this._i=0,this._k=e},function(){var t=this._t,e=this._k,n=this._i++;return!t||n>=t.length?(this._t=void 0,o(1)):"keys"==e?o(0,n):"values"==e?o(0,t[n]):o(0,[n,t[n]])},"values"),i.Arguments=i.Array,r("keys"),r("values"),r("entries")},function(t,e){t.exports=function(){}},function(t,e){t.exports=function(t,e){return{value:e,done:!!t}}},function(t,e,n){e.f=n(45)},function(t,e,n){t.exports={default:n(66),__esModule:!0}},function(t,e,n){n(67),n(78),n(79),n(80),t.exports=n(12).Symbol},function(t,e,n){"use strict";var r=n(11),o=n(26),i=n(20),u=n(10),a=n(25),c=n(68).KEY,l=n(21),f=n(40),s=n(44),d=n(41),v=n(45),h=n(64),p=n(69),y=n(70),g=n(71),_=n(74),b=n(17),m=n(33),P=n(23),M=n(24),x=n(29),E=n(75),O=n(77),w=n(16),S=n(31),j=O.f,k=w.f,T=E.f,A=r.Symbol,R=r.JSON,L=R&&R.stringify,D="prototype",I=v("_hidden"),C=v("toPrimitive"),N={}.propertyIsEnumerable,F=f("symbol-registry"),B=f("symbols"),z=f("op-symbols"),H=Object[D],V="function"==typeof A,G=r.QObject,W=!G||!G[D]||!G[D].findChild,U=i&&l(function(){return 7!=x(k({},"a",{get:function(){return k(this,"a",{value:7}).a}})).a})?function(t,e,n){var r=j(H,e);r&&delete H[e],k(t,e,n),r&&t!==H&&k(H,e,r)}:k,K=function(t){var e=B[t]=x(A[D]);return e._k=t,e},q=V&&"symbol"==typeof A.iterator?function(t){return"symbol"==typeof t}:function(t){return t instanceof A},X=function(t,e,n){return t===H&&X(z,e,n),b(t),e=P(e,!0),b(n),o(B,e)?(n.enumerable?(o(t,I)&&t[I][e]&&(t[I][e]=!1),n=x(n,{enumerable:M(0,!1)})):(o(t,I)||k(t,I,M(1,{})),t[I][e]=!0),U(t,e,n)):k(t,e,n)},J=function(t,e){b(t);for(var n,r=g(e=m(e)),o=0,i=r.length;i>o;)X(t,n=r[o++],e[n]);return t},Y=function(t,e){return void 0===e?x(t):J(x(t),e)},Q=function(t){var e=N.call(this,t=P(t,!0));return!(this===H&&o(B,t)&&!o(z,t))&&(!(e||!o(this,t)||!o(B,t)||o(this,I)&&this[I][t])||e)},Z=function(t,e){if(t=m(t),e=P(e,!0),t!==H||!o(B,e)||o(z,e)){var n=j(t,e);return!n||!o(B,e)||o(t,I)&&t[I][e]||(n.enumerable=!0),n}},$=function(t){for(var e,n=T(m(t)),r=[],i=0;n.length>i;)o(B,e=n[i++])||e==I||e==c||r.push(e);return r},tt=function(t){for(var e,n=t===H,r=T(n?z:m(t)),i=[],u=0;r.length>u;)!o(B,e=r[u++])||n&&!o(H,e)||i.push(B[e]);return i};V||(A=function(){if(this instanceof A)throw TypeError("Symbol is not a constructor!");var t=d(arguments.length>0?arguments[0]:void 0),e=function(n){this===H&&e.call(z,n),o(this,I)&&o(this[I],t)&&(this[I][t]=!1),U(this,t,M(1,n))};return i&&W&&U(H,t,{configurable:!0,set:e}),K(t)},a(A[D],"toString",function(){return this._k}),O.f=Z,w.f=X,n(76).f=E.f=$,n(73).f=Q,n(72).f=tt,i&&!n(9)&&a(H,"propertyIsEnumerable",Q,!0),h.f=function(t){return K(v(t))}),u(u.G+u.W+u.F*!V,{Symbol:A});for(var et="hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables".split(","),nt=0;et.length>nt;)v(et[nt++]);for(var et=S(v.store),nt=0;et.length>nt;)p(et[nt++]);u(u.S+u.F*!V,"Symbol",{for:function(t){return o(F,t+="")?F[t]:F[t]=A(t)},keyFor:function(t){if(q(t))return y(F,t);throw TypeError(t+" is not a symbol!")},useSetter:function(){W=!0},useSimple:function(){W=!1}}),u(u.S+u.F*!V,"Object",{create:Y,defineProperty:X,defineProperties:J,getOwnPropertyDescriptor:Z,getOwnPropertyNames:$,getOwnPropertySymbols:tt}),R&&u(u.S+u.F*(!V||l(function(){var t=A();return"[null]"!=L([t])||"{}"!=L({a:t})||"{}"!=L(Object(t))})),"JSON",{stringify:function(t){if(void 0!==t&&!q(t)){for(var e,n,r=[t],o=1;arguments.length>o;)r.push(arguments[o++]);return e=r[1],"function"==typeof e&&(n=e),!n&&_(e)||(e=function(t,e){if(n&&(e=n.call(this,t,e)),!q(e))return e}),r[1]=e,L.apply(R,r)}}}),A[D][C]||n(15)(A[D],C,A[D].valueOf),s(A,"Symbol"),s(Math,"Math",!0),s(r.JSON,"JSON",!0)},function(t,e,n){var r=n(41)("meta"),o=n(18),i=n(26),u=n(16).f,a=0,c=Object.isExtensible||function(){return!0},l=!n(21)(function(){return c(Object.preventExtensions({}))}),f=function(t){u(t,r,{value:{i:"O"+ ++a,w:{}}})},s=function(t,e){if(!o(t))return"symbol"==typeof t?t:("string"==typeof t?"S":"P")+t;if(!i(t,r)){if(!c(t))return"F";if(!e)return"E";f(t)}return t[r].i},d=function(t,e){if(!i(t,r)){if(!c(t))return!0;if(!e)return!1;f(t)}return t[r].w},v=function(t){return l&&h.NEED&&c(t)&&!i(t,r)&&f(t),t},h=t.exports={KEY:r,NEED:!1,fastKey:s,getWeak:d,onFreeze:v}},function(t,e,n){var r=n(11),o=n(12),i=n(9),u=n(64),a=n(16).f;t.exports=function(t){var e=o.Symbol||(o.Symbol=i?{}:r.Symbol||{});"_"==t.charAt(0)||t in e||a(e,t,{value:u.f(t)})}},function(t,e,n){var r=n(31),o=n(33);t.exports=function(t,e){for(var n,i=o(t),u=r(i),a=u.length,c=0;a>c;)if(i[n=u[c++]]===e)return n}},function(t,e,n){var r=n(31),o=n(72),i=n(73);t.exports=function(t){var e=r(t),n=o.f;if(n)for(var u,a=n(t),c=i.f,l=0;a.length>l;)c.call(t,u=a[l++])&&e.push(u);return e}},function(t,e){e.f=Object.getOwnPropertySymbols},function(t,e){e.f={}.propertyIsEnumerable},function(t,e,n){var r=n(35);t.exports=Array.isArray||function(t){return"Array"==r(t)}},function(t,e,n){var r=n(33),o=n(76).f,i={}.toString,u="object"==typeof window&&window&&Object.getOwnPropertyNames?Object.getOwnPropertyNames(window):[],a=function(t){try{return o(t)}catch(t){return u.slice()}};t.exports.f=function(t){return u&&"[object Window]"==i.call(t)?a(t):o(r(t))}},function(t,e,n){var r=n(32),o=n(42).concat("length","prototype");e.f=Object.getOwnPropertyNames||function(t){return r(t,o)}},function(t,e,n){var r=n(73),o=n(24),i=n(33),u=n(23),a=n(26),c=n(19),l=Object.getOwnPropertyDescriptor;e.f=n(20)?l:function(t,e){if(t=i(t),e=u(e,!0),c)try{return l(t,e)}catch(t){}if(a(t,e))return o(!r.f.call(t,e),t[e])}},function(t,e){},function(t,e,n){n(69)("asyncIterator")},function(t,e,n){n(69)("observable")},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(86);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(105);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})});var f=n(106);(0,a.default)(f).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return f[t]}})});var s=n(107);(0,a.default)(s).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return s[t]}})})},function(t,e,n){t.exports={default:n(83),__esModule:!0}},function(t,e,n){n(84),t.exports=n(12).Object.keys},function(t,e,n){var r=n(47),o=n(31);n(85)("keys",function(){return function(t){return o(r(t))}})},function(t,e,n){var r=n(10),o=n(12),i=n(21);t.exports=function(t,e){var n=(o.Object||{})[t]||Object[t],u={};u[t]=e(n),r(r.S+r.F*i(function(){n(1)}),"Object",u)}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.GLOBAL_ENV=void 0;var r=n(87),o={MutationObserver:function(){return window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver},TOUCH_SUPPORTED:function(){return"ontouchstart"in document},EASING_MULTIPLIER:function(){return navigator.userAgent.match(/Android/)?.5:.25},WHEEL_EVENT:function(){return"onwheel"in window?"wheel":"mousewheel"}};e.GLOBAL_ENV=(0,r.memoize)(o)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(88);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(89);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})});var f=n(90);(0,a.default)(f).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return f[t]}})});var s=n(91);(0,a.default)(s).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return s[t]}})});var d=n(92);(0,a.default)(d).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return d[t]}})});var v=n(93);(0,a.default)(v).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return v[t]}})});var h=n(94);(0,a.default)(h).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return h[t]}})});var p=n(95);(0,a.default)(p).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return p[t]}})});var y=n(96);(0,a.default)(y).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return y[t]}})});var g=n(97);(0,a.default)(g).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return g[t]}})});var _=n(98);(0,a.default)(_).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return _[t]}})});var b=n(99);(0,a.default)(b).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return b[t]}})});var m=n(100);(0,a.default)(m).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return m[t]}})})},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){return function(e){(0,c.default)(t).forEach(function(n){(0,u.default)(e.prototype,n,{value:t[n],enumerable:!1,writable:!0,configurable:!0})})}}var i=n(55),u=r(i),a=n(82),c=r(a);Object.defineProperty(e,"__esModule",{value:!0}),e.apiMixin=o},function(t,e){"use strict";function n(t,e){var n=[];if(e<=0)return n;for(var r=Math.round(e/1e3*60),o=-t/Math.pow(r,2),i=-2*o*r,u=0;u<r;u++)n.push(o*Math.pow(u,2)+i*u);return n}Object.defineProperty(e,"__esModule",{value:!0}),e.buildCurve=n},function(t,e){"use strict";function n(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:r,n=!(arguments.length>2&&void 0!==arguments[2])||arguments[2];if("function"==typeof t){var o=void 0;return function(){for(var r=arguments.length,i=Array(r),u=0;u<r;u++)i[u]=arguments[u];!o&&n&&setTimeout(function(){return t.apply(void 0,i)}),clearTimeout(o),o=setTimeout(function(){o=void 0,t.apply(void 0,i)},e)}}}Object.defineProperty(e,"__esModule",{value:!0}),e.debounce=n;var r=100},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if(Array.isArray(t)){for(var e=0,n=Array(t.length);e<t.length;e++)n[e]=t[e];return n}return(0,a.default)(t)}function i(t,e){var n=t.children,r=null;return n&&[].concat(o(n)).some(function(t){if(t.className.match(e))return r=t,!0}),r}var u=n(2),a=r(u);Object.defineProperty(e,"__esModule",{value:!0}),e.findChild=i},function(t,e){"use strict";function n(t){if("deltaX"in t){var e=i(t.deltaMode);return{x:t.deltaX/r.STANDARD*e,y:t.deltaY/r.STANDARD*e}}return"wheelDeltaX"in t?{x:t.wheelDeltaX/r.OTHERS,y:t.wheelDeltaY/r.OTHERS}:{x:0,y:t.wheelDelta/r.OTHERS}}Object.defineProperty(e,"__esModule",{value:!0}),e.getDelta=n;var r={STANDARD:1,OTHERS:-3},o=[1,28,500],i=function(t){return o[t]||o[0]}},function(t,e){"use strict";function n(t){return t.touches?t.touches[t.touches.length-1]:t}Object.defineProperty(e,"__esModule",{value:!0}),e.getPointerData=n},function(t,e,n){"use strict";function r(t){var e=(0,o.getPointerData)(t);return{x:e.clientX,y:e.clientY}}Object.defineProperty(e,"__esModule",{value:!0}),e.getPointerPosition=r;var o=n(93)},function(t,e,n){"use strict";function r(t){var e=(0,o.getPointerData)(t);return e.identifier}Object.defineProperty(e,"__esModule",{value:!0}),e.getTouchID=r;var o=n(93)},function(t,e){"use strict";function n(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[];return e.some(function(e){return t===e})}Object.defineProperty(e,"__esModule",{value:!0}),e.isOneOf=n},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){var e={},n={};return(0,c.default)(t).forEach(function(r){(0,u.default)(e,r,{get:function(){if(!n.hasOwnProperty(r)){var e=t[r];n[r]=e()}return n[r]}})}),e}var i=n(55),u=r(i),a=n(82),c=r(a);Object.defineProperty(e,"__esModule",{value:!0}),e.memoize=o},function(t,e){"use strict";function n(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:-(1/0),n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:1/0;return Math.max(e,Math.min(t,n))}Object.defineProperty(e,"__esModule",{value:!0}),e.pickInRange=n},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){e=l(e),(0,u.default)(e).forEach(function(n){var r=n.replace(/^-/,"").replace(/-([a-z])/g,function(t,e){return e.toUpperCase()});t.style[r]=e[n]})}var i=n(82),u=r(i);Object.defineProperty(e,"__esModule",{value:!0}),e.setStyle=o;var a=["webkit","moz","ms","o"],c=new RegExp("^-(?!(?:"+a.join("|")+")-)"),l=function(t){var e={};return(0,u.default)(t).forEach(function(n){if(!c.test(n))return void(e[n]=t[n]);var r=t[n];n=n.replace(/^-/,""),e[n]=r,a.forEach(function(t){e["-"+t+"-"+n]=r})}),e}},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if(Array.isArray(t)){for(var e=0,n=Array(t.length);e<t.length;e++)n[e]=t[e];return n}return(0,a.default)(t)}function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}var u=n(2),a=r(u),c=n(55),l=r(c),f=n(101),s=r(f);Object.defineProperty(e,"__esModule",{value:!0}),e.TouchRecord=void 0;var d=s.default||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(t[r]=n[r])}return t},v=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),(0,l.default)(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),h=n(94),p=function(){function t(e){i(this,t),this.updateTime=Date.now(),this.delta={x:0,y:0},this.velocity={x:0,y:0},this.lastPosition=(0,h.getPointerPosition)(e)}return v(t,[{key:"update",value:function(t){var e=this.velocity,n=this.updateTime,r=this.lastPosition,o=Date.now(),i=(0,h.getPointerPosition)(t),u={x:-(i.x-r.x),y:-(i.y-r.y)},a=o-n||16,c=u.x/a*1e3,l=u.y/a*1e3;e.x=.8*c+.2*e.x,e.y=.8*l+.2*e.y,this.delta=u,this.updateTime=o,this.lastPosition=i}}]),t}();e.TouchRecord=function(){function t(){i(this,t),this.touchList={},this.lastTouch=null,this.activeTouchID=void 0}return v(t,[{key:"add",value:function(t){if(this.has(t))return null;var e=new p(t);return this.touchList[t.identifier]=e,e}},{key:"renew",value:function(t){if(!this.has(t))return null;var e=this.touchList[t.identifier];return e.update(t),e}},{key:"delete",value:function(t){return delete this.touchList[t.identifier]}},{key:"has",value:function(t){return this.touchList.hasOwnProperty(t.identifier)}},{key:"setActiveID",value:function(t){this.activeTouchID=t[t.length-1].identifier,this.lastTouch=this.touchList[this.activeTouchID]}},{key:"getActiveTracker",value:function(){var t=this.touchList,e=this.activeTouchID;return t[e]}},{key:"isActive",value:function(){return void 0!==this.activeTouchID}},{key:"getDelta",value:function(){var t=this.getActiveTracker();return t?d({},t.delta):this.primitiveValue}},{key:"getVelocity",value:function(){var t=this.getActiveTracker();return t?d({},t.velocity):this.primitiveValue}},{key:"getLastPosition",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",e=this.getActiveTracker()||this.lastTouch,n=e?e.lastPosition:this.primitiveValue;return t?n.hasOwnProperty(t)?n[t]:0:d({},n)}},{key:"updatedRecently",value:function(){var t=this.getActiveTracker();return t&&Date.now()-t.updateTime<30}},{key:"track",value:function(t){var e=this,n=t.targetTouches;return[].concat(o(n)).forEach(function(t){e.add(t)}),this.touchList}},{key:"update",value:function(t){var e=this,n=t.touches,r=t.changedTouches;return[].concat(o(n)).forEach(function(t){e.renew(t)}),this.setActiveID(r),this.touchList}},{key:"release",value:function(t){var e=this;return this.activeTouchID=void 0,[].concat(o(t.changedTouches)).forEach(function(t){e.delete(t)}),this.touchList}},{key:"primitiveValue",get:function(){return{x:0,y:0}}}]),t}()},function(t,e,n){t.exports={default:n(102),__esModule:!0}},function(t,e,n){n(103),t.exports=n(12).Object.assign},function(t,e,n){var r=n(10);r(r.S+r.F,"Object",{assign:n(104)})},function(t,e,n){"use strict";var r=n(31),o=n(72),i=n(73),u=n(47),a=n(34),c=Object.assign;t.exports=!c||n(21)(function(){var t={},e={},n=Symbol(),r="abcdefghijklmnopqrst";return t[n]=7,r.split("").forEach(function(t){e[t]=t}),7!=c({},t)[n]||Object.keys(c({},e)).join("")!=r})?function(t,e){for(var n=u(t),c=arguments.length,l=1,f=o.f,s=i.f;c>l;)for(var d,v=a(arguments[l++]),h=f?r(v).concat(f(v)):r(v),p=h.length,y=0;p>y;)s.call(v,d=h[y++])&&(n[d]=v[d]);return n}:c},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});e.OVERSCROLL_GLOW="glow",e.OVERSCROLL_BOUNCE="bounce"},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(65),i=r(o);Object.defineProperty(e,"__esModule",{value:!0});e.PRIVATE_PROPS=(0,i.default)("Private.props"),e.PRIVATE_METHODS=(0,i.default)("Private.methods")},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});e.SELECTOR="scrollbar, [scrollbar], [data-scrollbar]"},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(109);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(181);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})})},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if(t&&t.__esModule)return t;var e={};if(null!=t)for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&(e[n]=t[n]);return e.default=t,e}function i(t){var e=this,n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};
d.initPrivates.call(this),h.initTargets.call(this,t),v.initOptions.call(this,n),f.update.call(this),(0,a.default)(l).forEach(function(t){var n=l[t];n.call(e)}),s.render.call(this)}var u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0}),e.init=i;var c=n(110),l=o(c),f=n(146),s=n(133),d=n(173),v=n(177),h=n(180)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(111);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(161);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})});var f=n(162);(0,a.default)(f).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return f[t]}})});var s=n(163);(0,a.default)(s).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return s[t]}})});var d=n(164);(0,a.default)(d).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return d[t]}})});var v=n(165);(0,a.default)(v).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return v[t]}})});var h=n(166);(0,a.default)(h).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return h[t]}})})},function(t,e,n){"use strict";function r(){var t=this,e=i.getPrivateProp.call(this,"targets"),n=e.container,r=e.content,c=!1,l=void 0,f=void 0;i.setPrivateProp.call(this,{get isDraging(){return c}});var s=function e(n){var r=n.x,o=n.y;if(r||o){var u=i.getPrivateProp.call(t,"options"),c=u.speed;a.setMovement.call(t,r*c,o*c),l=requestAnimationFrame(function(){e({x:r,y:o})})}};u.addEvent.call(this,n,"dragstart",function(e){c=!0,f=e.target.clientHeight,(0,o.setStyle)(r,{"pointer-events":"auto"}),cancelAnimationFrame(l),u.updateBounding.call(t)}),u.addEvent.call(this,document,"dragover mousemove touchmove",function(e){if(c){cancelAnimationFrame(l),e.preventDefault();var n=u.getPointerOffset.call(t,e,f);s(n)}}),u.addEvent.call(this,document,"dragend mouseup touchend blur",function(){cancelAnimationFrame(l),c=!1})}Object.defineProperty(e,"__esModule",{value:!0}),e.handleDragEvents=r;var o=n(87),i=n(112),u=n(128),a=n(133)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(113);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(124);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})});var f=n(125);(0,a.default)(f).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return f[t]}})});var s=n(126);(0,a.default)(s).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return s[t]}})});var d=n(127);(0,a.default)(d).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return d[t]}})})},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){var n=this[y.PRIVATE_METHODS];return"object"===("undefined"==typeof t?"undefined":p(t))?!function(){var e=t;(0,f.default)(e).forEach(function(t){(0,c.default)(n,t,(0,u.default)(e,t))})}():n[t]=e,this}var i=n(114),u=r(i),a=n(117),c=r(a),l=n(120),f=r(l),s=n(58),d=r(s),v=n(65),h=r(v);Object.defineProperty(e,"__esModule",{value:!0});var p="function"==typeof h.default&&"symbol"==typeof d.default?function(t){return typeof t}:function(t){return t&&"function"==typeof h.default&&t.constructor===h.default&&t!==h.default.prototype?"symbol":typeof t};e.definePrivateMethod=o;var y=n(81)},function(t,e,n){t.exports={default:n(115),__esModule:!0}},function(t,e,n){n(116),t.exports=n(12).Reflect.getOwnPropertyDescriptor},function(t,e,n){var r=n(77),o=n(10),i=n(17);o(o.S,"Reflect",{getOwnPropertyDescriptor:function(t,e){return r.f(i(t),e)}})},function(t,e,n){t.exports={default:n(118),__esModule:!0}},function(t,e,n){n(119),t.exports=n(12).Reflect.defineProperty},function(t,e,n){var r=n(16),o=n(10),i=n(17),u=n(23);o(o.S+o.F*n(21)(function(){Reflect.defineProperty(r.f({},1,{value:1}),1,{value:2})}),"Reflect",{defineProperty:function(t,e,n){i(t),e=u(e,!0),i(n);try{return r.f(t,e,n),!0}catch(t){return!1}}})},function(t,e,n){t.exports={default:n(121),__esModule:!0}},function(t,e,n){n(122),t.exports=n(12).Reflect.ownKeys},function(t,e,n){var r=n(10);r(r.S,"Reflect",{ownKeys:n(123)})},function(t,e,n){var r=n(76),o=n(72),i=n(17),u=n(11).Reflect;t.exports=u&&u.ownKeys||function(t){var e=r.f(i(t)),n=o.f;return n?e.concat(n(t)):e}},function(t,e,n){"use strict";function r(t){for(var e=arguments.length,n=Array(e>1?e-1:0),r=1;r<e;r++)n[r-1]=arguments[r];return o.getPrivateMethod.call(this,t).apply(void 0,n)}Object.defineProperty(e,"__esModule",{value:!0}),e.callPrivateMethod=r;var o=n(125)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){var e=this,n=this[f.PRIVATE_METHODS];if("undefined"==typeof t){var r=function(){var t={};return Reflect.keys(n).forEach(function(r){t[r]=n[r].bind(e)}),{v:t}}();if("object"===("undefined"==typeof r?"undefined":l(r)))return r.v}return n[t].bind(this)}var i=n(58),u=r(i),a=n(65),c=r(a);Object.defineProperty(e,"__esModule",{value:!0});var l="function"==typeof c.default&&"symbol"==typeof u.default?function(t){return typeof t}:function(t){return t&&"function"==typeof c.default&&t.constructor===c.default&&t!==c.default.prototype?"symbol":typeof t};e.getPrivateMethod=o;var f=n(81)},function(t,e,n){"use strict";function r(t){var e=this[o.PRIVATE_PROPS];return"undefined"==typeof t?e:e[t]}Object.defineProperty(e,"__esModule",{value:!0}),e.getPrivateProp=r;var o=n(81)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){var n=this[y.PRIVATE_PROPS];return"object"===("undefined"==typeof t?"undefined":p(t))?!function(){var e=t;(0,f.default)(e).forEach(function(t){(0,c.default)(n,t,(0,u.default)(e,t))})}():n[t]=e,this}var i=n(114),u=r(i),a=n(117),c=r(a),l=n(120),f=r(l),s=n(58),d=r(s),v=n(65),h=r(v);Object.defineProperty(e,"__esModule",{value:!0});var p="function"==typeof h.default&&"symbol"==typeof d.default?function(t){return typeof t}:function(t){return t&&"function"==typeof h.default&&t.constructor===h.default&&t!==h.default.prototype?"symbol":typeof t};e.setPrivateProp=o;var y=n(81)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(129);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(130);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})});var f=n(131);(0,a.default)(f).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return f[t]}})});var s=n(132);(0,a.default)(s).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return s[t]}})})},function(t,e,n){"use strict";function r(t,e,n){if(!t||"function"!=typeof t.addEventListener)throw new TypeError("expect elem to be a DOM element, but got "+t);var r=o.getPrivateProp.call(this,"eventHandlers"),i=function(t){for(var e=arguments.length,r=Array(e>1?e-1:0),o=1;o<e;o++)r[o-1]=arguments[o];!t.type.match(/drag/)&&t.defaultPrevented||n.apply(void 0,[t].concat(r))};e.split(/\s+/g).forEach(function(e){r.push({evt:e,elem:t,fn:i,hasRegistered:!0}),t.addEventListener(e,i)})}Object.defineProperty(e,"__esModule",{value:!0}),e.addEvent=r;var o=n(112)},function(t,e,n){"use strict";function r(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,n=i.getPrivateProp.call(this,"bounding"),r=n.top,u=n.right,a=n.bottom,c=n.left,l=(0,o.getPointerPosition)(t),f=l.x,s=l.y,d={x:0,y:0};return 0===f&&0===s?d:(f>u-e?d.x=f-u+e:f<c+e&&(d.x=f-c-e),s>a-e?d.y=s-a+e:s<r+e&&(d.y=s-r-e),d)}Object.defineProperty(e,"__esModule",{value:!0}),e.getPointerOffset=r;var o=n(87),i=n(112)},function(t,e,n){"use strict";function r(){var t=o.getPrivateProp.call(this,"targets"),e=t.container,n=e.getBoundingClientRect(),r=n.top,i=n.right,u=n.bottom,a=n.left,c=window,l=c.innerHeight,f=c.innerWidth;o.setPrivateProp.call(this,"bounding",{top:Math.max(r,0),right:Math.min(i,f),bottom:Math.min(u,l),left:Math.max(a,0)})}Object.defineProperty(e,"__esModule",{value:!0}),

	e.updateBounding=r;var o=n(112)},function(t,e,n){"use strict";
	function r(){


		var t=i.getPrivateProp.call(this),
		e=t.targets,n=t.size,
		r=t.offset,
		u=t.thumbOffset,
		a=t.thumbSize;u.x=r.x/n.content.width*(n.container.width-(a.x-a.realX)),
		u.y=r.y/n.content.height*(n.container.height-(a.y-a.realY)),
		(0,o.setStyle)(e.xAxis.thumb,{"-transform":"translate3d("+u.x+"px, 0, 0)"}),
		(0,o.setStyle)(e.yAxis.thumb,{"-transform":"translate3d(0, "+u.y+"px, 0)"})


		// console.log("lib test",u);

		page.scroll.motion(u.y);

	}
	Object.defineProperty(e,"__esModule",{value:!0}),e.updateThumbPosition=r;var o=n(87),i=n(112)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(134);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(136);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})});var f=n(137);(0,a.default)(f).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return f[t]}})});var s=n(143);(0,a.default)(s).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return s[t]}})});var d=n(144);(0,a.default)(d).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return d[t]}})});var v=n(135);(0,a.default)(v).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return v[t]}})});var h=n(145);(0,a.default)(h).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return h[t]}})})},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if(Array.isArray(t)){for(var e=0,n=Array(t.length);e<t.length;e++)n[e]=t[e];return n}return(0,a.default)(t)}function i(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=f.getPrivateProp.call(this),i=r.limit,u=r.options,a=r.movement;f.callPrivateMethod.call(this,"updateDebounce"),u.renderByPixels&&(t=Math.round(t),e=Math.round(e));var s=0===i.x?0:a.x+t,d=0===i.y?0:a.y+e,v=l.getDeltaLimit.call(this,n);a.x=c.pickInRange.apply(void 0,[s].concat(o(v.x))),a.y=c.pickInRange.apply(void 0,[d].concat(o(v.y)))}var u=n(2),a=r(u);Object.defineProperty(e,"__esModule",{value:!0}),e.addMovement=i;var c=n(87),l=n(135),f=n(112)},function(t,e,n){"use strict";function r(){var t=arguments.length>0&&void 0!==arguments[0]&&arguments[0],e=o.getPrivateProp.call(this),n=e.options,r=e.offset,i=e.limit;return t&&(n.continuousScrolling||n.overscrollEffect)?{x:[-(1/0),1/0],y:[-(1/0),1/0]}:{x:[-r.x,i.x-r.x],y:[-r.y,i.y-r.y]}}Object.defineProperty(e,"__esModule",{value:!0}),e.getDeltaLimit=r;var o=n(112)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if(Array.isArray(t)){for(var e=0,n=Array(t.length);e<t.length;e++)n[e]=t[e];return n}return(0,a.default)(t)}function i(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=f.getPrivateProp.call(this),i=r.options,u=r.movement;f.callPrivateMethod.call(this,"updateDebounce");var a=l.getDeltaLimit.call(this,n);i.renderByPixels&&(t=Math.round(t),e=Math.round(e)),u.x=c.pickInRange.apply(void 0,[t].concat(o(a.x))),u.y=c.pickInRange.apply(void 0,[e].concat(o(a.y)))}var u=n(2),a=r(u);Object.defineProperty(e,"__esModule",{value:!0}),e.setMovement=i;var c=n(87),l=n(135),f=n(112)},function(t,e,n){"use strict";function r(t){var e=o.getPrivateProp.call(this),n=e.options,r=e.offset,u=e.movement,a=e.touchRecord,c=n.damping,l=n.renderByPixels,f=n.overscrollDamping,s=r[t],d=u[t],v=c;if(i.willOverscroll.call(this,t,d)?v=f:a.isActive()&&(v=.5),Math.abs(d)<1){var h=s+d;return{movement:0,position:d>0?Math.ceil(h):Math.floor(h)}}var p=d*(1-v);return l&&(p|=0),{movement:p,position:s+d-p}}Object.defineProperty(e,"__esModule",{value:!0}),e.getNextFrame=r;var o=n(112),i=n(138)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(139);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(142);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})})},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],n=v.getPrivateProp.call(this),r=n.options,o=n.overscrollRendered;if(e.length&&r.overscrollEffect){var a=l({},o);if(e.forEach(function(e){a[e]=i.call(t,e)}),u.call(this,a)){switch(r.overscrollEffect){case s.OVERSCROLL_BOUNCE:h.overscrollBounce.call(this,a.x,a.y);break;case s.OVERSCROLL_GLOW:p.overscrollGlow.call(this,a.x,a.y)}v.setPrivateProp.call(this,"overscrollRendered",a)}}}function i(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";if(t){var e=v.getPrivateProp.call(this),n=e.options,r=e.movement,o=e.overscrollRendered,i=e.MAX_OVERSCROLL,u=r[t]=(0,f.pickInRange)(r[t],-i,i),a=n.overscrollDamping,c=o[t]+(u-o[t])*a;return n.renderByPixels&&(c|=0),!d.isMovementLocked.call(this)&&Math.abs(c-o[t])<.1&&(c-=u/Math.abs(u||1)),Math.abs(c)<Math.abs(o[t])&&v.setPrivateProp.call(this,"overscrollBack",!0),(c*o[t]<0||Math.abs(c)<=1)&&(c=0,v.setPrivateProp.call(this,"overscrollBack",!1)),c}}function u(t){var e=v.getPrivateProp.call(this),n=e.touchRecord,r=e.overscrollRendered;return r.x!==t.x||r.y!==t.y||!(!s.GLOBAL_ENV.TOUCH_SUPPORTED||!n.updatedRecently())}var a=n(101),c=r(a);Object.defineProperty(e,"__esModule",{value:!0});var l=c.default||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(t[r]=n[r])}return t};e.renderOverscroll=o;var f=n(87),s=n(81),d=n(133),v=n(112),h=n(140),p=n(141)},function(t,e,n){"use strict";function r(t,e){var n=i.getPrivateProp.call(this),r=n.size,u=n.offset,a=n.targets,c=n.thumbOffset,l=a.xAxis,f=a.yAxis,s=a.content;if((0,o.setStyle)(s,{"-transform":"translate3d("+-(u.x+t)+"px, "+-(u.y+e)+"px, 0)"}),t){var d=r.container.width/(r.container.width+Math.abs(t));(0,o.setStyle)(l.thumb,{"-transform":"translate3d("+c.x+"px, 0, 0) scale3d("+d+", 1, 1)","-transform-origin":t<0?"left":"right"})}if(e){var v=r.container.height/(r.container.height+Math.abs(e));(0,o.setStyle)(f.thumb,{"-transform":"translate3d(0, "+c.y+"px, 0) scale3d(1, "+v+", 1)","-transform-origin":e<0?"top":"bottom"})}}Object.defineProperty(e,"__esModule",{value:!0}),e.overscrollBounce=r;var o=n(87),i=n(112)},function(t,e,n){"use strict";function r(t,e){var n=a.getPrivateProp.call(this),r=n.size,c=n.targets,l=n.options,f=c.canvas,s=f.elem,d=f.context;return t||e?((0,u.setStyle)(s,{display:"block"}),d.clearRect(0,0,r.content.width,r.container.height),d.fillStyle=l.overscrollEffectColor,o.call(this,t),void i.call(this,e)):(0,u.setStyle)(s,{display:"none"})}function o(t){var e=a.getPrivateProp.call(this),n=e.size,r=e.targets,o=e.touchRecord,i=e.MAX_OVERSCROLL,f=n.container,s=f.width,d=f.height,v=r.canvas.context;v.save(),t>0&&v.transform(-1,0,0,1,s,0);var h=(0,u.pickInRange)(Math.abs(t)/i,0,c),p=(0,u.pickInRange)(h,0,l)*s,y=Math.abs(t),g=o.getLastPosition("y")||d/2;v.globalAlpha=h,v.beginPath(),v.moveTo(0,-p),v.quadraticCurveTo(y,g,0,d+p),v.fill(),v.closePath(),v.restore()}function i(t){var e=a.getPrivateProp.call(this),n=e.size,r=e.targets,o=e.touchRecord,i=e.MAX_OVERSCROLL,f=n.container,s=f.width,d=f.height,v=r.canvas.context;v.save(),t>0&&v.transform(1,0,0,-1,0,d);var h=(0,u.pickInRange)(Math.abs(t)/i,0,c),p=(0,u.pickInRange)(h,0,l)*s,y=o.getLastPosition("x")||s/2,g=Math.abs(t);v.globalAlpha=h,v.beginPath(),v.moveTo(-p,0),v.quadraticCurveTo(y,g,s+p,0),v.fill(),v.closePath(),v.restore()}Object.defineProperty(e,"__esModule",{value:!0}),e.overscrollGlow=r;var u=n(87),a=n(112),c=.75,l=.25},function(t,e,n){"use strict";

function r(){
	var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",
		e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0;
		if(!t)return!1;

		var n=i.getPrivateProp.call(this),
			r=n.offset,
			u=n.limit,a=r[t];
			return(0,o.pickInRange)(e+a,0,u[t])===a&&(0===a||a===u[t])}Object.defineProperty(e,"__esModule",{value:!0}),
e.willOverscroll=r;

var o=n(87),i=n(112)},function(t,e,n){"use strict";function r(){var t=this,e=u.getPrivateProp.call(this),n=e.movement,r=e.movementLocked;c.forEach(function(e){r[e]=n[e]&&a.willOverscroll.call(t,e,n[e])})}function o(){var t=u.getPrivateProp.call(this),e=t.movementLocked;c.forEach(function(t){e[t]=!1})}function i(){var t=u.getPrivateProp.call(this),e=t.movementLocked;return e.x||e.y}Object.defineProperty(e,"__esModule",{value:!0}),e.autoLockMovement=r,e.unlockMovement=o,e.isMovementLocked=i;var u=n(112),a=n(138),c=["x","y"]},function(t,e,n){"use strict";function r(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,n=i.getPrivateProp.call(this),r=n.options,u=n.offset,a=n.limit;if(!r.continuousScrolling)return!1;var c=(0,o.pickInRange)(t+u.x,0,a.x),l=(0,o.pickInRange)(e+u.y,0,a.y),f=!0;return f&=c===u.x,f&=l===u.y,f&=c===a.x||0===c||l===a.y||0===l,f|=Math.abs(Math.min(t,e))<=5&&Math.abs(Math.max(t,e))>=20,Boolean(f)}Object.defineProperty(e,"__esModule",{value:!0}),e.shouldPropagateMovement=r;var o=n(87),i=n(112)},function(t,e,n){"use strict";function r(){var t=i.getPrivateProp.call(this),e=t.options,n=t.offset,l=t.limit,f=t.movement,s=t.movementLocked,d=t.overscrollRendered,v=t.timerID;if(f.x||f.y||d.x||d.y){var h=c.getNextFrame.call(this,"x"),p=c.getNextFrame.call(this,"y"),y=[];if(e.overscrollEffect){var g=(0,o.pickInRange)(h.position,0,l.x),_=(0,o.pickInRange)(p.position,0,l.y);(d.x||g===n.x&&f.x)&&y.push("x"),(d.y||_===n.y&&f.y)&&y.push("y")}s.x||(f.x=h.movement),s.y||(f.y=p.movement),u.setPosition.call(this,h.position,p.position),a.renderOverscroll.call(this,y)}v.render=requestAnimationFrame(r.bind(this))}Object.defineProperty(e,"__esModule",{value:!0}),e.render=r;var o=n(87),i=n(112),u=n(146),a=n(138),c=n(137)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}var o=n(55),i=r(o),u=n(82),a=r(u);Object.defineProperty(e,"__esModule",{value:!0});var c=n(147);(0,a.default)(c).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return c[t]}})});var l=n(148);(0,a.default)(l).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return l[t]}})});var f=n(152);(0,a.default)(f).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return f[t]}})});var s=n(153);(0,a.default)(s).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return s[t]}})});var d=n(154);(0,a.default)(d).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return d[t]}})});var v=n(156);(0,a.default)(v).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return v[t]}})});var h=n(155);(0,a.default)(h).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return h[t]}})});var p=n(157);(0,a.default)(p).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return p[t]}})});var y=n(158);(0,a.default)(y).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return y[t]}})});var g=n(149);(0,a.default)(g).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return g[t]}})});var _=n(159);(0,a.default)(_).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return _[t]}})});var b=n(150);(0,a.default)(b).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return b[t]}})});var m=n(151);(0,a.default)(m).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return m[t]}})});var P=n(160);(0,a.default)(P).forEach(function(t){"default"!==t&&"__esModule"!==t&&(0,i.default)(e,t,{enumerable:!0,get:function(){return P[t]}})})},function(t,e,n){"use strict";function r(){var t=o.getPrivateProp.call(this),e=t.movement,n=t.timerID;e.x=e.y=0,cancelAnimationFrame(n.scrollTo)}Object.defineProperty(e,"__esModule",{value:!0}),e.clearMovement=void 0,e.stop=r;var o=n(112);e.clearMovement=r},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if(Array.isArray(t)){for(var e=0,n=Array(t.length);e<t.length;e++)n[e]=t[e];return n}return(0,a.default)(t)}function i(t){var e=f.getPrivateProp.call(this),n=e.scrollListeners,r=e.eventHandlers,i=e.observer,u=e.targets,a=e.timerID,v=u.container,h=u.content;r.forEach(function(t){var e=t.evt,n=t.elem,r=t.fn;n.removeEventListener(e,r)}),r.length=n.length=0,s.clearMovement.call(this),cancelAnimationFrame(a.render),i&&i.disconnect(),l.ScbList.delete(v),t||d.scrollTo.call(this,0,0,300,function(){if(v.parentNode){(0,c.setStyle)(v,{overflow:""}),v.scrollTop=v.scrollLeft=0;var t=[].concat(o(h.childNodes));v.innerHTML="",t.forEach(function(t){return v.appendChild(t)})}})}var u=n(2),a=r(u);Object.defineProperty(e,"__esModule",{value:!0}),e.destroy=i;var c=n(87),l=n(108),f=n(112),s=n(147),d=n(149)},function(t,e,n){"use strict";function r(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:i.getPrivateProp.call(this,"offset").x,e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:i.getPrivateProp.call(this,"offset").y,n=this,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:0,a=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,c=i.getPrivateProp.call(this),l=c.options,f=c.offset,s=c.limit,d=c.timerID;cancelAnimationFrame(d.scrollTo),a="function"==typeof a?a:function(){},l.renderByPixels&&(t=Math.round(t),e=Math.round(e));var v=f.x,h=f.y,p=(0,o.pickInRange)(t,0,s.x)-v,y=(0,o.pickInRange)(e,0,s.y)-h,g=(0,o.buildCurve)(p,r),_=(0,o.buildCurve)(y,r),b=g.length,m=0,P=function r(){return m===b?(u.setPosition.call(n,t,e),requestAnimationFrame(function(){a(n)})):(u.setPosition.call(n,v+g[m],h+_[m]),m++,void(d.scrollTo=requestAnimationFrame(r)))};P()}Object.defineProperty(e,"__esModule",{value:!0}),e.scrollTo=r;var o=n(87),i=n(112),u=n(150)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.offset.x,e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:this.offset.y,n=arguments.length>2&&void 0!==arguments[2]&&arguments[2];l.callPrivateMethod.call(this,"hideTrackDebounce");var r={},o=l.getPrivateProp.call(this),i=o.options,u=o.offset,d=o.limit,v=o.targets,h=o.scrollListeners;i.renderByPixels&&(t=Math.round(t),e=Math.round(e)),Math.abs(t-u.x)>1&&s.showTrack.call(this,"x"),Math.abs(e-u.y)>1&&s.showTrack.call(this,"y"),t=(0,c.pickInRange)(t,0,d.x),e=(0,c.pickInRange)(e,0,d.y),t===u.x&&e===u.y||(r.direction={x:t===u.x?"none":t>u.x?"right":"left",y:e===u.y?"none":e>u.y?"down":"up"},l.setPrivateProp.call(this,"offset",{x:t,y:e}),r.offset={x:t,y:e},r.limit=a({},d),f.updateThumbPosition.call(this),(0,c.setStyle)(v.content,{"-transform":"translate3d("+-t+"px, "+-e+"px, 0)"}),n||h.forEach(function(t){i.syncCallbacks?t(r):requestAnimationFrame(function(){t(r)})}))}var i=n(101),u=r(i);Object.defineProperty(e,"__esModule",{value:!0});var a=u.default||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(t[r]=n[r])}return t};e.setPosition=o;var c=n(87),l=n(112),f=n(128),s=n(151)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e,n){return e in t?(0,a.default)(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function i(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:f.SHOW,e=d[t];return function(){var n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"both",r=l.getPrivateProp.call(this),o=r.options,i=r.movement,u=r.targets,a=u.container,c=u.xAxis,d=u.yAxis;i.x||i.y?a.classList.add(s.CONTAINER):a.classList.remove(s.CONTAINER),o.alwaysShowTracks&&t===f.HIDE||(n=n.toLowerCase(),"both"===n&&(c.track.classList[e](s.TRACK),d.track.classList[e](s.TRACK)),"x"===n&&c.track.classList[e](s.TRACK),"y"===n&&d.track.classList[e](s.TRACK))}}var u=n(55),a=r(u);Object.defineProperty(e,"__esModule",{value:!0}),e.hideTrack=e.showTrack=void 0;var c,l=n(112),f={SHOW:0,HIDE:1},s={TRACK:"show",CONTAINER:"scrolling"},d=(c={},o(c,f.SHOW,"add"),o(c,f.HIDE,"remove"),c);e.showTrack=i(f.SHOW),e.hideTrack=i(f.HIDE)},function(t,e,n){"use strict";function r(){return o.getPrivateProp.call(this,"targets").content}Object.defineProperty(e,"__esModule",{value:!0}),e.getContentElem=r;var o=n(112)},function(t,e,n){"use strict";function r(){var t=o.getPrivateProp.call(this,"targets"),e=t.container,n=t.content;return{container:{width:e.clientWidth,height:e.clientHeight},content:{width:n.offsetWidth-n.clientWidth+n.scrollWidth,height:n.offsetHeight-n.clientHeight+n.scrollHeight}}}Object.defineProperty(e,"__esModule",{value:!0}),e.getSize=r;var o=n(112)},function(t,e,n){"use strict";function r(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:50;if("function"==typeof t){var n={x:0,y:0},r=!1;o.addListener.call(this,function(o){var i=o.offset,u=o.limit;u.y-i.y<=e&&i.y>n.y&&!r&&(r=!0,setTimeout(function(){return t(o)})),u.y-i.y>e&&(r=!1),n=i})}}Object.defineProperty(e,"__esModule",{value:!0}),e.infiniteScroll=r;var o=n(155)},function(t,e,n){"use strict";function r(t){"function"==typeof t&&i.getPrivateProp.call(this,"scrollListeners").push(t)}function o(t){"function"==typeof t&&i.getPrivateProp.call(this,"scrollListeners").some(function(e,n,r){return e===t&&r.splice(n,1)})}Object.defineProperty(e,"__esModule",{value:!0}),e.addListener=r,e.removeListener=o;var i=n(112)},function(t,e,n){"use strict";function r(t){var e=o.getPrivateProp.call(this),n=e.bounding,r=t.getBoundingClientRect(),i=Math.max(n.top,r.top),u=Math.max(n.left,r.left),a=Math.min(n.right,r.right),c=Math.min(n.bottom,r.bottom);return i<c&&u<a}Object.defineProperty(e,"__esModule",{value:!0}),e.isVisible=r;var o=n(112)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e,n){return e in t?(0,c.default)(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function i(t,e){return!!e.length&&e.some(function(e){return t.match(e)})}function u(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:s.REGIESTER,e=d[t];return function(){for(var n=arguments.length,r=Array(n),o=0;o<n;o++)r[o]=arguments[o];f.getPrivateProp.call(this,"eventHandlers").forEach(function(n){var o=n.elem,u=n.evt,a=n.fn,c=n.hasRegistered;c&&t===s.REGIESTER||!c&&t===s.UNREGIESTER||i(u,r)&&(o[e](u,a),n.hasRegistered=!c)})}}var a=n(55),c=r(a);Object.defineProperty(e,"__esModule",{value:!0}),e.unregisterEvents=e.registerEvents=void 0;var l,f=n(112),s={REGIESTER:0,UNREGIESTER:1},d=(l={},o(l,s.REGIESTER,"addEventListener"),o(l,s.UNREGIESTER,"removeEventListener"),l);e.registerEvents=u(s.REGIESTER),e.unregisterEvents=u(s.UNREGIESTER)},function(t,e,n){"use strict";function r(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=e.onlyScrollIfNeeded,r=void 0!==n&&n,a=e.offsetTop,c=void 0===a?0:a,l=e.offsetLeft,f=void 0===l?0:l,s=o.getPrivateProp.call(this),d=s.targets,v=s.bounding;if(t&&d.container.contains(t)){var h=t.getBoundingClientRect();r&&u.isVisible.call(this,t)||i.setMovement.call(this,h.left-v.left-f,h.top-v.top-c)}}Object.defineProperty(e,"__esModule",{value:!0}),e.scrollIntoView=r;var o=n(112),i=n(133),u=n(156)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e=a.getPrivateProp.call(this),n=e.options;(0,u.default)(t).forEach(function(e){n.hasOwnProperty(e)&&void 0!==t[e]&&(n[e]=t[e])})}var i=n(120),u=r(i);Object.defineProperty(e,"__esModule",{value:!0}),e.setOptions=o;var a=n(112)},function(t,e,n){"use strict";function r(t){t?requestAnimationFrame(u.bind(this)):u.call(this)}function o(){var t=c.getPrivateProp.call(this),e=t.options,n=t.targets,r=t.size;if("glow"===e.overscrollEffect){var o=n.canvas,i=o.elem,u=o.context,a=window.devicePixelRatio||1,l=r.container.width*a,f=r.container.height*a;l===i.width&&f===i.height||(i.width=l,i.height=f,u.scale(a,a))}}function i(){var t=c.getPrivateProp.call(this),e=t.size,n=t.thumbSize,r=t.targets,o=r.xAxis,i=r.yAxis;(0,a.setStyle)(o.track,{display:e.content.width<=e.container.width?"none":"block"}),(0,a.setStyle)(i.track,{display:e.content.height<=e.container.height?"none":"block"}),(0,a.setStyle)(o.thumb,{width:n.x+"px"}),(0,a.setStyle)(i.thumb,{height:n.y+"px"})}function u(){var t=c.getPrivateProp.call(this),e=t.options;l.updateBounding.call(this);var n=f.getSize.call(this),r={x:Math.max(n.content.width-n.container.width,0),y:Math.max(n.content.height-n.container.height,0)},u={realX:n.container.width/n.content.width*n.container.width,realY:n.container.height/n.content.height*n.container.height};u.x=Math.max(u.realX,e.thumbMinSize),u.y=Math.max(u.realY,e.thumbMinSize),c.setPrivateProp.call(this,{size:n,thumbSize:u,limit:r}),i.call(this),o.call(this),s.setPosition.call(this),l.updateThumbPosition.call(this)}Object.defineProperty(e,"__esModule",{value:!0}),e.update=r;var a=n(87),c=n(112),l=n(128),f=n(153),s=n(150)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(){var t=this,e=l.getPrivateProp.call(this),n=e.targets,r=e.touchRecord,o=n.container;f.addEvent.call(this,o,"touchstart",function(e){if(!l.getPrivateProp.call(t,"isDraging")){var n=l.getPrivateProp.call(t),o=n.timerID,i=n.movement;cancelAnimationFrame(o.scrollTo),s.willOverscroll.call(t,"x")||(i.x=0),s.willOverscroll.call(t,"y")||(i.y=0),r.track(e),d.autoLockMovement.call(t)}}),
	f.addEvent.call(this,o,"touchmove",function(e){

	if(!(l.getPrivateProp.call(t,"isDraging")||h&&h!==t)){
		r.update(e);
		var n=r.getDelta(),
			o=n.x,
			i=n.y;
			if(d.shouldPropagateMovement.call(t,o,i))return l.callPrivateMethod.call(t,"updateDebounce");
			var u=l.getPrivateProp.call(t),
				a=u.movement,
				c=u.options,
				f=u.MAX_OVERSCROLL;

				// console.log(a);

				page.scroll.show(a.y);


				if(a.x&&s.willOverscroll.call(t,"x",o)){
					var v=2;"bounce"===c.overscrollEffect&&(v+=Math.abs(10*a.x/f)),Math.abs(a.x)>=f?o=0:o/=v}if(a.y&&s.willOverscroll.call(t,"y",i)){var p=2;"bounce"===c.overscrollEffect&&(p+=Math.abs(10*a.y/f)),Math.abs(a.y)>=f?i=0:i/=p}d.autoLockMovement.call(t),e.preventDefault(),d.addMovement.call(t,o,i,!0),
h=t}}),f.addEvent.call(this,o,"touchcancel touchend",function(e){if(!l.getPrivateProp.call(t,"isDraging")){var n=l.getPrivateProp.call(t,"options"),o=n.speed,i=r.getVelocity(),f={};(0,u.default)(i).forEach(function(t){var e=(0,c.pickInRange)(i[t]*a.GLOBAL_ENV.EASING_MULTIPLIER,-1e3,1e3);f[t]=Math.abs(e)>v?e*o:0}),d.addMovement.call(t,f.x,f.y,!0),d.unlockMovement.call(t),r.release(e),h=null}})}var i=n(82),u=r(i);Object.defineProperty(e,"__esModule",{value:!0}),e.handleTouchEvents=o;var a=n(81),c=n(87),l=n(112),f=n(128),s=n(138),d=n(133),v=100,h=null},function(t,e,n){"use strict";function r(){var t=this,e=i.getPrivateProp.call(this,"targets"),n=e.container,r=e.xAxis,l=e.yAxis,f=function(e,n){var r=i.getPrivateProp.call(t),o=r.size,u=r.thumbSize;if("x"===e){var a=o.container.width-(u.x-u.realX);return n/a*o.content.width}if("y"===e){var c=o.container.height-(u.y-u.realY);return n/c*o.content.height}return 0},s=function(t){return(0,o.isOneOf)(t,[r.track,r.thumb])?"x":(0,o.isOneOf)(t,[l.track,l.thumb])?"y":void 0},d=void 0,v=void 0,h=void 0,p=void 0,y=void 0;u.addEvent.call(this,n,"click",function(e){if(!v&&(0,o.isOneOf)(e.target,[r.track,l.track])){var n=e.target,u=s(n),c=n.getBoundingClientRect(),d=(0,o.getPointerPosition)(e),h=i.getPrivateProp.call(t),p=h.offset,y=h.thumbSize;if("x"===u){var g=d.x-c.left-y.x/2;a.setMovement.call(t,f(u,g)-p.x,0)}else{var _=d.y-c.top-y.y/2;a.setMovement.call(t,0,f(u,_)-p.y)}}}),u.addEvent.call(this,n,"mousedown",function(t){if((0,o.isOneOf)(t.target,[r.thumb,l.thumb])){d=!0;var e=(0,o.getPointerPosition)(t),i=t.target.getBoundingClientRect();p=s(t.target),h={x:e.x-i.left,y:e.y-i.top},y=n.getBoundingClientRect()}}),u.addEvent.call(this,window,"mousemove",function(e){if(d){e.preventDefault(),v=!0;var n=i.getPrivateProp.call(t),r=n.offset,u=(0,o.getPointerPosition)(e);if("x"===p){var a=u.x-h.x-y.left;c.setPosition.call(t,f(p,a),r.y)}if("y"===p){var l=u.y-h.y-y.top;c.setPosition.call(t,r.x,f(p,l))}}}),u.addEvent.call(this,window,"mouseup blur",function(){d=v=!1})}Object.defineProperty(e,"__esModule",{value:!0}),e.handleMouseEvents=r;var o=n(87),i=n(112),u=n(128),a=n(133),c=n(146)},function(t,e,n){"use strict";function r(){var t=this,e=u.getPrivateProp.call(this,"targets"),n=e.container,r=!1,f=(0,o.debounce)(function(){r=!1},30,!1);

	a.addEvent.call(this,n,i.GLOBAL_ENV.WHEEL_EVENT,function(e){

	var n=u.getPrivateProp.call(t),
		i=n.options,
		a=(0,o.getDelta)(e),
		s=a.x,
		d=a.y;

		// console.log(a);

		page.scroll.show(d);

		return s*=i.speed,
			d*=i.speed,
			l.shouldPropagateMovement.call(t,s,d)?u.callPrivateMethod.call(t,"updateDebounce"):(e.preventDefault(),f(),
			u.getPrivateProp.call(t,"overscrollBack")&&(r=!0),
			r&&(c.willOverscroll.call(t,"x",s)&&(s=0),
				c.willOverscroll.call(t,"y",d)&&(d=0)),
			void l.addMovement.call(t,s,d,!0))})}

	Object.defineProperty(e,"__esModule",{value:!0}),e.handleWheelEvents=r;var o=n(87),i=n(81),u=n(112),a=n(128),c=n(138),l=n(133)},function(t,e,n){"use strict";function r(){o.addEvent.call(this,window,"resize",i.getPrivateMethod.call(this,"updateDebounce"))}Object.defineProperty(e,"__esModule",{value:!0}),e.handleResizeEvents=r;var o=n(128),i=n(112)},function(t,e,n){"use strict";function r(){var t=this,e=!1,n=void 0,r=i.getPrivateProp.call(this,"targets"),c=r.container,l=r.content,f=function e(r){var o=r.x,u=r.y;if(o||u){var c=i.getPrivateProp.call(t,"options"),l=c.speed;a.setMovement.call(t,o*l,u*l),n=requestAnimationFrame(function(){e({x:o,y:u})})}},s=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";(0,o.setStyle)(c,{"-user-select":t})};u.addEvent.call(this,window,"mousemove",function(r){
		if(e){
			cancelAnimationFrame(n);
			var o=u.getPointerOffset.call(t,r);f(o)}}),
				u.addEvent.call(this,l,"selectstart",function(r){cancelAnimationFrame(n),u.updateBounding.call(t),e=!0}),
				u.addEvent.call(this,window,"mouseup blur",function(){cancelAnimationFrame(n),s(),e=!1}),
				u.addEvent.call(this,c,"scroll",function(t){t.preventDefault(),c.scrollTop=c.scrollLeft=0})}Object.defineProperty(e,"__esModule",{value:!0}),e.handleSelectEvents=r;var o=n(87),i=n(112),u=n(128),a=n(133)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(){var t=this,e=f.getPrivateProp.call(this),n=e.targets,r=function(e){var n=f.getPrivateProp.call(t),r=n.size,o=n.offset,i=n.limit,u=n.movement;switch(e){case v.SPACE:return[0,200];case v.PAGE_UP:return[0,-r.container.height+40];case v.PAGE_DOWN:return[0,r.container.height-40];case v.END:return[0,Math.abs(u.y)+i.y-o.y];case v.HOME:return[0,-Math.abs(u.y)-o.y];case v.LEFT:return[-40,0];case v.UP:return[0,-40];case v.RIGHT:return[40,0];case v.DOWN:return[0,40];default:return null}},o=n.container,i=!1;s.addEvent.call(this,o,"focus",function(){i=!0}),s.addEvent.call(this,o,"blur",function(){i=!1}),s.addEvent.call(this,o,"keydown",function(e){

					if(i){
						page.scroll.show(d);

						var n=f.getPrivateProp.call(t),
						u=n.options,
						a=n.parents,
						c=r(e.keyCode||e.which);
						if(c){
							var s=l(c,2),
								v=s[0],
								h=s[1];

							// page.scroll.show(v);

							if(d.shouldPropagateMovement.call(t,v,h))
								return o.blur(),
										a.length&&a[0].containerElement.focus(),
										f.callPrivateMethod.call(t,"updateDebounce");
								e.preventDefault();
								var p=u.speed;d.addMovement.call(t,v*p,h*p)}}})}
				var i=n(167),u=r(i),a=n(170),c=r(a);Object.defineProperty(e,"__esModule",{value:!0});var l=function(){function t(t,e){var n=[],r=!0,o=!1,i=void 0;try{for(var u,a=(0,c.default)(t);!(r=(u=a.next()).done)&&(n.push(u.value),!e||n.length!==e);r=!0);}catch(t){o=!0,i=t}finally{try{!r&&a.return&&a.return()}finally{if(o)throw i}}return n}return function(e,n){if(Array.isArray(e))return e;if((0,u.default)(Object(e)))return t(e,n);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}();e.handleKeyboardEvents=o;var f=n(112),s=n(128),d=n(133),v={SPACE:32,PAGE_UP:33,PAGE_DOWN:34,END:35,HOME:36,LEFT:37,UP:38,RIGHT:39,DOWN:40}},function(t,e,n){t.exports={default:n(168),__esModule:!0}},function(t,e,n){n(60),n(4),t.exports=n(169)},function(t,e,n){var r=n(53),o=n(45)("iterator"),i=n(27);t.exports=n(12).isIterable=function(t){var e=Object(t);return void 0!==e[o]||"@@iterator"in e||i.hasOwnProperty(r(e))}},function(t,e,n){t.exports={default:n(171),__esModule:!0}},function(t,e,n){n(60),n(4),t.exports=n(172)},function(t,e,n){var r=n(17),o=n(52);t.exports=n(12).getIterator=function(t){var e=o(t);if("function"!=typeof e)throw TypeError(t+" is not iterable!");return r(e.call(t))}},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e,n){return e in t?(0,l.default)(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function i(){var t,e,n=this;(0,a.default)(this,(t={},o(t,f.PRIVATE_PROPS,{value:{}}),o(t,f.PRIVATE_METHODS,{value:{}}),t)),(e=d.setPrivateProp.call(this,{get MAX_OVERSCROLL(){var t=d.getPrivateProp.call(n),e=t.options,r=t.size;switch(e.overscrollEffect){case f.OVERSCROLL_GLOW:var o=Math.floor(Math.sqrt(Math.pow(r.container.width,2)+Math.pow(r.container.height,2))),i=v.isMovementLocked.call(n)?2:10;return f.GLOBAL_ENV.TOUCH_SUPPORTED?(0,s.pickInRange)(o/i,100,1e3):(0,s.pickInRange)(o/10,25,50);case f.OVERSCROLL_BOUNCE:return 150;default:return 0}}}),d.setPrivateProp).call(e,{children:[],parents:[],isDraging:!1,overscrollBack:!1,isNestedScrollbar:!1,touchRecord:new s.TouchRecord,scrollListeners:[],eventHandlers:[],timerID:{},size:{container:{width:0,height:0},content:{width:0,height:0}},offset:{x:0,y:0},thumbOffset:{x:0,y:0},limit:{x:1/0,y:1/0},movement:{x:0,y:0},movementLocked:{x:!1,y:!1},overscrollRendered:{x:0,y:0},thumbSize:{x:0,y:0,realX:0,realY:0},bounding:{top:0,right:0,bottom:0,left:0}}),d.definePrivateMethod.call(this,{hideTrackDebounce:(0,s.debounce)(h.hideTrack.bind(this),1e3,!1),updateDebounce:(0,s.debounce)(h.update.bind(this))})}var u=n(174),a=r(u),c=n(55),l=r(c);Object.defineProperty(e,"__esModule",{value:!0}),e.initPrivates=i;var f=n(81),s=n(87),d=n(112),v=n(133),h=n(146)},function(t,e,n){t.exports={default:n(175),__esModule:!0}},function(t,e,n){n(176);var r=n(12).Object;t.exports=function(t,e){return r.defineProperties(t,e)}},function(t,e,n){var r=n(10);r(r.S+r.F*!n(20),"Object",{defineProperties:n(30)})},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if(Array.isArray(t)){for(var e=0,n=Array(t.length);e<t.length;e++)n[e]=t[e];return n}return(0,v.default)(t)}function i(t){var e=this,n={speed:1,damping:.1,thumbMinSize:20,syncCallbacks:!1,renderByPixels:!0,alwaysShowTracks:!1,continuousScrolling:"auto",overscrollEffect:!1,overscrollEffectColor:"#87ceeb",overscrollDamping:.2},r={damping:[0,1],speed:[0,1/0],thumbMinSize:[0,1/0],overscrollEffect:[!1,"bounce","glow"],overscrollDamping:[0,1]},i=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"auto";if(n.overscrollEffect!==!1)return!1;switch(t){case"auto":return m.getPrivateProp.call(e,"isNestedScrollbar");default:return!!t}},u={set ignoreEvents(t){console.warn("`options.ignoreEvents` parameter is deprecated, use `instance#unregisterEvents()` method instead. https://github.com/idiotWu/smooth-scrollbar/wiki/Instance-Methods#instanceunregisterevents-regex--regex-regex--")},set friction(t){console.warn("`options.friction="+t+"` is deprecated, use `options.damping="+t/100+"` instead."),this.damping=t/100},get syncCallbacks(){return n.syncCallbacks},set syncCallbacks(t){n.syncCallbacks=!!t},get renderByPixels(){return n.renderByPixels},set renderByPixels(t){n.renderByPixels=!!t},get alwaysShowTracks(){return n.alwaysShowTracks},set alwaysShowTracks(t){t=!!t,n.alwaysShowTracks=t;var r=m.getPrivateProp.call(e,"targets"),o=r.container;t?(P.showTrack.call(e),o.classList.add("sticky")):(P.hideTrack.call(e),o.classList.remove("sticky"))},get continuousScrolling(){return i(n.continuousScrolling)},set continuousScrolling(t){"auto"===t?n.continuousScrolling=t:n.continuousScrolling=!!t},get overscrollEffect(){return n.overscrollEffect},set overscrollEffect(t){t&&!~r.overscrollEffect.indexOf(t)&&(console.warn("`overscrollEffect` should be one of "+(0,s.default)(r.overscrollEffect)+", but got "+(0,s.default)(t)+". It will be set to `false` now."),t=!1),n.overscrollEffect=t},get overscrollEffectColor(){return n.overscrollEffectColor},set overscrollEffectColor(t){n.overscrollEffectColor=t}};(0,l.default)(n).filter(function(t){return!u.hasOwnProperty(t)}).forEach(function(t){(0,a.default)(u,t,{enumerable:!0,get:function(){return n[t]},set:function(e){if(isNaN(parseFloat(e)))throw new TypeError("expect `options."+t+"` to be a number, but got "+("undefined"==typeof e?"undefined":_(e)));n[t]=b.pickInRange.apply(void 0,[e].concat(o(r[t])))}})}),m.setPrivateProp.call(this,"options",u),P.setOptions.call(this,t)}var u=n(55),a=r(u),c=n(82),l=r(c),f=n(178),s=r(f),d=n(2),v=r(d),h=n(58),p=r(h),y=n(65),g=r(y);Object.defineProperty(e,"__esModule",{value:!0});var _="function"==typeof g.default&&"symbol"==typeof p.default?function(t){return typeof t}:function(t){return t&&"function"==typeof g.default&&t.constructor===g.default&&t!==g.default.prototype?"symbol":typeof t};e.initOptions=i;var b=n(87),m=n(112),P=n(146)},function(t,e,n){t.exports={default:n(179),__esModule:!0}},function(t,e,n){var r=n(12),o=r.JSON||(r.JSON={stringify:JSON.stringify});t.exports=function(t){return o.stringify.apply(o,arguments)}},function(t,e,n){"use strict";function r(t){var e=this;t.setAttribute("tabindex","1"),t.scrollTop=t.scrollLeft=0;var n=(0,i.findChild)(t,"scroll-content"),r=(0,i.findChild)(t,"overscroll-glow"),c=(0,i.findChild)(t,"scrollbar-track-x"),l=(0,i.findChild)(t,"scrollbar-track-y");if((0,i.setStyle)(t,{overflow:"hidden",outline:"none"}),(0,i.setStyle)(r,{display:"none","pointer-events":"none"}),u.setPrivateProp.call(this,"targets",{container:t,content:n,canvas:{elem:r,context:r.getContext("2d")},xAxis:{track:c,thumb:(0,i.findChild)(c,"scrollbar-thumb-x")},yAxis:{track:l,thumb:(0,i.findChild)(l,"scrollbar-thumb-y")}}),"function"==typeof o.GLOBAL_ENV.MutationObserver){var f=new o.GLOBAL_ENV.MutationObserver(function(){a.update.call(e,!0)});f.observe(n,{childList:!0}),u.setPrivateProp.call(this,"observer",f)}}Object.defineProperty(e,"__esModule",{value:!0}),e.initTargets=r;var o=n(81),i=n(87),u=n(112),a=n(146)},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function u(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=(0,y.default)(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(h.default?(0,h.default)(t,e):t.__proto__=e)}var a=n(182),c=r(a),l=n(197),f=r(l),s=n(2),d=r(s),v=n(199),h=r(v),p=n(203),y=r(p),g=n(206),_=r(g),b=n(209),m=r(b),P=n(55),M=r(P);Object.defineProperty(e,"__esModule",{value:!0}),e.ScbList=void 0;var x=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),(0,M.default)(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),E=function t(e,n,r){null===e&&(e=Function.prototype);var o=(0,m.default)(e,n);if(void 0===o){var i=(0,_.default)(e);return null===i?void 0:t(i,n,r)}if("value"in o)return o.value;var u=o.get;if(void 0!==u)return u.call(r)},O=n(81),w=n(112),S=function(t){function e(){return o(this,e),i(this,(e.__proto__||(0,_.default)(e)).apply(this,arguments))}return u(e,t),x(e,[{key:"updateScbTree",value:function(t){for(var e=w.getPrivateProp.call(t,"targets"),n=e.container,r=e.content,o=[],i=!1,u=n;u=u.parentElement;)this.has(u)&&(i=!0,o.push(this.get(u)));w.setPrivateProp.call(t,{parents:o,isNestedScrollbar:i,children:(0,d.default)(r.querySelectorAll(O.SELECTOR),this.get.bind(this))})}},{key:"update",value:function(){this.forEach(this.updateScbTree.bind(this))}},{key:"delete",value:function(){for(var t,n=arguments.length,r=Array(n),o=0;o<n;o++)r[o]=arguments[o];var i=(t=E(e.prototype.__proto__||(0,_.default)(e.prototype),"delete",this)).call.apply(t,[this].concat(r));return this.update(),i}},{key:"set",value:function(){for(var t,n=arguments.length,r=Array(n),o=0;o<n;o++)r[o]=arguments[o];var i=(t=E(e.prototype.__proto__||(0,_.default)(e.prototype),"set",this)).call.apply(t,[this].concat(r));return this.update(),i}}],[{key:f.default,get:function(){return c.default}}]),e}(c.default);e.ScbList=new S},function(t,e,n){t.exports={default:n(183),__esModule:!0}},function(t,e,n){n(78),n(4),n(60),n(184),n(194),t.exports=n(12).Map},function(t,e,n){"use strict";var r=n(185);t.exports=n(190)("Map",function(t){return function(){return t(this,arguments.length>0?arguments[0]:void 0)}},{get:function(t){var e=r.getEntry(this,t);return e&&e.v},set:function(t,e){return r.def(this,0===t?0:t,e)}},r,!0)},function(t,e,n){"use strict";var r=n(16).f,o=n(29),i=n(186),u=n(13),a=n(187),c=n(7),l=n(188),f=n(8),s=n(63),d=n(189),v=n(20),h=n(68).fastKey,p=v?"_s":"size",y=function(t,e){var n,r=h(e);if("F"!==r)return t._i[r];for(n=t._f;n;n=n.n)if(n.k==e)return n};t.exports={getConstructor:function(t,e,n,f){var s=t(function(t,r){a(t,s,e,"_i"),t._i=o(null),t._f=void 0,t._l=void 0,t[p]=0,void 0!=r&&l(r,n,t[f],t)});return i(s.prototype,{clear:function(){for(var t=this,e=t._i,n=t._f;n;n=n.n)n.r=!0,n.p&&(n.p=n.p.n=void 0),delete e[n.i];t._f=t._l=void 0,t[p]=0},delete:function(t){var e=this,n=y(e,t);if(n){var r=n.n,o=n.p;delete e._i[n.i],n.r=!0,o&&(o.n=r),r&&(r.p=o),e._f==n&&(e._f=r),e._l==n&&(e._l=o),e[p]--}return!!n},forEach:function(t){a(this,s,"forEach");for(var e,n=u(t,arguments.length>1?arguments[1]:void 0,3);e=e?e.n:this._f;)for(n(e.v,e.k,this);e&&e.r;)e=e.p},has:function(t){return!!y(this,t)}}),v&&r(s.prototype,"size",{get:function(){return c(this[p])}}),s},def:function(t,e,n){var r,o,i=y(t,e);return i?i.v=n:(t._l=i={i:o=h(e,!0),k:e,v:n,p:r=t._l,n:void 0,r:!1},t._f||(t._f=i),r&&(r.n=i),t[p]++,"F"!==o&&(t._i[o]=i)),t},getEntry:y,setStrong:function(t,e,n){f(t,e,function(t,e){this._t=t,this._k=e,this._l=void 0},function(){for(var t=this,e=t._k,n=t._l;n&&n.r;)n=n.p;return t._t&&(t._l=n=n?n.n:t._t._f)?"keys"==e?s(0,n.k):"values"==e?s(0,n.v):s(0,[n.k,n.v]):(t._t=void 0,s(1))},n?"entries":"values",!n,!0),d(e)}}},function(t,e,n){var r=n(15);t.exports=function(t,e,n){for(var o in e)n&&t[o]?t[o]=e[o]:r(t,o,e[o]);return t}},function(t,e){t.exports=function(t,e,n,r){if(!(t instanceof e)||void 0!==r&&r in t)throw TypeError(n+": incorrect invocation!");return t}},function(t,e,n){var r=n(13),o=n(49),i=n(50),u=n(17),a=n(37),c=n(52),l={},f={},e=t.exports=function(t,e,n,s,d){var v,h,p,y,g=d?function(){return t}:c(t),_=r(n,s,e?2:1),b=0;if("function"!=typeof g)throw TypeError(t+" is not iterable!");if(i(g)){for(v=a(t.length);v>b;b++)if(y=e?_(u(h=t[b])[0],h[1]):_(t[b]),y===l||y===f)return y}else for(p=g.call(t);!(h=p.next()).done;)if(y=o(p,_,h.value,e),y===l||y===f)return y};e.BREAK=l,e.RETURN=f},function(t,e,n){"use strict";var r=n(11),o=n(12),i=n(16),u=n(20),a=n(45)("species");t.exports=function(t){var e="function"==typeof o[t]?o[t]:r[t];u&&e&&!e[a]&&i.f(e,a,{configurable:!0,get:function(){return this}})}},function(t,e,n){"use strict";var r=n(11),o=n(10),i=n(68),u=n(21),a=n(15),c=n(186),l=n(188),f=n(187),s=n(18),d=n(44),v=n(16).f,h=n(191)(0),p=n(20);t.exports=function(t,e,n,y,g,_){var b=r[t],m=b,P=g?"set":"add",M=m&&m.prototype,x={};return p&&"function"==typeof m&&(_||M.forEach&&!u(function(){(new m).entries().next()}))?(m=e(function(e,n){f(e,m,t,"_c"),e._c=new b,void 0!=n&&l(n,g,e[P],e)}),h("add,clear,delete,forEach,get,has,set,keys,values,entries,toJSON".split(","),function(t){var e="add"==t||"set"==t;t in M&&(!_||"clear"!=t)&&a(m.prototype,t,function(n,r){if(f(this,m,t),!e&&_&&!s(n))return"get"==t&&void 0;var o=this._c[t](0===n?0:n,r);return e?this:o})}),"size"in M&&v(m.prototype,"size",{get:function(){return this._c.size}})):(m=y.getConstructor(e,t,g,P),c(m.prototype,n),i.NEED=!0),d(m,t),x[t]=m,o(o.G+o.W+o.F,x),_||y.setStrong(m,t,g),m}},function(t,e,n){var r=n(13),o=n(34),i=n(47),u=n(37),a=n(192);t.exports=function(t,e){var n=1==t,c=2==t,l=3==t,f=4==t,s=6==t,d=5==t||s,v=e||a;return function(e,a,h){for(var p,y,g=i(e),_=o(g),b=r(a,h,3),m=u(_.length),P=0,M=n?v(e,m):c?v(e,0):void 0;m>P;P++)if((d||P in _)&&(p=_[P],y=b(p,P,g),t))if(n)M[P]=y;else if(y)switch(t){case 3:return!0;case 5:return p;case 6:return P;case 2:M.push(p)}else if(f)return!1;return s?-1:l||f?f:M}}},function(t,e,n){var r=n(193);t.exports=function(t,e){return new(r(t))(e)}},function(t,e,n){var r=n(18),o=n(74),i=n(45)("species");t.exports=function(t){var e;return o(t)&&(e=t.constructor,"function"!=typeof e||e!==Array&&!o(e.prototype)||(e=void 0),r(e)&&(e=e[i],null===e&&(e=void 0))),void 0===e?Array:e}},function(t,e,n){var r=n(10);r(r.P+r.R,"Map",{toJSON:n(195)("Map")})},function(t,e,n){var r=n(53),o=n(196);t.exports=function(t){return function(){if(r(this)!=t)throw TypeError(t+"#toJSON isn't generic");return o(this)}}},function(t,e,n){var r=n(188);t.exports=function(t,e){var n=[];return r(t,!1,n.push,n,e),n}},function(t,e,n){t.exports={default:n(198),__esModule:!0}},function(t,e,n){t.exports=n(64).f("species")},function(t,e,n){t.exports={default:n(200),__esModule:!0}},function(t,e,n){n(201),t.exports=n(12).Object.setPrototypeOf},function(t,e,n){var r=n(10);r(r.S,"Object",{setPrototypeOf:n(202).set})},function(t,e,n){var r=n(18),o=n(17),i=function(t,e){if(o(t),!r(e)&&null!==e)throw TypeError(e+": can't set as prototype!")};t.exports={set:Object.setPrototypeOf||("__proto__"in{}?function(t,e,r){try{r=n(13)(Function.call,n(77).f(Object.prototype,"__proto__").set,2),r(t,[]),e=!(t instanceof Array)}catch(t){e=!0}return function(t,n){return i(t,n),e?t.__proto__=n:r(t,n),t}}({},!1):void 0),check:i}},function(t,e,n){t.exports={default:n(204),__esModule:!0}},function(t,e,n){n(205);var r=n(12).Object;t.exports=function(t,e){return r.create(t,e)}},function(t,e,n){var r=n(10);r(r.S,"Object",{create:n(29)})},function(t,e,n){t.exports={default:n(207),__esModule:!0}},function(t,e,n){n(208),t.exports=n(12).Object.getPrototypeOf},function(t,e,n){var r=n(47),o=n(46);n(85)("getPrototypeOf",function(){return function(t){return o(r(t))}})},function(t,e,n){t.exports={default:n(210),__esModule:!0}},function(t,e,n){n(211);var r=n(12).Object;t.exports=function(t,e){return r.getOwnPropertyDescriptor(t,e)}},function(t,e,n){var r=n(33),o=n(77).f;n(85)("getOwnPropertyDescriptor",function(){return function(t,e){return o(r(t),e)}})},function(t,e){}])});

var device = {
	BREAKPOINT : 750,
	size : (750<window.innerWidth)?"pc":"sp",
}


page = {

	w          : window.innerWidth,
	h          : window.innerHeight,


	/* [ Element宣言 ] */
	$vm        : $(".js__vertical-middle"), //[ 上下のセンタリング ]
	$s         : $(".js__show"), // [ 表示対象の要素 ]
	$cl        : $("#concept-list"),
	$fb        : $("#fixed-btn"),
	$pt        : $("#page-top"),
	mflg       : false,

	/* [ インスタンス生成 ] */
	// tl : new TimelineLite(),
	tl         : [],

	bar        : [],

	init : function (){

		// console.log("page load");

		page.first.init();
		page.common.init();
		page.form.init();


		/* SET concept */
		if(page.$s[0]){
			var text = new SplitText(page.$s, {type:"words,chars"}),
				chars = text.chars,
				charsNum = chars.length;
			page.$s.css({"overflow":"hidden","display":"block"});
			// for(var i=0; i<page.$s.length; i++){
			// 	TweenLite.set(page.$s.eq(i).children(), {x:page.$s.eq(i).width()});
			// }
			TweenLite.set(page.$s.children(), {x:page.$cl.children().width()});
			TweenLite.set(page.$cl.find(".cover-container"), {width:40,height:40});

			/*  EVENT concept */
			//PC

			var _tl = {},
				_current,
				_timer={};

			page.$cl.children().on("mouseenter",function(){
				if(device.size=="sp") return;
				clearTimeout( _timer[$(this).index()] );
				var $this = $(this),
					$c = $this.find(".cover-container");
				_tl[$(this).index()] = new TimelineLite();
				_tl[$(this).index()].to($c, 0.28, {height:$this.height()})
					.to($c, 0.28, {width:$this.width()})
					.to($c.find(".js__show").children(), 0.28, {x:0});

			}).on("mouseleave",function(){
				_tl[$(this).index()].reverse();
				// _timer[$(this).index()] = setTimeout(function(){
				// 	page.tl.reverse();
				// },1e3);
			});
			//SMP
			page.$cl.children().on("click",function(){
				if(page.mflg) return;
				page.mflg = true;
				var _clone = {};

				_clone = {
					title : {
						line1 : $(this).find(".cover-title .js__show").children().eq(0).text(),
						line2 : $(this).find(".cover-title .js__show").children().eq(2).text(),
					},
					text : $(this).find(".cover-text .js__show").text()
				};

				$("#modal-container #modal-content .title").append(_clone.title.line1+'<br>'+_clone.title.line2);
				$("#modal-container #modal-content .text").append(_clone.text);


				$("#document").on('touchmove.noScroll', function(e) {
					e.preventDefault();
				});



				TweenLite.set($("#modal-container"),{skewX:-2, skewY:-5});
				TweenLite.set($("#modal-container #modal-inner"),{height: page.h, top:-page.scroll.inc});
				TweenMax.to($("#modal-container"),.28,{
					autoAlpha: 1,
					display:'block',
					skewX:0,
					skewY:0,
					ease:Power2.easeOut,
				});
			});

			$("#modal-close").on("click",function(){
				page.mflg = false;
				TweenMax.to($("#modal-container"),.28,{
					autoAlpha: 0,
					display:'none',
					skewX:-2,
					skewY:-5,
					ease:Power2.easeOut,
					onComplete:function(){
						$("#modal-container #modal-content .title").text("");
						$("#modal-container #modal-content .text").text("");
					}
				});
			});

		}

		$(".js__link-box").on("click",function(){
			var $href = $(this).find('a').attr('href');
			if ($(this).find('a').attr('target') == '_blank') {
				window.open($href, '_blank');
			} else {
				window.location = $href;
			}
			return false;
		});

		$("#month-category-select select").on("change",function(){
			location.href = $(this).children(":selected").val();
		});

		/* mypage modal js */
		$('.openmodal').colorbox({inline: true});


		if(Useragnt.edge || $("body").attr("id") == "application" ||  $("body").attr("id") == "user-registration") return
		page.bar = new Scrollbar.init(document.getElementById("document"), {
			speed: 1,
			damping: 0.1,
			overscrollDamping: 0.2,
			thumbMinSize: 20,
			renderByPixels: true,
			alwaysShowTracks: true,
			continuousScrolling: 'auto',
			overscrollEffect:'glow',
			// overscrollEffect: navigator.userAgent.match(/Android/) ? 'glow' : 'bounce',
			overscrollEffectColor: '#87ceeb',
		});

		// page.bar.setPosition(0,100,true);

		// console.log(page.bar.scrollTo);
		// page.bar.scrollTo(0, 100, 300, null);
		// page.bar.addListener( "scroll",function(e){
		// 	console.log(e);
		// });

		setTimeout(function(){
			page.scroll.init();
			if(!Useragnt.mobile){
				page.effect.panel.set($(".js__panel"));
				page.effect.simple.set($(".js__simple"));
				//rotate
				page.effect.rotate.set($(".js__rotate"));
				page.effect.horizontalBox.set($(".js__horizontal-box"));
				// page.effect.horizontalBoxSt.set($(".js__horizontal-box_st"));
				page.effect.svgDraw.set(page.scroll.$m);
			}
			page.gnavi.init();
		},1e3);



	},
	gnavi : {
		$c : $("#gnavi"),
		status : {
			t   : [],
			p   : [],
			i   : 0,
			flg : false,
		},
		init : function(){
			page.gnavi.$c.find("li span").on("click",function(){
				page.gnavi.status.t = $(this).data("target");
				page.gnavi.status.p = $(this).data("page");
				page.gnavi.status.i = -$("#"+page.gnavi.status.t).offset().top;

							// console.log(page.gnavi.status.i,"ssss");

							// page.bar.scrollTo( 0, page.gnavi.status.i, 380, function(){
							// 	console.log("aaaaa");
							// });


				// page.bar.scrollTo(0, 100, 300, function() {
				// });

				var scTween = new TweenMax.to($(".scroll-content"), .38,
					{
						y:page.gnavi.status.i,
						ease: Power0.easeNone,
						onStart : function(){
							page.gnavi.status.flg = true;
							// page.scroll.show(page.gnavi.status.i);
						},
						onComplete:function(){
							page.gnavi.status.flg = false;
							page.bar.scrollTo( 0, page.gnavi.status.i, 3.38, function(){
								page.scroll.inc = page.gnavi.status.i;
								page.scroll.showInc = page.gnavi.status.i;



								page.effect.panel.show($("#"+page.gnavi.status.t).find(".js__panel"));
								page.effect.horizontalBox.show($("#"+page.gnavi.status.t).find(".js__horizontal-box"));
								page.effect.rotate.show($("#"+page.gnavi.status.t).find(".js__rotate"));
								page.effect.horizontalBoxSt.show($("#"+page.gnavi.status.t).find(".js__horizontal-box_st"));
								page.effect.simple.show( $("#"+page.gnavi.status.t).find(".js__simple").not(".js__delay") );


							} );
						}
					}
				);



			});
		},
		motion : function(){

		}
	},
	resize : function(){
		// page.w =  (!Useragnt.edge)?window.innerWidth:$(window).width(),
		page.w =  $(window).width(),
		page.h =  window.innerHeight;

		// console.log(device.size);
		device.size = (device.BREAKPOINT<page.w)?"pc":"sp";

		$("#document-inner").css({"width": $(window).width() });
		$(".js__fullscreen").css({"width":page.w,"height":page.h});

		page.$cl.find(".cover-inner").css({"width":page.$cl.children().width()});

		for(var i = 0; i<page.$vm.length; i++){
			page.$vm.eq(i).css({"height":page.$vm.eq(i).children().height()});
		}

		if(page.w > 1280){
			TweenMax.staggerTo(page.$fb.not(".show"),.28,{
				right : -130,
				ease:Power2.easeOut,
				onComplete:function(){

				}
			});
			page.$fb.addClass("show");
		}else{
			TweenMax.staggerTo(page.$fb.filter(".show"),.28,{
				right : -500,
				ease:Power2.easeOut,
				onComplete:function(){

				}
			});
			page.$fb.removeClass("show");
			// page.$fb.css({"right":-500 });
		}

		if(page.w > device.BREAKPOINT){
			$("#head-navi-container").removeAttr("style");
			TweenLite.set(page.$cl.find(".cover-container"), {width:40,height:40});
			//eventlist　Height
			var columns = 3;
			var liLen = $("#events-list>article").length;
			var lineLen = Math.ceil(liLen / columns);
			var liHiArr = [];
			var lineHiArr = [];

			for (i = 0; i <= liLen; i++) {
			  liHiArr[i] = $('#events-list>article').eq(i).height();
			  if (lineHiArr.length <= Math.floor(i / columns) || lineHiArr[Math.floor(i / columns)] < liHiArr[i])
			  {
			      lineHiArr[Math.floor(i / columns)] = liHiArr[i];
			  }
			}
			for (i = 0; i <= liLen; i++) {
				$('#events-list>article').eq(i).css('height',lineHiArr[Math.floor(i / columns)] + 'px');
			}
		}else{
			TweenLite.set(page.$cl.find(".cover-container"), {width:30,height:30});
			page.$pt.removeAttr("style").removeClass("white");
			$('#events-list>article').removeAttr("style");
		}

	},
	effect : {
		simple : {
			set : function($t){
				if($t.hasClass("js__simple")){
					TweenLite.set($t,{ y:"100%" });
				}
			},
			show : function($t){
				if(!$t.hasClass("js__simple") || $t.hasClass("done") ) return;
				$t.addClass("done");
				TweenMax.staggerTo($t,.28,{
					y : "0%",
					ease:Power2.easeOut,
					onComplete:function(){

					}
				},0.1);

			}
		},

		horizontalBox : {
			set : function($t){
				if( !$t.hasClass("js__horizontal-box")) return;
				TweenLite.set($t,{ width:"0%" });
			},
			show : function($t){
				// console.log("hori",w);
				if($t.hasClass("done") || !$t.hasClass("js__horizontal-box") ) return;
				$t.addClass("done");
					TweenMax.to($t,.58,{
						width : $t.data("width"),
						delay : .5,
						ease:Power2.easeOut,
					});

			}
		},

		horizontalBoxSt : {
			set : function($t){
				if( !$t.hasClass("js__horizontal-box_st")) return;
				TweenLite.set($t.find(".js__st"),{ width:"0%" });
			},
			show : function($t){
				// console.log("hori",w);
				if($t.hasClass("done") || !$t.hasClass("js__horizontal-box_st") ) return;
				$t.addClass("done");

					// console.log("horizontalBoxSt",$t.find(".js__st").length);
				for(var i=0; $t.find(".js__st").length>i; i++){
					var $st = $t.find(".js__st").eq(i);
					TweenMax.to($st,.38,{
						width : $st.data("width"),
						delay : 0.1*i,
						ease:Power2.easeOut,
					});
				}

			}
		},

		panel : {
			set : function($t){
				if($t.hasClass("js__panel")){
					$t.append('<div class="js__panel-child"></div>');
					TweenLite.set($t.children(),{ x:"-100%" });
				}
			},
			show : function($t){

				if($t.hasClass("js__panel")){
					if($t.hasClass("done")) return;
					$t.addClass("done");

					TweenMax.to($t.children(".js__panel-child"),.38,{
						x : "0%",
						ease:Power2.easeOut,
						onComplete:function(){

							TweenMax.to($t.children(),.28,{
								x : "0%",
								ease:Power2.easeOut,
								onComplete:function(){
									page.effect.simple.show($t.find(".js__simple.js__delay"));
									page.effect.svgDraw.draw($t,0.1);

								}
							});


						}
					});
				}
			},
		},
		svgDraw : {
			set:function($t){
				var g = $t.find(".js__write").find("path,circle,line,rect,polyline,polygon");
				// console.log(g);
				// g.removeClass("done");
				TweenLite.set(g, {drawSVG: "0%",visibility:"visible"});
			},
			draw:function($t,delay){
				if($t.find(".js__write").hasClass("done") || !$t.find(".js__write")[0] ) return;
				$t.find(".js__write").addClass("done");
				// TweenMax.killTweensOf($("path,circle,line,rect,polyline,polygon").not(".done"));
				TweenMax.staggerFromTo($t.find("path,circle,line,rect,polyline,polygon"), .35, {
					drawSVG: "0%"
				}, {
					drawSVG: "100%",
					ease: Power2.easeOut
				},delay);
			},
		},
		rotate :{
			set : function($t){
				if( !$t.hasClass("js__rotate")) return;
				TweenLite.set($t,{ width:"0%",perspective:400 });
			},
			show : function($t){
				if($t.hasClass("done") || !$t.hasClass("js__rotate") ) return;
				$t.addClass("done");
				TweenMax.to($t,.46,{
					width : "100%",
					rotationY:360,
					ease:Power1.easeIn,
				});

			}
		}
	},

	pararax : {
		$t    : $(".js__para"),
		point : {},
		// inc   : 0,
		init : function(){
			for(var i=0; i<page.pararax.$t.length; i++){
				page.pararax.point[i] = page.pararax.$t.eq(i).offset().top;
			}
		},
		motion : function(inc){
			// page.pararax.inc = inc;

			for(var i=0; i<page.pararax.$t.length; i++){

					// console.log( page.pararax.point[i] );
					// console.log("para",inc);

				if(page.pararax.point[i] - [page.h/1.5] < inc){

					// console.log("para",inc);

					// var _y =

					// $t.css({
					// 	"transform" : "translate3d(0px, "+  +"px, 0px)"
					// });


				}

			}

		}
	},

	scroll : {
		$m      : $(".js__mark"), //[ アニメーション対象要素 ]
		$s      : $(".section-container"),
		point   : {}, //[ アニメション対象要素の位置保存用 ]
		showInc : 0,
		inc     : 0,
		prevInc : 0,
		offset  : 200,
		init :function (){
			if(!Useragnt.mobile){
				for(var i=0; i<page.scroll.$m.length; i++){
					page.scroll.point[i] = page.scroll.$m.eq(i).offset().top;
				}
			}else{
				for(var i=0; i<page.scroll.$s.length; i++){
					page.scroll.point[i] = page.scroll.$s.eq(i).offset().top;
				}
			}
			page.scroll.motion(0);
			// TweenLite.set($(".js__para"),{ y:100 });
			// $(".js__para").css({
			// 	"transform" : "translate3d(0px, "+ page.scroll.offset +"px, 0px)"
			// });
		},
		show : function(inc){
			page.scroll.showInc = page.scroll.showInc + inc;

			if(!Useragnt.mobile && !page.gnavi.status.flg){

				for(var i=0; i<page.scroll.$m.length; i++){
					var $t = page.scroll.$m.eq(i);
					if(page.scroll.point[i] - [page.h/1.5] < page.scroll.showInc){

						// console.log("show",i,page.scroll.showInc);

						page.effect.panel.show($t);
						page.effect.horizontalBox.show($t);
						page.effect.rotate.show($t);
						page.effect.horizontalBoxSt.show($t);
						page.effect.simple.show( $t.find(".js__simple").not(".js__delay") );


					}
				}


			}else{

				for(var i=0; i<page.scroll.$s.length; i++){

					var $t = page.scroll.$s.eq(i);

					// console.log("section",page.scroll.showInc);

					if(page.scroll.point[i] - [page.h/1.5] < page.scroll.showInc){

						// console.log("show",i,page.scroll.showInc);

						page.effect.panel.show($t.find(".js__panel"));
						page.effect.horizontalBox.show($t.find(".js__horizontal-box"));
						page.effect.rotate.show($t.find(".js__rotate"));
						page.effect.horizontalBoxSt.show($t.find(".js__horizontal-box_st"));
						page.effect.simple.show( $t.find(".js__simple").not(".js__delay") );


					}

				}


			}

		},
		motion : function(inc){ //[ page.scroll.motion ]



			page.scroll.inc = (inc!=0)?Number( page.scroll.getTrans( $("#document").children(".scroll-content") ) ) : 0;

			// console.log("inc",-page.scroll.inc + [ page.h - page.$fb.height() ]/2);

			// page.$fb.css({"top":-page.scroll.inc + [ page.h - page.$fb.height() ]/2 });
			var _fbT = -$("#document-inner").height() + page.h/2 - page.scroll.inc;
			// console.log("pagetop",_fbT)
			page.$fb.css({
				"transform" : "translateY("+ _fbT +"px)"
			});


			if(page.w > 750) {
				page.$pt.css({"top":-page.scroll.inc +  page.h - page.$pt.height() -70  });
				if(page.scroll.inc<0 && page.w>1080){
					page.$pt.css({
						"right":25,
						"transition": "all 0.18s cubic-bezier(0.23, 1, 0.32, 1)"
					});
				}else{
					page.$pt.css({
						"right":-200,
						"transition": "all 0.18s cubic-bezier(0.23, 1, 0.32, 1)"
					});
				}
			}


			// if(page.w > 750){
			// 	var ptY = Number(-page.scroll.inc) +  page.h - page.$pt.height() -20;
			// 	page.$pt.css({
			// 		"transform" : "translateY("+ ptY +"px)"
			// 	});
			// }


			if(page.scroll.inc!=0){
				if(page.bar.limit.y ==  -page.scroll.inc){
					page.$pt.not(".white").addClass("white");
				}else{
					page.$pt.removeClass("white");

				}

			}

			// console.log("inc",inc,page.bar.scrollTop);

			// if(Useragnt.edge) $("#document").children(".scroll-content").css({
			// 					"transform" : "translate3d(0px, -"+ page.bar.scrollTop +"px, 0px)"
			// 				});

			// page.pararax.motion(page.scroll.inc);


			// page.scroll.inc = page.scroll.inc + inc;

			// console.log("inc",inc);

			// page.scroll.inc = page.scroll.getTrans( $("#document").children(".scroll-content") );
			// // console.log( page.scroll.inc );
			// // console.log( page.scroll.getTrans( $("#document").children(".scroll-content") ) );


			// for(var i=0; i<page.scroll.$m.length; i++){
			// 	var $t = page.scroll.$m.eq(i);

			// 	if($t.hasClass("js__para")){


			// 		if(page.scroll.point[i] - page.h < - page.scroll.inc){


			// 			var para = {
			// 				inc  : [page.scroll.point[i] - page.scroll.inc] /15 ,
			// 				rate : $t.data("rate"),
			// 			};


			// 			para.inc = (para.inc>=page.scroll.offset)? page.scroll.offset : (0>para.inc)?0:para.inc;
			// 			para.inc = page.scroll.offset - [para.inc * para.rate];

			// 			if( para.inc < page.scroll.offset ) {

			// 			// console.log("parawww",i,para.inc);

			// 				$t.css({
			// 					"transform" : "translate3d(0px, "+ para.inc +"px, 0px)"
			// 				});

			// 			}

			// 		}
			// 	}



			// }

		},
		getTrans : function($t){
			var s = window.getComputedStyle($t.get(0));
			var m = s.getPropertyValue("-webkit-transform") || s.getPropertyValue("-moz-transform") || s.getPropertyValue("-ms-transform") || s.getPropertyValue("-o-transform") || s.getPropertyValue("transform");
			if (m === 'none') {
				m = 'matrix(0,0,0,0,0)';
			}
			var val = m.match(/([-+]?[\d\.]+)/g);
			return val[14] || val[5] || 0;
		}
	}, //[ scroll END ]

	first : {
		flg : false,
		$l  : $("#loader-container"),
		$c  : $("#kv-container"),
		$cp : $("#kv-copy"),
		tl  : new TimelineLite(),
		init : function(){

			// page.effect.svgDraw.set(page.first.$l);
			TweenLite.set(page.first.$l.find(".js__write"), {drawSVG: "0%",visibility:"visible"});
			TweenLite.set(page.first.$l.find(".js__op"), {opacity:0});
			TweenLite.set(page.first.$c, {width:0});

			TweenLite.set($("#header-container"),{ y:-200 });
			TweenLite.set($("#kv-scroll-container"),{ bottom:-200 });

			TweenLite.set(page.first.$cp.children(),{ width:"0%",perspective:400});

			$("#document-inner").css({"opacity":1});
			// TweenLite.set(page.first.$cp.children(),{ width:"0%",perspective:400});

			setTimeout(function(){
				page.first.motion();
			},1e3);

			// page.first.tl.to($c, 0.28, {height:$this.height()})
			// 	.to($c, 0.28, {width:$this.width()})
			// 	.to($c.find(".js__show").children(), 0.28, {x:0});
				// page.tl = new TimelineLite();
				// page.tl.to($c, 0.28, {height:$this.height()})
				// 	.to($c, 0.28, {width:$this.width()})
				// 	.to($c.find(".js__show").children(), 0.28, {x:0});

		},
		motion : function(){

			TweenMax.to(page.first.$l.find(".js__op"),.28,{
				opacity : 1,
				ease:Power2.easeOut,
				onComplete:function(){
				}
			});


			page.first.$c = ($("body").hasClass("lowlayer"))? $("#body") : page.first.$c;

			page.first.tl
			.to(page.first.$c,.36,{
				width : "100%",
				ease:Power1.easeIn,
				onStart:function(){
					if($("body").hasClass("lowlayer")){
						TweenMax.to(page.first.$l,.16,{
							opacity : 0,
							ease:Power1.easeIn,
						});
					}
				}
			})
			.to(page.first.$cp.children(),.46,{
				width : "100%",
				// opacity : 1,
				rotationY:720,
				// transformOrigin:"0% -50% 50%",
				ease:Power1.easeIn,
			})
			.to($("#header-container"),.38,{
				y : 0,
				ease:Power2.easeOut,

			})
			.to($("#kv-scroll-container"),.18,{
				bottom : 30,
				delay : 0.4,
				ease:Power2.easeOut,
				onComplete : function(){
					page.first.$l.css({"display":"none"});
					$("#site-logo-top").css({"display":"block"});
				}
			});
		}
	},

	common : {
		flg : false,
		$gt  : $("#gnavi-trigger"),
		$hc  : $("#head-navi-container"),
		init : function(){

			//page-top スクロール
			$("#page-top").on("click",function(){
				if($(".scroll-content")[0]){
					var scTween = new TweenMax.to($(".scroll-content"), .38,
						{
							y:0,
							ease: Power0.easeNone,
							onComplete:function(){
								page.$pt.removeClass("white");
								page.bar.scrollTo( 0, 0, 0.38, function(){
									page.scroll.inc = 0;
									page.scroll.showInc = 0;
								} );

							}
						}
					);
				}else{
					$('body,html').animate({scrollTop:0}, 300);
				}
			});

			//SMP グローバルメニュー
			page.common.$gt.on("click",function(){
				if(!page.common.flg){
					page.common.flg = true;
					page.common.$gt.addClass("open");
					TweenLite.set(page.common.$hc,{skewX:-15, skewY:-25 , height: page.h});
					TweenMax.to(page.common.$hc,.28,{
						autoAlpha: 1,
						display:'block',
						skewX:0,
						skewY:0,
						ease:Power2.easeOut,
					});
				}else{
					page.common.flg = false;
					page.common.$gt.removeClass("open");
					TweenMax.to(page.common.$hc,.28,{
						autoAlpha: 0,
						display:'none',
						skewX:-15,
						skewY:-25,
						ease:Power2.easeOut,

					});
				}

			});
		}
	},

	form : {
		flg : false,

		/* [ バリデートテキスト ] */
		requiredTxt : "<span class='error'>必須項目です</span>",
		hiraganaTxt : "<span class='error'>ひらがなで入力してください。</span>",
		katakanaTxt : "<span class='error'>カタカナで入力してください。</span>",
		zipTxt : "<span class='error'>郵便番号を正しく入力して下さい。</span>",
		telTxt : "<span class='error'>電話番号を正しく入力して下さい。</span>",
		mailTxt : "<span class='error'>メールアドレスの形式が異なります。</span>",
		mailcheckTxt : "<span class='error'>メールアドレスと一致しません。</span>",

// <<<<<<< HEAD
// 		$t : $("form input,form select,form textarea"),
// =======
		$t : $(".wpcf7-form input,.wpcf7-form select,.wpcf7-form textarea"),

		v  : "",

		init : function(){


			page.form.radio($(".radio-container"),"load");
			page.form.checkbox($(".checkbox-container.wpcf7-checkbox"),"load");

			$(".checkbox-container.wpcf7-checkbox").on("click",function(){
				page.form.checkbox($(this),"change");
				page.form.privacyCheck();
			});
			$(".radio-container.wpcf7-radio .wpcf7-list-item").on("click",function(){
				page.form.radio($(this),"change");
			});

			page.form.$t.blur(function(){

		        //バリデート通す
		        page.form.validation($(this));

		    });

			// page.form.$t.on("blur",function(){
			// 	//バリデート通す
			// 	page.form.validation($(this));

			// });

			page.form.$t.on("focus",function(){
				$(this).removeClass("error").parents("dd").find("span.error").remove();
			});


			$('.wpcf7-form').submit(function(){

				// //バリデート通す
				page.form.validation("all");
				if(!page.form.flg){
					// var p = $("#progress-navi").offset().top;
					$('html,body').animate({ scrollTop: 0 }, 'fast');
					return false;
				}
			});

			/* [ パラメータあったら取得 ] */
			if(location.search.substring(1)){
				$("#event-title").val( $("#event-title_text").text() );
				$("#event-url").val( $("#event-url_text").text() );
			}

		},
		privacyCheck : function(){


			if( $("#privacy-check").find('input[type="checkbox"]').prop("checked") ) {
				$("#submit-btn").removeClass("disable");
				$("#privacy-check").find('.error').remove();
			}else{
				$("#submit-btn").addClass("disable");
				$("#privacy-check").append('<span class="error">同意にチェックを入れて下さい</span>');
			}

		},
		/* [ ラジオボタン表示制御 ] */
		radio : function($t,type){
			if(type == "load"){
				for( var i=0; i<$t.find('input[type="radio"]:checked').length; i++ ){
					var _t = $t.find('input[type="radio"]:checked').eq(i);
					_t.parent().addClass("selected");
				}
			} else {
				var _t = $t.find('input[type="radio"]');

				$t.parents(".radio-container").find('input[type="radio"]').prop("checked",false);
				$t.parents(".radio-container").find(".selected").removeClass("selected");

				_t.prop("checked",true);
				_t.parent().addClass("selected");

			}
		},
		/* [ チェックボックス表示制御 ] */
		checkbox : function($t,type){

			if(type == "load"){
				for( var i=0; i<$t.find('input[type="checkbox"]').length; i++ ){
					var _t = $t.find('input[type="checkbox"]').eq(i);
					if(_t.prop("checked")) _t.parent().addClass("selected");
				}
			} else {
				var _t = $t.find('input[type="checkbox"]');
				if(_t.prop("checked")){
					_t.prop("checked",false);
					_t.parent().removeClass("selected");
				}else{
					_t.prop("checked",true);
					_t.parent().addClass("selected");
				}
			}

		},

		validation : function(t){

			//エラーの初期化
			if(t == "all"){
				$(".wpcf7-form span.error").remove();
				$(".wpcf7-form input.error,.wpcf7-form select.error,.wpcf7-form textarea.error").removeClass("error");
				page.form.v = $(":text,[type=email],[type=tel],select,radio,checkbox,textarea");
				/*page.form.$t.filter(".error").removeClass("error");
				page.form.v = ($(".required")[0])?
					$("[type=text],[type=email],[type=tel],select,radio,checkbox,textarea").filter(".required") :
					$(".wpcf7-validates-as-required");*/
			}else{
				t.parents("dd").find("span.error").remove();
				t.removeClass("error");
				page.form.v = t;
			}
			// page.form.v.each(function(){
			for(var i=0; i<page.form.v.length; i++){

				// var _t = $(this);
				var _t = page.form.v.eq(i);

					var thisID = _t.attr("id"),
						_p = _t.parents("dd");

					//ひらがなのチェック
					if(thisID == "hiragana_name_first" || thisID == "hiragana_name_last"){
						_p.find("span.error").remove();
						if(_t.val()=="" && _t.hasClass("wpcf7-validates-as-required")){
							_p.append(page.form.requiredTxt);
						}else{
							if(!_t.val().match(/^[ぁ-ろわをんー 　\r\n\t]*$/)){
								if(_t.val()!="") _p.append(page.form.hiraganaTxt);
							}
						}
					}
					//カタカナのチェック
					else if(thisID.match(/katakana/g)){
						if(_t.val()=="" && _t.hasClass("wpcf7-validates-as-required")){
							_p.append(page.form.requiredTxt);
						}else{
							if(!_t.val().match(/^[ァ-ロワヲンー 　\r\n\t]*$/)){
								if(_t.val()!="") _p.append(page.form.katakanaTxt);
							}
						}
					}
					//郵便番号のチェック
					else if(thisID.match(/zip/g)){
						if(_t.val()=="" && _t.hasClass("wpcf7-validates-as-required")){
							_p.append(page.form.requiredTxt);
						}else{
							if(!_t.val().match(/^[0-9\-]+$/) || _t.val().length < 7){
								if(_t.val()!="") _p.append(page.form.zipTxt);
							}
						}
					}
					//メールアドレスのチェック
					else if(thisID == "email"){
						if(_t.val()=="" && _t.hasClass("wpcf7-validates-as-required")){
							_p.append(page.form.requiredTxt);
						}else{
							if(!_t.val().match(/.+@.+\..+/g)){
								if(_t.val()!="") _p.append(page.form.mailTxt);
							}
						}
					}
					//メールアドレス確認のチェック
					else if(thisID == "emailcheck"){
						if(_t.val()=="" && _t.hasClass("wpcf7-validates-as-required")){
							_p.append(page.form.requiredTxt);
						}else if(_t.val()!=$("input[name="+_t.attr("name").replace(/^(.+)check$/, "$1")+"]").val()){
							if(_t.val()!="") _p.append(page.form.mailcheckTxt);
						}
					}

					//電話番号のチェック
					else　if(_t.attr("type") == "tel" && thisID != "zip"){
						if(_t.val()=="" && _t.hasClass("wpcf7-validates-as-required")){
							_p.append(page.form.requiredTxt);
						}else{
							if(!_t.val().match(/^[0-9\-]+$/) || _t.val().length < 10){
								if(_t.val()!="") _p.append(page.form.telTxt);
							}
						}
					}
					//必須項目のチェック
					else if(_t.hasClass("wpcf7-validates-as-required")){
						// console.log("this",_t.hasClass("wpcf7-validates-as-required"));
						if(_t.val()==""){
							if(!_p.find("span.error")[0]) _p.append(page.form.requiredTxt);
						}
					}

				if($("#"+thisID).parents("dd").find("span.error")[0])
					$("#"+thisID).addClass("error");

			}

			//同意ボタンチェック
			if(t == "all"){
				page.form.privacyCheck();
			}

			// });
			if($(".wpcf7-validates-as-required.error")[0] || $("#privacy-check .error")[0]){
			//エラーがある場合は確認へ行かせない
				page.form.flg　= false;
			}else{
				//エラー無し
				page.form.flg = true;
			}
		},



	}

}


$(window).on("load",function(){
	page.init();
});
$(window).on("load resize",function(){
	page.resize();
});
