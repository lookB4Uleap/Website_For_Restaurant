function initialize() {
    if (sessionStorage.getItem("user_id")===null) {
        sessionStorage.setItem("user_id",-1);
        sessionStorage.setItem('user_email',-1);
    }
    else 
        setUser();
}

function setUser() {
    if (sessionStorage.getItem("user_id")==-1) {
        return;
    }
    var ele=document.getElementById("user")
    ele.innerHTML="<i class='fas fa-user-alt'></i>";
    ele.href='#';
}

function dropdown() {
    //alert();
    if (sessionStorage.getItem("user_id")==-1 || sessionStorage.getItem("user_id")===null)
    return;
    //document.getElementById("drop-down-box").style.top="120px";
    //alert(document.getElementById("drop-down-box").style.visibility);
    if (document.getElementById("drop-down-box").style.visibility=="visible") {
    document.getElementById("drop-down-box").style.visibility="hidden";
    }
    else
    document.getElementById("drop-down-box").style.visibility="visible";
}

function loadEmail() {
    var id = sessionStorage.getItem("user_id");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("email").value = this.responseText;
    }
    };
    xhttp.open("GET", "getemail.php?q="+id, true);
    xhttp.send();
}

function loadCart() {
    var xhttp,str=sessionStorage.getItem('user_id');
    document.getElementById("qq").value=Number(str);  
    //load(str);
    //setUser2();
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("container").innerHTML += this.responseText;
    loadReceipt();
    }
    };
    xhttp.open("GET", "getcart.php?q="+str, true);
    xhttp.send();
}

function loadReceipt() {
    var n=document.getElementById("q").value;
    if (n<0)
    document.getElementById("q").value=0;
    $(document).ready(function() {
            var tot_amt=0,i,it_nm="",cost,no,n,str,item,len;
            var item=document.getElementsByClassName("item");
            len=item.length;
            //alert(len);
            for (i=0;i<len;++i) {
                it_nm=item[i];
                //alert(it_nm);
                //alert();  
                cost=$(it_nm).children("div#cost").text();
                //alert(cost);
                cost=cost.substring(1);
                //alert(cost);
                cost=parseFloat(cost);
                //alert(cost);
                no=$(it_nm).children("div#quantity");
                n=no.children("input#q").val();
                //alert(n*cost);
                tot_amt+=cost*n;
                //alert(tot_amt);
            }
            //alert(tot_amt);
            tot_amt=tot_amt.toFixed(2);
            str=tot_amt.toString();
            //alert(tot_amt);
            document.getElementById("receipt").innerHTML="Cost : <span>&#8377;</span>"+str;
            document.getElementById("pr").value=str;
    });
}

function signout() {
    var x=-1;
    sessionStorage.setItem('user_id',x);
    //location.href = "LoginTemplate.html";
}

