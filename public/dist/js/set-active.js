$(document).ready(function(){
    var pathname = window.location.pathname; // Returns path only
    //alert(pathname);
    if(pathname === "/system/dashboard.php"){
        $('#dashboard-link').addClass("active");
    }else if(pathname === "/system/clients.php"){
        $('#clients-link').addClass("active");
    } else if(pathname === "/system/orders.php"){
        $('#orders-link').addClass("active");
    } else if(pathname === "/system/production.php"){
        $('#production-link').addClass("active");
    } else if(pathname === "/system/inventory.php"){
        $('#inventory-link').addClass("active");
    } else if(pathname === "/system/workers.php"){
        $('#workers-link').addClass("active");
    }
});