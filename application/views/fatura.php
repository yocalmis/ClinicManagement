<?php  $this->load->view('header_ozel.php'); ?>	
<link rel="stylesheet" href="<?php echo base_url('assets/grocery_crud/css/ui/simple') ?>/jquery-ui-1.10.1.custom.min.css">



<body>

	<form action="<?php echo base_url(); ?>yonetim/fatura_al" method="post" >

		<div class="material-container">

			<h2 class="material-container__heading">
			
	<?php if($data['side_menu']=="Satış Fatura Ayarları"){ echo'Satış Faturası'; } ?>
	<?php if($data['side_menu']=="Alış Fatura Ayarları"){ echo'Alış Faturası'; } ?>		
			
			
			
			</h2>



			<div class="material-container__row musteri_bilgi">
				
	<?php if($data['side_menu']=="Satış Fatura Ayarları"){ echo'<input id="fat_turu" name="fat_turu" value="Satış" type="hidden" placeholder="Fatura Türü" class="material-container__input" />'; } ?>
	<?php if($data['side_menu']=="Alış Fatura Ayarları"){ echo'<input id="fat_turu" name="fat_turu" value="Alış" type="hidden" placeholder="Fatura Türü" class="material-container__input" />'; } ?>		
				
				<select id="mus" name="mus" required placeholder="Müşteri" class="material-container__input">
			<option value="">Cari Seçiniz</option>				
			<?php  if( $data["cari_getir"] ) :  foreach( $data["cari_getir"] as $dizi ) :     ?>
			<option value="<?php echo $dizi["id"]; ?>"><?php echo $dizi["adi_soyadi"]; ?></option>
			<?php  	endforeach;  endif;     ?>
			</select>
				<!--	<input id="mus" name="mus" type="text" required placeholder="Müşteri" class="material-container__input" />-->
					
					
	
					
					
					
					
					<input  id="seri" name="seri" type="text" required placeholder="Seri No" class="material-container__input" />
					<input  id="no" name="no" type="text" required placeholder="Fatura No" class="material-container__input" />
						<input 
							id="duz_ta" 
							name="duz_ta" 
							type="text"  required
							placeholder="Düzenleme Tarihi" 
							class="material-container__input datepicker" />
						<input 
							id="va_ta" 
							name="va_ta" 
							type="text"  required
							placeholder="Vade Tarihi" 
							class="material-container__input datepicker" />
				


			</div>
			<div class="material-container__row">
				<input id="ack" name="ack" type="text"  required placeholder="Açıklama" style="width: 100%" class="material-container__input" />
					
			</div>

			<div class="material-container__row fatura_row item">
				<div class="fatura_row__genel-bilgi">
				<!--	<input id="item" type="text" name="item_1"  required placeholder="Ürün/Hizmet #1" class="material-container__input" />-->
					
					
						<select id="item"  name="item_1"  required placeholder="Ürün/Hizmet #1" class="material-container__input" >
									<option value="">Ürün/Hizmet Seçiniz</option>	
			<?php  if( $data["urun_getir"] ) :  foreach( $data["urun_getir"] as $dizi ) :     ?>
			<option value="<?php echo $dizi["id"]; ?>"><?php echo $dizi["adi"]; ?></option>
			<?php  	endforeach;  endif;     ?>
			</select>	
					
					
					<input  id="des" type="text" name="des_1"  placeholder="Açıklama" class="material-container__input" />

				</div>
				<div class="fatura_row__genel-veriler">
					<input id="pr" type="number" name="prc_1"  required min="0" placeholder="Fiyat" class="material-container__input urunInput" />
					<input id="qt" type="number" name="qty_1"  required min="0" placeholder="Miktar" class="material-container__input urunInput" />
					<input id="dis" type="number" name="discount_1"  required min="0" placeholder="İndirim" class="material-container__input urunInput" />
					<input id="tx" type="number" name="tax_1"  min="0" placeholder="Vergi " class="material-container__input urunInput" />
					<span> <span id="tot" class="totalSpan total_1">0.00</span></span>
					<input id="tot_hidden" type="hidden" name="total_1"/>
					</div>

			</div>
			<div class="material-container__row">
				
				<input type='button' id='add' class="faturaItem faturaItem__add" value='Ürün/Hizmet Ekle' />
				<input type='button' id='del' class="faturaItem faturaItem__del" value='Ürün/Hizmet Sil' />

			</div>
		
			<div class="faturaSonuc">

				
				<div class="faturaSonuc__row">
					<span class="faturaSonuc__title">Ara Toplam </span>
					<span class="faturaSonuc__number ara_toplam">0.00</span>
				</div>
				<div class="faturaSonuc__row">
					<span class="faturaSonuc__title">İndirim </span>
					<span class="faturaSonuc__number indirim">0.00</span>
				</div>
				<div class="faturaSonuc__row">
					<span class="faturaSonuc__title">Vergi </span>
					<span class="faturaSonuc__number vergi">0.00</span>
				</div>
				<div class="faturaSonuc__row">
					<span class="faturaSonuc__title">Toplam </span>
					<span class="faturaSonuc__number toplam">0.00</span>
				</div>

				<input id="ara_toplam" type="hidden" name="ara_toplam" />
				<input id="indirim" type="hidden" name="indirim" />
				<input id="vergi" type="hidden" name="vergi" />
				<input id="toplam" type="hidden" name="toplam" >
				<input id="top_alan" type="hidden" name="top_alan" />

			</div>

			<div class="faturaGonder">
				<input type="submit" value="Faturayı Kaydet" class="flex-right">
			</div>


		</div>






	</form>
</body>







<?php  $this->load->view('footer_ozel.php'); ?>
<script 
src="<?php echo base_url('assets/grocery_crud/js/jquery_plugins/ui') ?>/jquery-ui-1.10.3.custom.min.js">
</script>

<script>

	$(document).ready(function() { 

		$('.datepicker').datepicker();

			$('body').on('keyup change', '.urunInput', function() {
				var 
				itemsLength = $('.item').length,
				aratoplam	= Number(0),
				indirim		= Number(0),
				vergi			= Number(0),
				toplam		= Number(0);



				
				for(var n=1; n <= itemsLength; n++ ){


					var 
					prc			= Number($("input[name*='prc_"+n+"']").val()),
					qty			= Number($("input[name*='qty_"+n+"']").val()),
					tax			= Number($("input[name*='tax_"+n+"']").val()),
					dis			= Number($("input[name*='discount_"+n+"']").val());
					

					var 
					total			= prc * qty,
					aratoplam	= aratoplam + total;

					var 
					dis_amount	= total / 100,
					dis_amount	= dis_amount * dis;
					indirim = indirim + dis_amount;

					total = total - dis_amount;	

					var 
					tax_amount = total / 100,
					tax_amount = tax_amount * tax;
					vergi = vergi + tax_amount;

					total = total + tax_amount;
					toplam = toplam + total;

					$(".total_" + n).text(total.toFixed(2));
					$("input[name*='total_"+n+"']").val(total.toFixed(2));


					$(".indirim").text(indirim.toFixed(2));
					$(".vergi").text(vergi.toFixed(2));
					$(".toplam").text(toplam.toFixed(2));
					$(".ara_toplam").text(aratoplam.toFixed(2));

					$("#indirim").val(indirim.toFixed(2));
					$("#vergi").val(vergi.toFixed(2));
					$("#toplam").val(toplam.toFixed(2));
					$("#ara_toplam").val(aratoplam.toFixed(2));
					
					
					$("#top_alan").val(itemsLength);					

				}




		});

	}); 




	$('#add').click(function () {
		var 
		n		= $('.item').length + 1,
		temp	= $('.item:first').clone();

		$('input:first', temp).attr('placeholder', 'Ürün/Hizmet #' + n);


		/*$('#des', temp).attr('placeholder', 'Açıklama #' + n);
		$('#pr', temp).attr('placeholder', 'Fiyat #' + n);
		$('#qt', temp).attr('placeholder', 'Miktar #' + n);
		$('#tx', temp).attr('placeholder', 'Vergi & #' + n);
		$('#dis', temp).attr('placeholder', 'İndirim #' + n);
		$('#tot', temp).attr('placeholder', 'Toplam #' + n);*/

		$('#des', temp).attr({
			'placeholder': 'Açıklama #' + n,
			'name': 'des_' + n
		}).val('');

		$('#pr', temp).attr({
			'placeholder': 'Fiyat #' + n,
			'name': 'prc_' + n
		}).val('');

		$('#qt', temp).attr({
			'placeholder': 'Miktar #' + n,
			'name': 'qty_' + n
		}).val('');

		$('#tx', temp).attr({
			'placeholder': 'Vergi & #' + n,
			'name': 'tax_' + n
		}).val('');


		$('#dis', temp).attr({
			'placeholder': 'İndirim #' + n,
			'name': 'discount_' + n
		}).val('');


		$('#tot', temp).attr('class', 'totalSpan total_' + n).text('0.00');

		$('#tot_hidden', temp).attr('name', 'total_' + n).val(0.00);

		$('#item', temp).attr('name', 'item_' + n).val('');

		/*$('#des', temp).attr('name', 'des_' + n).val('');
		$('#pr', temp).attr('name', 'prc_' + n).val('');
		$('#qt', temp).attr('name', 'qty_' + n).val('');
		$('#tx', temp).attr('name', 'tax_' + n).val('');
		$('#dis', temp).attr('name', 'discount_' + n).val('');
		$('#tot', temp).attr('name', 'total_' + n).val('');*/




		$('.item:last').after(temp);
					$("#top_alan").text(n);	

	});
/*
	function hesapla (){
		items();
		totals();
	}

	function items (){

		var uzunluk = $('.item').length;
		//alert(uzunluk);
	
	
	for(var n=1; n<=uzunluk; n++ ){

		var prc = Number($("input[name*='prc_"+n+"']").val());
		var qty = Number($("input[name*='qty_"+n+"']").val());
		var tax = Number($("input[name*='tax_"+n+"']").val());	
		var dis = Number($("input[name*='discount_"+n+"']").val());	



		var total = prc * qty ;

		var dis_amount = total / 100;
		dis_amount = dis_amount * dis;

		total = total - dis_amount;	

		var tax_amount = total / 100;
		tax_amount = tax_amount * tax;


		total = total + tax_amount;

		$("input[name*='total_"+n+"']").val(total.toFixed(2));	


	}

}

function totals (){
	
	

	var 
	uzunluk		= $('.item').length;
	aratoplam	= Number(0),
	indirim		= Number(0),
	vergi			= Number(0),
	toplam		= Number(0);
	
	for(var n=1; n<=uzunluk; n++ ){

		var prc = Number($("input[name*='prc_"+n+"']").val());
		var qty = Number($("input[name*='qty_"+n+"']").val());
		var tax = Number($("input[name*='tax_"+n+"']").val());	
		var dis = Number($("input[name*='discount_"+n+"']").val());	


		var total = prc * qty ;		
		aratoplam = aratoplam + total;


		var dis_amount = total / 100;
		dis_amount = dis_amount * dis;
		indirim = indirim + dis_amount;

		total = total - dis_amount;		

		var tax_amount = total / 100;
		tax_amount = tax_amount * tax;	
		vergi = vergi + tax_amount;

		total = total + tax_amount;	

		toplam = toplam + total;



	}
	
	// alert(aratoplam);
	//sayi.toFixed(2);
	
	$("input[name*='indirim']").val(indirim.toFixed(2));
	$("input[name*='vergi']").val(vergi.toFixed(2));
	$("input[name*='toplam']").val(toplam.toFixed(2));
	$("input[name*='ara_toplam']").val(aratoplam.toFixed(2));
}

*/

$('#del').click(function () {
	var n = $('.item').length;
	if(n!=1){$('.item:last').remove();
		$("#top_alan").text(n);	
}

});



</script>