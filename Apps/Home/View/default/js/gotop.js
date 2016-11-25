//第一个参数是按钮id；第二个参数是一个布尔值，true是一直显示按钮，false是当滚动距离不为0时，显示按钮
function toTop(show){
	var scrollEle = document.getElementById("detail-page");
    var oTop = document.getElementById("toTop");
    var bShow = show;
    if(!bShow){
        oTop.style.display = 'none';
        setTimeout(btnShow,50);
    }
    oTop.onclick = scrollToTop;
    function scrollToTop(){
        var scrollTop = scrollEle.scrollTop || document.body.scrollTop;
        var iSpeed = Math.floor(-scrollTop/2);
        if(scrollTop <= 0){
            if(!bShow){
                oTop.style.display = 'none';
            }
            return;
        }
        scrollEle.scrollTop = document.body.scrollTop = scrollTop + iSpeed;
        setTimeout(arguments.callee,50);
    }
    function btnShow(){
        var scrollTop = scrollEle.scrollTop || document.body.scrollTop;
        if(scrollTop <= 0 ){
            oTop.style.display = 'none';
        }else{
            oTop.style.display = 'block';
        }
        setTimeout(arguments.callee,50);
    }
}