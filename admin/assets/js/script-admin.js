/********************************MENU BAR JS*************************************/


	function myFunction() {
	    var x = document.getElementById("admintopnav");
	    if (x.className === "topnav") {
	        x.className += " responsive";
	    } else {
	        x.className = "topnav";
	    }
	}