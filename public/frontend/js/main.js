
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("item").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("item").innerHTML = this.responseText;
        }
        }
        xmlhttp.open("GET", "search/q="+str, true);
        xmlhttp.send();
    }
    }
function addCart(id) {     
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("quantity").innerHTML = this.responseText;
            showcart();
            showOrder();
        }
        }
        xmlhttp.open("GET", "addcart/c="+id, true);
     xmlhttp.send();
}
function subCart(id) {
        
    var xmlhttp = new XMLHttpRequest();
   
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        document.getElementById("quantity").innerHTML = this.responseText;
        showcart();
        showOrder();
    }
    }
    xmlhttp.open("GET", "subcart/c="+id, true);
 xmlhttp.send();
}
var showcart = function() {
    // document.getElementById("index-cart").style = "display: block;";
    // document.getElementById("index-cart").onclick(document.getElementById("index-cart").style="display: none;");
    // document.getElementById('dropdown-menu').style = 'display: block;';
     var xmlhttp = new XMLHttpRequest();
   
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("list-cart").innerHTML = this.responseText;
    }
    }
    xmlhttp.open("GET", "showcart", true);
    xmlhttp.send();
}

    
var showOrder = function() {
    // document.getElementById("index-cart").style = "display: block;";
    // document.getElementById("index-cart").onclick(document.getElementById("index-cart").style="display: none;");
    // document.getElementById('dropdown-menu').style = 'display: block;';
     var xmlhttp = new XMLHttpRequest();
   
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(document.getElementById('list-product') !== null){
            document.getElementById("list-product").innerHTML = this.responseText;
        }
    }
    }
    xmlhttp.open("GET", "getorder", true);
    xmlhttp.send();
}
showOrder();
var getprice=function(){
    const price = $("#pric").text();
    $("#price").val(price);
    // $("#price2").val(price);
}

var getprice1=function(){
    const price = $("#pric").text();
    $("#price2").val(price);
    // $("#price2").val(price);
}


function show_Cart() {
        showcart();
        document.getElementById('dropdown-menu').style = 'display:block;';   
}
function close_cart(){
         document.getElementById('dropdown-menu').style = 'display:none;';   
}

function removeitem(id,x) {   
    x.innerHTML = "<div class='spinner-border' style='width: 1rem; height: 1rem;'></div>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        
    if (this.readyState == 4 && this.status == 200) {
            const text = this.responseText;
            const obj = JSON.parse(text);
        document.getElementById("quantity").innerHTML = this.responseText;
        showcart();
        showOrder();
    }  
    }
    xmlhttp.open("GET", "removecart/r="+id, true);
 xmlhttp.send();
}
