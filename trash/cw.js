function func() { 
	var k = document.getElementById('k').value;
	var b = document.getElementById('b').value;
	var q = document.getElementById('q').value;
	var slct = document.getElementById('slct').value;
	window.location.href = "http://html.loc/cw/cw.php?k=" + k + "&b=" + b + "&q=" + q + "&slct=" + slct;
	}