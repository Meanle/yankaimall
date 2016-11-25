var c = 0;
window.onload = function() {
    var a = b = null;
    if (window.sessionStorage) {
        a = parseInt(sessionStorage.getItem("top"));
        b = parseInt(sessionStorage.getItem("size"));
        //6是AJAX 每次请求多少个dd
        num = 6 * b;
        c = b ? b : 0;
        // ajax渲染
        console.log(a);
        document.body.scrollTop = a;
    }
}
window.onscroll = function() {
    var tops = document.body.scrollTop,
        height = document.documentElement.scrollHeight,
        scrollbottom = height - _height - tops;
    console.log("top:" + tops + "height:" + height + "scrollbottom:" + scrollbottom + "_height" + _height);
    if (window.sessionStorage) {
        sessionStorage.setItem("top", tops);
        sessionStorage.setItem("size", c);
    }
    if (scrollbottom == 0 || scrollbottom == -1) {
        c++;
    }
}
