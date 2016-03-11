<html>
	<head>
		<META name="Content-Type" content="text/html; charset=utf-8">
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Курсовая. Тема:"Прогнозирование случайных процессов"</title>
		<p align="center">Курсовая. Тема:"Прогнозирование случайных процессов"</p>
		<script type="text/JavaScript" src="cw.js">
		</script>
	
	</head>
	<body>
        <form method="GET">
			<div id="form">
				<table>
					<tr><td>Продукты:
					<select id="slct" name="slct">
						<option selected="selected">Выберите продукт</option>
						<option value="meat" id="meat" name="meat">Мясо</option>
						<option value="fish" id="fish" name="fish">Рыба</option>
						<option value="rice" id="rice" name="rice">Рис</option>
					</select></td></tr>
					<tr><td>Коэффициенты:</td></tr>
					<tr><td>k=<input id="k" type="text" name="k" size="15" value="0.3"></td></tr>
					<tr><td>b=<input id="b" type="text" name="b" size="15" value="0.9"></td></tr>
					<tr><td>q=<input id="q" type="text" name="q" size="15" value="0.85"></td></tr>
				</table>
			<input    type="submit" name="submit" text="Отправить"  onClick="func()" >		
			</div>
		</form>
		
		<?php
		ini_set('display_errors','Off');
			error_reporting('E_ALL');
			$k = $_GET['k'];
			$b = $_GET['b'];
			$q = $_GET['q'];
			$slct = $_GET['slct'];
			echo "<p>k = ",$k,"</p>";
			echo "<p>b = ",$b,"</p>";
			echo "<p>q = ",$q,"</p></div>";
			echo "<p>slct = ",$slct,"</p></div>";
			if (!empty($k) && !empty($b)  && !empty($q) && $slct<>null) 
			{
			if  ($slct=="fish") {
				$array_x = file("fish.txt");
				//echo "рыба";
				}
			if  ($slct=="rice") {
				$array_x = file("rice.txt");
				//echo "рис";
				}
			if  ($slct=="meat") {
				$array_x = file("meat.txt"); 
				//echo "мясо";
				}	
				
			$n=count($array_x);
			for ($j=0;$j<=11;$j++) {
			$array_S[$j]=1;
			}
			for ($j=12;$j<=$n-1;$j++){  
				}
			$array_T[0]=0;
			$array_L[0]=$array_x[0];
			for ($i=1;$i<=($n-1);$i++) {
				
				}
			$j=0;
			$p=0;
			for ($i=1;$i<=($n-1);$i++) {	
				//echo " i= ",$i;
				//if ($i<=($n-12)) {
				//echo " j= ",$j++;
					$array_L[$i]=$k*$array_x[$i]/$array_S[$i-1]+(1-$k)*($array_L[$i-1]+$array_T[$i-1]); //рассчитываем экспоненциально-сглаженный ряд
					$array_Y[$i]=$array_L[$i];
					$array_T[$i]=$b*($array_L[$i]-$array_L[$i-1])+(1-$b)*$array_T[$i-1]; //определение значения тренда
					if ($i<=11) {
						$array_S[$i]=$q*$array_x[$i]/$array_L[$i]+(1-$q)*$array_S[0]; //оценка коэффициентов сезонности 
					} 
					if ($i>11) {	$array_S[$i]=$q*$array_x[$i]/$array_L[$i]+(1-$q)*$array_S[$i-12*floor($i/12)];
				
				}
				//}
				
				if ($i>($n-13)) {
					$p++;
					//echo "  p=  ",$p; 
					$array_Y[$i]=($array_x[$i-1]+$p*$array_T[$i-2])*$array_S[$i-12+$p]; //делаем прогноз
					//echo "Y[",$i,"]=   ",$array_Y[$i];
					}
				}
			$z=0;
			for ($i=0;$i<48;$i++) {
					$array_Y[$i]=$array_L[$i];
				}			
			$wr=fopen('prog.txt', 'w+');
			for ($i=0;$i<=47;$i++) {
				//echo "   L=  ",$array_L[$i];
				//$z++;
				fwrite($wr,$array_L[$i]);
				if ($i<>0) {fwrite($wr,"\r\n");}
				}
				//echo "DFDFDF",$z;
			for ($i=48;$i<=($n-1);$i++) {	
			
				fwrite($wr,$array_Y[$i]);
				fwrite($wr,"\r\n");
				}
			fclose($wr);	
			//print_r ($array_L);
		}	
			else if (empty($k) && empty($b) && empty($q) && empty($slct)) {
		echo "<script type='text/JavaScript'>alert('Введите данные!');</script>";
		}
		else {
			 echo "<script type='text/JavaScript'>alert('Неправильно введены данные!');</script>";
			}
		
	
				if  ($slct=="fish") {
				$array_p = file("fish.txt");
				//echo "рыба";
				}
			if  ($slct=="rice") {
				$array_p = file("rice.txt");
				//echo "рис";
				}
			if  ($slct=="meat") {
				$array_p = file("meat.txt"); 
				//echo "мясо";
				}	
	
	for ($i=0;$i<100;$i++) {
	$array_H[$i]=$array_p[$i];
}	
	
	
	// СЧИТАЕМ ТОЧНОСТЬ!!!
	$xq=0;
	$yq=0;
	for ($i=0;$i<60;$i++) {
	$array_W[$i]=$array_p[$i]-$array_Y[$i];
	$xq = pow($array_W[$i],2)/pow($array_p[$i],2);
	$yq=$yq+$xq;
	}
	$v=1-abs($yq/60);
	echo "ТОЧНОСТЬ=",$v;
	
	
	
	
 include("pChart/pData.class");
 include("pChart/pChart.class");
 for ($i=0;$i<60;$i++) {
 
 $array_p[$i] = floatval ($array_p[$i]);
 }
 $DataSet = new pData;
 $DataSet->AddPoint(array($array_L),"Serie1");
 $DataSet->AddPoint(array($array_Y),"Serie2");
 $DataSet->AddPoint(array($array_p),"Serie3");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie();   
 $DataSet->SetSerieName("Экспоненциальносглаженная ","Serie1");   
 $DataSet->SetSerieName("Предсказанные значения","Serie2");   
 $DataSet->SetSerieName("Реальные цены","Serie3");   
 $DataSet->SetYAxisName("Цена на продукт");
 $DataSet->SetYAxisUnit(" руб");
  
 // Initialise the graph   
 $Test = new pChart(1200,500);
 $Test->setFontProperties("Fonts/tahoma.ttf",8);   
 $Test->setGraphArea(70,30,880,400);   
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);   
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);   
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);   
 $Test->drawGrid(4,TRUE,230,230,230,50);
  
 // Draw the 0 line   
 $Test->setFontProperties("Fonts/tahoma.ttf",6);   
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);   
  
 // Draw the line graph
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());   
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),4,1,255,255,255);   
  
 // Finish the graph   
 $Test->setFontProperties("Fonts/tahoma.ttf",8);   
 $Test->drawLegend(75,35,$DataSet->GetDataDescription(),255,255,255);   
 $Test->setFontProperties("Fonts/tahoma.ttf",10);   
 $Test->drawTitle(60,22,"График зависимости цены от месяца",50,50,50,585);   
 unlink('./example2.png');
 $Test->Render("example2.png");
?>
		
		
		
		<img src="example2.png"/>
	</body>
</html>
