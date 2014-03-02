	function getDocumentHeight(){
    var de = document.body.parentNode;
    var db = document.body;
    return ((db.clientHeight>de.clientHeight)?db.clientHeight:de.clientHeight);
}

function getDocumentWidth(){
    var de = document.body.parentNode;
    var db = document.body;
    return ((db.clientWidth>de.clientWidth)?db.clientWidth:de.clientWidth);
}

function getScreenHeight(){
    var de = document.body.parentNode;
    var db = document.body;
    if (window.opera) return db.clientHeight;
    if (document.compatMode=='CSS1Compat') return de.clientHeight;
    else return db.clientHeight;
}

function getScreenWidth(){
    var de = document.body.parentNode;
    var db = document.body;
    if(window.opera)return db.clientWidth;
    if (document.compatMode=='CSS1Compat')return de.clientWidth;
    else return db.clientWidth;
}

function getScrollTop(){
    return document.documentElement.scrollTop || document.body.scrollTop;
}

function getScrollLeft(){
    return document.documentElement.scrollLeft || document.body.scrollLeft;
}