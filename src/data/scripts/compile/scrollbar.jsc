<!--

var db = (document.body) ? 1 : 0;
var scroll = (window.scrollTo) ? 1 : 0;

function setCookie(name, value, expires, path, domain, secure) {
  var curCookie = name + "=" + escape(value) +
    ((expires) ? "; expires=" + expires.toGMTString() : "") +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    ((secure) ? "; secure" : "");
  document.cookie = curCookie;
}

function getCookie(name) {
  var dc = document.cookie;
  var prefix = name + "=";
  var begin = dc.indexOf("; " + prefix);
  if (begin == -1) {
    begin = dc.indexOf(prefix);
    if (begin != 0) return null;
  } else {
    begin += 2;
  }
  var end = document.cookie.indexOf(";", begin);
  if (end == -1) end = dc.length;
  return unescape(dc.substring(begin + prefix.length, end));
}

function saveScroll() {
  if (!scroll) return;
  var now = new Date();
  now.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000);
  var x = (db) ? document.body.scrollLeft : pageXOffset;
  var y = (db) ? document.body.scrollTop : pageYOffset;
  setCookie("xy", x + "_" + y, now);
}

function loadScroll() {
  if (!scroll) return;
  var xy = getCookie("xy");
  if (!xy) return;
  var ar = xy.split("_");
  if (ar.length == 2) scrollTo(parseInt(ar[0]), parseInt(ar[1]));
}

// -->