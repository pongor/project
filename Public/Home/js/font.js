+function(d, w) {
    var WIDTH_TO_REM = 20;
        i = d.documentElement,
        s = function() {
            var t = i.clientWidth;
            t && (i.style.fontSize = (t / WIDTH_TO_REM) + "px");
        };
    if (d.addEventListener) {
        d.addEventListener("DOMContentLoaded", s, false);
        w.addEventListener("resize", s, false);
        w.addEventListener("orientationchange", s, false);
    } else {
        d.attachEvent("onDOMContentLoaded", s);
        w.attachEvent("onresize", s);
        w.attachEvent("onorientationchange", s);
    }
}(document, window);