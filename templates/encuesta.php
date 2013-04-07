<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>FinanCoach</title>


<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
<script src="/js/knockout.js"></script> 
<link href="/css/style.css" rel="stylesheet" media="screen">
<!-- Bootstrap -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/css/bootstrap-responsive.css" rel="stylesheet">
<script src="/js/bootstrap.min.js"></script>
<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">

<!----------gauges------>
<script src="/js/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
  
</head>
<body>
<!---------------B O D Y------------------------------------->
<div style="float:left; position:fixed; width:300px; padding:10px" >
    <div class="round4 shadows" style="float: left;width: 100%;" > 
    <div style="position: relative;text-align: center;z-index: 20;top: 90px;">Tu puntuacion es de:
    <span data-bind="text: total"> </span><br>
    </div>
    <div style="position: relative;z-index: 20;top: 270px;text-align: center;">
    <span data-bind="text: respuesta"> </span>
    </div>
    <div id="gaugeEncuesta" style="width: 100%;height: 100%;float: left;"></div>
    </div>
</div>    
<div style=" padding-left:300px; float:left">
<div id="contact" class="round4 shadows pregunta"> 
    <p class="littleBlueBIG">1. ¿Cuántas horas a la semana trabajas para generar tus ingresos?</p>
    <div><input type="radio" name="1" value="30" data-bind="checked: pregunta1" /> a) Menos de 20 horas a la semana.</div>
    <div><input type="radio" name="1" value="20" data-bind="checked: pregunta1" /> b) Entre 20 y 30 horas a la semana.</div>
    <div><input type="radio" name="1" value="10" data-bind="checked: pregunta1" /> c) Entre 30 y 40 horas a la semana.</div>
    <div><input type="radio" name="1" value="0" data-bind="checked: pregunta1" /> d) Más de 40 horas a la semana.</div>
    </div>
    <br>
  <div id="contact" class="round4 shadows pregunta">  
    <p class="littleBlueBIG">2. Respecto a tu trabajo ¿Cuál de las siguientes frases te interpreta mejor?</p>
    <div><input type="radio" name="2" value="30" data-bind="checked: pregunta2" /> a) Trabajo en lo que amo. Me llena de satisfacción mi actividad y me siento bien
pagado.</div>
    <div><input type="radio" name="2" value="20" data-bind="checked: pregunta2" /> b) Me gusta mucho lo que hago, pero no estoy totalmente a gusto. No estoy bien
remunerado, no me siento seguro.</div>
    <div><input type="radio" name="2" value="10" data-bind="checked: pregunta2" /> c) No me gusta mucho lo que hago, pero pagan bien y tengo seguridad. Si pudiera
me dedicaría a otra cosa.</div>
    <div><input type="radio" name="2" value="0" data-bind="checked: pregunta2" /> d) Me siento absolutamente frustrado con mi trabajo. No me gusta lo que hago y
además la paga es mala. Estoy aquí porque no veo más oportunidades.</div>
     </div>
     <br>
     
     
  <div id="contact" class="round4 shadows pregunta">  
      <p class="littleBlueBIG">3. Si mantienes reservas de dinero ¿Cuántos meses de tus gastos totales podrían
cubrir si no tuvieras ingresos por un tiempo?</p>
    <div><input type="radio" name="3" value="30" data-bind="checked: pregunta3" /> a) Mis reservas equivalen a más de 12 meses de mis gastos habituales.</div>
    <div><input type="radio" name="3" value="20" data-bind="checked: pregunta3" /> b) Entre 6 y 12 meses.</div>
    <div><input type="radio" name="3" value="10" data-bind="checked: pregunta3" /> c) Entre 2 y 6 meses.</div>
    <div><input type="radio" name="3" value="0" data-bind="checked: pregunta3" /> d) No tengo reservas de dinero.</div>
</div>
    <br>
      <div id="contact" class="round4 shadows pregunta">  
      <p class="littleBlueBIG">4. Si tienes bienes que te produzcan ingresos sin tener que trabajar (Ej. Propiedades
en arriendo, depósitos, pensiones etc.) ¿Qué porcentaje de tus ingresos proviene de
ellos?</p>
    <div><input type="radio" name="4" value="30" data-bind="checked: pregunta4" /> a) Más del 70%</div>
    <div><input type="radio" name="4" value="20" data-bind="checked: pregunta4" /> b) Entre el 30% y el 70%</div>
    <div><input type="radio" name="4" value="10" data-bind="checked: pregunta4" /> c) Entre el 10% y el 30%</div>
    <div><input type="radio" name="4" value="0" data-bind="checked: pregunta4" /> d) Mis bienes no producen no me producen ingresos</div>
</div>
    <br>
      <div id="contact" class="round4 shadows pregunta">  
      <p class="littleBlueBIG">5. Cada fin de mes, después de pagar tus gastos habituales y tus compromisos ¿tiene excedente de dinero que guardas o de los cuales puedes disponer libremente?</p>
    <div><input type="radio" name="5" value="0" data-bind="checked: pregunta5" /> a) Tengo excedentes de dinero todos los meses.</div>
    <div><input type="radio" name="5" value="10" data-bind="checked: pregunta5" /> b) A veces tengo excedentes, pero generalmente estoy “al justo”.</div>
    <div><input type="radio" name="5" value="-50" data-bind="checked: pregunta5" /> c) Tengo Déficit de dinero todos los meses (no llego a fin de mes).</div>
    </div>
    <br>
      <div id="pregunta6" class="round4 shadows pregunta" >  
      <p class=" littleBlueBIG">6. ¿Qué porcentaje de tus ingresos quedan como excedentes?</p>
    <div><input type="radio" name="6" value="60" data-bind="checked: pregunta6" /> a) Más del 50%.</div>
    <div><input type="radio" name="6" value="40" data-bind="checked: pregunta6" /> b) Entre el 30% y 50%.</div>
    <div><input type="radio" name="6" value="20" data-bind="checked: pregunta6" /> c) Entre el 20% y el 30%.</div>
    <div><input type="radio" name="6" value="10" data-bind="checked: pregunta6" /> d) Entre el 10% y el 20%.</div>
    </div>
</div> 
</body><!-----END BODY------->


<script>
$(function()
{
     $("a#toggle").click(function()
     {
         $("#contact").slideToggle('slow', function() {
    // Animation complete.
  });
         return false;
     }); 

});

chart7 = new Highcharts.Chart({
 chart: {
	renderTo: 'gaugeEncuesta',
	type: 'gauge',
	plotBorderWidth: 0,
	plotBackgroundImage: null,
	height: 300,
	width:300,
	backgroundColor: 'white',
	borderColor: 'white',
	borderWidth: 2,
	plotBackgroundColor:'white',
	plotShadow:true
},

title: {
	text: 'Zonas Financieras',
	style: {
                color: '#FF00FF',
                fontWeight: 'bold'
            }
},

pane: [{
	startAngle: -90,
	endAngle: 90,
	background: null, 
	center: ['50%', '80%'],
	size: 160
}],                        

yAxis: [{ 
	min: 0,
	max: 180,
    plotBands: [{
		from: 0,
		to: 59.9,
		color: 'red',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 60,
		to: 119.9,
		color: '#0C0',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 120,
		to: 180,
		color: '#0CF',
	    innerRadius: '100%',
		outerRadius: '160%'
	}],
	//pane: 0
}],

plotOptions: {
	gauge: {
		dataLabels: {
			enabled: false,
			borderWidth:0,
			formatter: function() {
					return this.y.toFixed(0);  
                    }
		}
	}
},

 credits: {enabled: false},
	

series: [{data: [0],yAxis: 0}]


});
var encuestaModel = function() {
	 var self = this;
     self.pregunta1= ko.observable();
	 self.pregunta2= ko.observable();
	 self.pregunta3= ko.observable();
	 self.pregunta4= ko.observable();
	 self.pregunta5= ko.observable();
	 self.pregunta6= ko.observable();
     self.total = ko.computed(function() {
	   if(self.pregunta5()=='0'){ $("#pregunta6").show();
	   }else{$("#pregunta6").hide();self.pregunta6(null);}
	   var total=0;
       if(self.pregunta1()!=null){total+=parseInt(self.pregunta1());}
	   if(self.pregunta2()!=null){total+=parseInt(self.pregunta2());}
	   if(self.pregunta3()!=null){total+=parseInt(self.pregunta3());}
	   if(self.pregunta4()!=null){total+=parseInt(self.pregunta4());}
	   if(self.pregunta5()!=null){total+=parseInt(self.pregunta5());}
	   if(self.pregunta6()!=null){total+=parseInt(self.pregunta6());}
	   
	   if(total<0){ chart7.series[0].data[0].update(0);return 0;
	   }else {chart7.series[0].data[0].update(total);return total}
}, self);
     self.respuesta=ko.computed(function() {
		 if (self.total()==0){return ""}
		 else if (self.total()<=60){return "Zona de Estres financiera"}
		 else if (self.total()<=120){return "zona de bienestar financiera"}
		 else{return "zona de libertad financiera"}
		 },self);

};
 
ko.applyBindings(new encuestaModel());




</script>

</html>



