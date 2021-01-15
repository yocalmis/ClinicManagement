<?php  $this->load->view('header_ozel.php'); ?>	
<div class="heading">
	<h2>GENEL GÖRÜNÜM</h2>
	Tarih: <?php echo $data[ 'bas' ]; ?> - <?php echo $data[ 'bit' ]; ?>
	<p class="divider"></p>
</div>


<div class="main-content">

<form action="<?php echo base_url(); ?>yonetim/genel_rapor" method="post">
<input type="date" name="t1" placeholder="Başlangıç Tarihi">
<input type="date" name="t2" placeholder="Bitiş Tarihi">
<input type="submit" Value="Getir">
</form>
<br>
<!--

<!DOCTYPE html>
<html lang="en-US">
<body>


<div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work', 8],
  ['Eat', 2],
  ['TV', 4],
  ['Gym', 2],
  ['Sleep', 8]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

</body>
</html>

-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<html>
  <head>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)

		
		
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Borç - Alacak', 'Kasa Nakit'],
          ['Tarih Aralığı',  <?php echo $data["durum"]; ?>,      <?php echo $data["kasa"]; ?>]

        ]);

        var options = {
          title : 'Bilanço Özeti',
          vAxis: {title: '<?php echo $data["currency"]; ?>'},
          hAxis: {title: 'Borç/Alacak/Kasa'},
          seriesType: 'bars',
          series: {2: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div2" style="width: 100%;  height: 500px;"></div>
  </body>
</html>












<html>
  <head>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)

		
		
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Gelir', 'Gider', 'Alacaklanan', 'Borçlanılan', 'Tahsilat', 'Ödeme'],
          ['Tarih Aralığı',  <?php echo $data["gelir"]; ?>,      <?php echo $data["gider"]; ?>,         <?php echo $data["satis"]; ?>,            <?php echo $data["alis"]; ?>,           <?php echo $data["tahsilat"]; ?>,      <?php echo $data["odeme"]; ?>]  
		  
        ]);

        var options = {
          title : 'Dönemsel Özet Tablosu',
          vAxis: {title: '<?php echo $data["currency"]; ?>'},
          hAxis: {title: 'Tüm Gelir Özeti'},
          seriesType: 'bars',
          series: {6: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>
</html>
















<!--
	<div class="chartGeneralInner">
		<h3 class="chartGeneralInner__title">Son Durum: </h3>
		<article class="charts">

			<div class="chart ">
				<p>
					<strong>Toplam Borç - Alacak :</strong> 
					<span class="sayi"><?php echo $data["toplam_durum"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Kasa Nakit Durumu :</strong> 
					<span class="sayi"><?php echo $data["toplam_durum_kasa"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>

		</article>
	</div>

	<div class="chartGeneralInner">
		<h3 class="chartGeneralInner__title">Bugünün Özeti</h3>
		<article class="charts">
			
			<div class="chart ">
				<p>
					<strong>Alacaklanan :</strong> 
					<span class="sayi"><?php echo $data["bugun_satis"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Borçlanılan :</strong> 
					<span class="sayi"><?php echo $data["bugun_alis"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart  col-md-5">
				<p><strong>Gelir :</strong> <span class="sayi"><?php echo $data["bugun_gelir"]; ?> </span><span class="birim"><?php echo $data["currency"]; ?></span></p>
				<p><strong>Gider :</strong> <span class="sayi"><?php echo $data["bugun_gider"]; ?> </span><span class="birim"><?php echo $data["currency"]; ?></span></p>
			</div>
			<div class="chart  col-md-5">
				<p><strong>Tahsilat :</strong> <span class="sayi"><?php echo $data["bugun_tahsilat"]; ?> </span><span class="birim"><?php echo $data["currency"]; ?></span></p>
				<p><strong>Ödeme :</strong> <span class="sayi"><?php echo $data["bugun_odeme"]; ?> </span><span class="birim"><?php echo $data["currency"]; ?></span></p>
			</div>


		</article>
	</div>
	<div class="chartGeneralInner">
		<h3 class="chartGeneralInner__title">Bu Haftanın Özeti</h3>
		<article class="charts">

			<div class="chart ">
				<p>
					<strong>Alacaklanan :</strong> 
					<span class="sayi"><?php echo $data["buh_satis"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Borçlanılan :</strong> 
					<span class="sayi"><?php echo $data["buh_alis"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart  col-md-5">
				<p>
					<strong>Gelir :</strong> 
					<span class="sayi"><?php echo $data["buh_gelir"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Gider :</strong> 
					<span class="sayi"><?php echo $data["buh_gider"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart  col-md-5">
				<p>
					<strong>Tahsilat :</strong> 
					<span class="sayi"><?php echo $data["buh_tahsilat"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Ödeme :</strong> 
					<span class="sayi"><?php echo $data["buh_odeme"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>


		</article>
	</div>
	<div class="chartGeneralInner">
		<h3 class="chartGeneralInner__title">Bu Ayın Özeti</h3>
		<article class="charts">

			<div class="chart">
				<p>
					<strong>Alacaklanan :</strong> 
					<span class="sayi"><?php echo $data["buay_satis"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Borçlanılan :</strong> 
					<span class="sayi"><?php echo $data["buay_alis"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart">
				<p>
					<strong>Gelir :</strong> 
					<span class="sayi"><?php echo $data["buay_gelir"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Gider :</strong> 
					<span class="sayi"><?php echo $data["buay_gider"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart  col-md-5">
				<p>
					<strong>Tahsilat :</strong> 
					<span class="sayi"><?php echo $data["buay_tahsilat"]; ?> </span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Ödeme :</strong> 
					<span class="sayi"><?php echo $data["buay_odeme"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>


		</article>
	</div>
	<div class="chartGeneralInner">
		<h3 class="chartGeneralInner__title">Bu Yılın Özeti</h3>
		<article class="charts">

			<div class="chart ">
				<p>
					<strong>Alacaklanan :</strong> 
					<span class="sayi"><?php echo $data["buyil_satis"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Borçlanılan :</strong> 
					<span class="sayi"><?php echo $data["buyil_alis"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart  col-md-5">
				<p>
					<strong>Gelir :</strong> 
					<span class="sayi"><?php echo $data["buyil_gelir"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Gider :</strong> 
					<span class="sayi"><?php echo $data["buyil_gider"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart  col-md-5">
				<p>
					<strong>Tahsilat :</strong> 
					<span class="sayi"><?php echo $data["buyil_tahsilat"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Ödeme :</strong> 
					<span class="sayi"><?php echo $data["buyil_odeme"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>


		</article>
	</div>

	<div class="chartGeneralInner">
		<h3 class="chartGeneralInner__title">Toplam Özet</h3>
		<article class="charts">

			<div class="chart ">
				<p>
					<strong>Alacaklanan :</strong> 
					<span class="sayi"><?php echo $data["toplam_satis"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Borçlanılan :</strong> 
					<span class="sayi"><?php echo $data["toplam_alis"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart  col-md-5">
				<p>
					<strong>Gelir :</strong> 
					<span class="sayi"><?php echo $data["toplam_gelir"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Gider :</strong> 
					<span class="sayi"><?php echo $data["toplam_gider"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>
			<div class="chart  col-md-5">
				<p>
					<strong>Tahsilat :</strong> 
					<span class="sayi"><?php echo $data["toplam_tahsilat"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
				<p>
					<strong>Ödeme :</strong> 
					<span class="sayi"><?php echo $data["toplam_odeme"]; ?></span>
					<span class="birim"><?php echo $data["currency"]; ?></span>
				</p>
			</div>


		</article>
	</div>-->
</div>

<?php  $this->load->view('footer_ozel.php'); ?>	