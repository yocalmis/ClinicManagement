
<div id="saatuygulamasitagi"></div>
<script>
	function saatuygulamasi(){
		var 
		eleman			= document.getElementById("saatuygulamasitagi"),
		tarih_goster	= new Date();

		eleman.innerHTML = tarih_goster.toLocaleString();

	}	

	saatuygulamasi();

	setInterval("saatuygulamasi()", 1000);

</script>
