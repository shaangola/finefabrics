var xxx_modalPopupWindow = null;

function CreateModalPopUpObject() {
    if (xxx_modalPopupWindow == null) {
        xxx_modalPopupWindow = new ModalPopupWindow();
    }
    return xxx_modalPopupWindow;
}

function ModalPopupWindow() {
    var strOverLayHTML = '<div id="divOverlay" style="position:absolute;z-index:10; background-color:WHITE; filter: alpha(opacity = 70);opacity:0.7;"></div><div id="divFrameParent" style="position:absolute;z-index:12; display:none;background-color:white;border:1px solid;-moz-box-shadow: 0 0 10px 10px #BBB;-webkit-box-shadow: 0 0 10px 10px #BBB;box-shadow: 0 0 10px 10px #BBB;" class="Example_F"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr style="background-color:Gray;"><td align="left"><span id="spanOverLayTitle" style="color:White;font-size:9pt;padding-left:2px"></span></td><td  align="right" style="height:25px;"><span id="spanOverLayWindow_Max" style="display:none" onclick="Maximisze();" style="cursor:pointer">max</span><span onclick="xxx_modalPopupWindow.HideModalPopUp();" style="cursor:pointer"> <img id="imgOverLayClose"  src="" alt="X" </span></td></tr><tr ><td colspan="2" align="center" width="100%" id="tdOverLay"><div id="divMessage" style="margin-top:20px;display:none;"  ><span id="spanMessage" style="padding-left:40px;padding-top:10px;padding-bottom:10px; font-size:9pt;"  ></span></div><span id="spanLoading"> <img id="imgOverLayLoading" src="" alt="Loading..." /></span><iframe name="overlay_frame" id="overlay_frame" src="/Blank.htm" frameborder="0" scrolling="auto" ></iframe> </td></tr><tr id="trOverLayBtn" ><td colspan="2" align="center" style="padding-top:20px;padding-bottom:10px;"><input type="button" id="btnOverLay1" onclick="xxx_modalPopupWindow.HideModalPopUp()" value="Ok" style="padding:3px; border:1 solid #dcdcdc;BACKGROUND-COLOR: #f5f5f5;"   /><input type="button" id="btnOverLay2" onclick="xxx_modalPopupWindow.HideModalPopUp()" value="Cancel" style="padding:3px;margin-left:20px;border:1 solid #dcdcdc;BACKGROUND-COLOR: #f5f5f5;"   /> </td></tr></table></div>'
    var orginalHeight;
    var orginalWidth;
    var btnStyle="";
    var maximize = false;
    document.write(strOverLayHTML);

    function Maximisze() {
        if (!maximize) {
            maximize = true;
            ResizePopUp(window.screen.availHeight - 200, window.screen.availWidth - 50);
        } else {
            maximize = false;
            ResizePopUp(orginalHeight, orginalWidth);
        }
    }

    function ResizePopUp(height, width) {
        var divFrameParent = document.getElementById("divFrameParent");
        var divOverlay = document.getElementById("divOverlay");
        var iframe = document.getElementById("overlay_frame");
        var tdOverLay = document.getElementById("tdOverLay");
        var left = (window.screen.availWidth - width) / 2;
        var top = (window.screen.availHeight - height) / 2;
        var xy = GetScroll();
        if (maximize) {
            left = xy[0] + 10;
            top = xy[1] + 10;
        } else {
            left += xy[0];
            top += xy[1];
        }
        divFrameParent.style.top = top + "px";
        divFrameParent.style.left = left + "px";
        divFrameParent.style.height = height + "px";
        divFrameParent.style.width = width + "px";
        iframe.style.height = divFrameParent.offsetHeight - 60 + "px";
        iframe.style.width = divFrameParent.offsetWidth - 2 + "px";
    }
    var onPopUpCloseCallBack = null;
    var callbackArray = null;
    this.SetLoadingImagePath = function (imagePath) {
        document.getElementById("imgOverLayLoading").src = imagePath;
    }
    this.SetCloseButtonImagePath = function (imagePath) {
        document.getElementById("imgOverLayClose").src = imagePath;
    }

    this.SetButtonStyle = function (_btnStyle) {
      btnStyle =_btnStyle;
    }
    
    function ApplyBtnStyle(){
    if(btnStyle == "")
    return;
        var styles = btnStyle.split(';');
        for (var i = 0; i < styles.length; i++) {
            var style = styles[i].split(':');
            var objBtn1 = document.getElementById("btnOverLay1");
            var objBtn2 = document.getElementById("btnOverLay2");
            eval("objBtn1.style." + style[0] + "='" + style[1] + "';");
            eval("objBtn2.style." + style[0] + "='" + style[1] + "';");
        }
    }
    
    function __InitModalPopUp(height, width, title) {
        orginalWidth = width;
        orginalHeight = height;
        maximize = false;
        var divFrameParent = document.getElementById("divFrameParent");
        var divOverlay = document.getElementById("divOverlay");
        var iframe = document.getElementById("overlay_frame");
        var tdOverLay = document.getElementById("tdOverLay");
        var left = (window.screen.availWidth - width) / 2;
        var top = (window.screen.availHeight - height) / 2;
        var xy = GetScroll();
        left += xy[0];
        top += xy[1];
        document.getElementById("trOverLayBtn").style.display = "none";
        document.getElementById("spanOverLayTitle").innerHTML = title;
        divOverlay.style.top = "0px";
        divOverlay.style.left = "0px";
        var e = document;
        var c = "Height";
        var maxHeight = Math.max(e.documentElement["client" + c], e.body["scroll" + c], e.documentElement["scroll" + c], e.body["offset" + c], e.documentElement["offset" + c]);
        c = "Width";
        var maxWidth = Math.max(e.documentElement["client" + c], e.body["scroll" + c], e.documentElement["scroll" + c], e.body["offset" + c], e.documentElement["offset" + c]);
        divOverlay.style.height = maxHeight + "px";
        divOverlay.style.width = maxWidth - 2 + "px";
        divOverlay.style.display = "";
        iframe.style.display = "none";
        divFrameParent.style.display = "";
        //$('#divFrameParent').animate({ opacity: 1 }, 2000);
        divFrameParent.style.top = top + "px";
        divFrameParent.style.left = left + "px";
        divFrameParent.style.height = height + "px";
        divFrameParent.style.width = width + "px";
        iframe.style.height = "0px";
        iframe.style.width = "0px";
        document.getElementById("btnOverLay1").style.width = "";
        document.getElementById("btnOverLay2").style.width = "";
        onPopUpCloseCallBack = null;
        callbackArray = null;
    }
    this.ShowURL = function (url, height, width, title, onCloseCallBack, callbackFunctionArray, maxmizeBtn) {
        __InitModalPopUp(height, width, title);
        var divFrameParent = document.getElementById("divFrameParent");
        var divOverlay = document.getElementById("divOverlay");
        var iframe = document.getElementById("overlay_frame");
        var tdOverLay = document.getElementById("tdOverLay");
        tdOverLay.style.height = divFrameParent.offsetHeight - 20 + "px";
        tdOverLay.style.width = divFrameParent.offsetWidth - 2 + "px";
        document.getElementById("spanLoading").style.display = "";
        document.getElementById("divMessage").style.display = "none";
        iframe.src = url;
        iframe.style.height = divFrameParent.offsetHeight - 60 + "px";
        iframe.style.width = divFrameParent.offsetWidth - 2 + "px";
        setTimeout("xxx_modalPopupWindow.LoadUrl('" + url + "')", 1000);
        if (onCloseCallBack != null && onCloseCallBack != '') {
            onPopUpCloseCallBack = onCloseCallBack;
        }
        if (callbackFunctionArray != null && callbackFunctionArray != '') {
            callbackArray = callbackFunctionArray;
        }
        if (maxmizeBtn) {
            document.getElementById("spanOverLayWindow_Max").style.display = "";
        }
    }
    this.ShowMessage = function (message, height, width, title) {
        __InitModalPopUp(height, width, title);
        document.getElementById("trOverLayBtn").style.display = "";
        var tdOverLay = document.getElementById("tdOverLay");
        tdOverLay.style.height = "50px";
        tdOverLay.style.width = "0px";
        document.getElementById("spanMessage").innerHTML = message;
        document.getElementById("divMessage").style.display = "";
        document.getElementById("spanLoading").style.display = "none";
        document.getElementById("btnOverLay1").value = "OK";
        document.getElementById("btnOverLay1").onclick = xxx_modalPopupWindow.HideModalPopUp;
        document.getElementById("btnOverLay2").style.display = "none";
        ApplyBtnStyle();
    }
    this.ShowConfirmationMessage = function (message, height, width, title, onCloseCallBack, firstButtonText, onFirstButtonClick, secondButtonText, onSecondButtonClick) {
        this.ShowMessage(message, height, width, title);
        var tdOverLay = document.getElementById("tdOverLay");
        var maxWidth = 100;
        document.getElementById("spanMessage").innerHTML = message;
        document.getElementById("divMessage").style.display = "";
        document.getElementById("spanLoading").style.display = "none";
        if (onCloseCallBack != null && onCloseCallBack != '') {
            onPopUpCloseCallBack = onCloseCallBack;
        }
        if (firstButtonText != "") {
            document.getElementById("btnOverLay1").value = firstButtonText;
            if (onFirstButtonClick != "") {
                document.getElementById("btnOverLay1").onclick = onFirstButtonClick;
            }
        }
        if (secondButtonText != "") {
            document.getElementById("btnOverLay2").value = secondButtonText;
            document.getElementById("btnOverLay2").style.display = "";
            if (onSecondButtonClick != null && onSecondButtonClick != "") {
                document.getElementById("btnOverLay2").onclick = onSecondButtonClick;
            }
        }
        if (firstButtonText != "" && secondButtonText != "") {
            if (document.getElementById("btnOverLay1").offsetWidth > document.getElementById("btnOverLay2").offsetWidth) {
                document.getElementById("btnOverLay2").style.width = document.getElementById("btnOverLay1").offsetWidth + "px";
            }
            if (document.getElementById("btnOverLay2").offsetWidth > document.getElementById("btnOverLay1").offsetWidth) {
                document.getElementById("btnOverLay1").style.width = document.getElementById("btnOverLay2").offsetWidth + "px";
            }
        }

        ApplyBtnStyle();
    }
    this.LoadUrl = function (url) {
        if (navigator.userAgent.toLowerCase().indexOf('firefox') != -1 || navigator.userAgent.toLowerCase().indexOf('safari') != -1) {
            document.getElementById("overlay_frame").style.display = "";
            document.getElementById("spanLoading").style.display = "none";
        } else {
            if (document.getElementById("overlay_frame").readyState == "complete") {
                document.getElementById("overlay_frame").style.display = "";
                document.getElementById("spanLoading").style.display = "none";
            } else {
                setTimeout("xxx_modalPopupWindow.LoadUrl('" + url + "')", 1000);
            }
        }
    }

    function ShowLoading() {
        document.getElementById("overlay_frame").style.display = "none";
        document.getElementById("spanLoading").style.display = "";
    }
    this.HideModalPopUp = function () {
        var divFrameParent = document.getElementById("divFrameParent");
        var divOverlay = document.getElementById("divOverlay");
        divOverlay.style.display = "none";
        divFrameParent.style.display = "none";
        if (onPopUpCloseCallBack != null && onPopUpCloseCallBack != '') {
            onPopUpCloseCallBack();
        }
    }
    this.CallCallingWindowFunction = function (index, para) {
        callbackArray[index](para);
    }
    this.ChangeModalPopUpTitle = function (title) {
        document.getElementById("spanOverLayTitle").innerHTML = title;
    }

    function setParentVariable(variableName, variableValue) {
        window[String(variableName)] = variableValue;
    }

    function GetScroll() {
        if (window.pageYOffset != undefined) {
            return [pageXOffset, pageYOffset];
        } else {
            var sx, sy, d = document,
                r = d.documentElement,
                b = d.body;
            sx = r.scrollLeft || b.scrollLeft || 0;
            sy = r.scrollTop || b.scrollTop || 0;
            return [sx, sy];
        }
    }
}