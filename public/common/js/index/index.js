function dayin(){
	var userAgent = navigator.userAgent.toLowerCase(); //取得浏览器的userAgent字符串
	if (userAgent.indexOf("trident") > -1){
		alert("请使用google或者360浏览器打印");
		return false;
	}else if(userAgent.indexOf('msie')>-1){ 
		var onlyChoseAlert = simpleAlert({
           "content":"请使用Google或者360浏览器打印",
           "buttons":{
               "确定":function () {
                   onlyChoseAlert.close();
               }
           }
       })
		alert("请使用google或者360浏览器打印");
		return false;
	}else{//其它浏览器使用lodop
		var oldstr = document.body.innerHTML; 
		var headstr = "<html><head><title></title></head><body>";  
		var footstr = "</body>";  
		//执行隐藏打印区域不需要打印的内容
		document.getElementById("otherpho").style.display="none";
		//此处id换为你自己的id
		var printData = document.getElementById("printdivaa").innerHTML; //获得 div 里的所有 html 数据
		document.body.innerHTML = headstr+printData+footstr;
		window.print();
		//打印结束后，放开隐藏内容
		document.getElementById("otherpho").style.display="block";
		document.body.innerHTML = oldstr ;
	}
}