<?php

include_once("../common/functions.php");

check_session_timeout();

$_isLogon = checkUserLogon();

?>

<!-- ******** [START] Navigation Header Bar ******** -->
<noscript>
    <div class="noscriptmsg">
    <meta http-equiv="refresh" content="1; URL=../exception/noJavaScriptException.php">
    </div>
</noscript>
<script type="text/javascript">

    function countFoodFromCart($foodID)
    {
    	if($foodID == undefined || $foodID == null || $foodID == ""){
    		return;
    	}
    	
    	var _foodData = {"foodID":$foodID}; //if foodID == "ALL", then sum all food's quantity
    	$.ajax(
    		{
    			type: 'post',
    			url: '../recommend/cartAjaxService.php',
    			
    			data: {
    				foodID2Count:_foodData
    			},
    			
    			success: function (qty) 
    			{
    				return qty;
    			}
    		}
    	);
    }
    
    function countFoodFromCartInSync($foodID)
    {
    	if($foodID == undefined || $foodID == null || $foodID == ""){
    		return;
    	}
    	
    	var _foodData = {"foodID":$foodID}; //if foodID == "ALL", then sum all food's quantity
    	$.extend({
    		countResponse: function() 
    	    {
    			var result = null;
    			$.ajax(
    				{
    					type: 'post',
    					url: '../recommend/cartAjaxService.php',
    					
    					async: false,
    					
    					data: {
    						foodID2Count:_foodData
    					},
    					
    					success: function (qty) 
    					{
    						result = qty;
    					}
    				}
    			);
    			return result;
    	    }
    	});
    	
    	return $.countResponse();
    }

    function countNotificationInSync()
    {        
    	$.extend({
    		countResponse: function() 
    	    {
    			var result = null;
    			$.ajax(
    				{
    					type: 'post',
    					url: '../notification/notificationService.php',

    					async: false,
    					    					
    					data: {
    						notification2Count:true
    					},
    					
    					success: function (qty) 
    					{
    						result = qty;
    					}
    				}
    			);
    			return result;
    	    }
    	});
    	
    	return $.countResponse();
    }
    
	function showItemCount(){
	    var itemCount = countFoodFromCartInSync("ALL");

	    if(itemCount == undefined || itemCount == null || itemCount == '0'){
	    	$('#itemCount').html(itemCount).css('display', 'none');
	    }else{
	    	$('#itemCount').html(itemCount).css('display', '');
	    	$('#itemCount').html(itemCount);
	    }

	    var notiCount = countNotificationInSync();

	    if(notiCount == undefined || notiCount == null || notiCount == '0'){
	    	$('#notiItemCount').html(notiCount).css('display', 'none');
	    }else{
	    	$('#notiItemCount').html(notiCount).css('display', '');
	    	$('#notiItemCount').html(notiCount);
	    }	    	    
	}
</script>

<script type="text/javascript">
	function showProgress() {
	  document.getElementById("app").style.display = "none";
	  document.getElementById("loading").style.display = "";
	  
	  setTimeout(function() {
		  document.getElementById("loading").style.display = "none";
		  document.getElementById("app").style.display = "";
		}, 100);
	}

	function hideProgress() {
	  document.getElementById("loading").style.display = "none";
	  document.getElementById("app").style.display = "";
	}

	$(document).ready(function(){
		showProgress();
		showItemCount();
	});
</script>

<style>
    /* Center the loader */
    #loading {
      position: absolute;
      left: 50%;
      top: 50%;
      z-index: 1;
      width: 150px;
      height: 150px;
      margin: -75px 0 0 -75px;
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #ff5733;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }
    
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>
        
<style type="text/css">
    #itemCount{
      border-radius: 100%;
      background: red;
      color: white;
      font-weight: 900;
      vertical-align : top;
      text-align: center;
      font-size:15px;
    }
    
     #notiItemCount{
      border-radius: 100%;
      background: red;
      color: white;
      font-weight: 900;
      vertical-align : top;
      text-align: center;
      font-size:15px;
    }
</style>


<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="../img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.html"><img src="../img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>
        
        
        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.html"><img src="../img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="active"><a href="../index.php">Home</a></li>
                    <li><a href="../shop.html">Shop</a></li>
                    <li><a href="../product-details.html">Product</a></li>
                    <li><a href="../cart.html">Cart</a></li>
                    <li><a href="../checkout.html">Checkout</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="../cart.html" class="cart-nav"><img src="../img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="../img/core-img/favorites.png" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="../img/core-img/search.png" alt=""> Search</a>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->
						
						
						