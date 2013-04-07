<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Test</title> 

<link href='http://fonts.googleapis.com/css?family=Gilda+Display|Stalemate|Poiret+One|Patrick+Hand+SC|Source+Code+Pro|Cousine|Jura|Metamorphous|Cinzel+Decorative' rel='stylesheet' type='text/css'> 
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
<script src="/js/knockout.js"></script> 
<link href="/css/style.css" rel="stylesheet" media="screen">


<!----------gauges------>
<script src="/js/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>   
<script src="http://code.highcharts.com/modules/exporting.js"></script>



  
</head>
<body style="serif; background-image: url(../img/texture_grain.png)"> 
total activos: <span data-bind="text:totalActivos"></span><br> 
id ultimo post en lista de post: <span data-bind="text:lastId"></span><br> 
nada en ventana post, numero en ventana reply: <span data-bind="text:postView"></span><br> 
formulario post: <span data-bind="text:formPostView"></span><br> 
formulario regiser:<span data-bind="text:formRegisterView"></span><br> 
nombre ususrio: <span data-bind="text:self.name"></span><br> 


<div id="all" class="shadows round4 white">    
<div id="top" style="width:100%">
<div id="topA"><img  src="../img/logo.png" alt="financoach_logo" class="center" ></div>
<div id="topB" class="gray roundTopRight" style="min-height:112px;position:relative"> 


<img class="thumb center"  data-bind = "attr: {'src': src() ? src : '../img/no-profile.jpg'}" onClick="$('#uploadimage').css({display: 'block'});" style="cursor: pointer;
position: absolute;
top: 10px;
left: 14px;"/>  


<div>  
<div data-bind="liveEditor: name" text-transform: capitalize;
margin: 0px;
position: absolute;
left: 85px;
top: 35px;>
    <span class="view"><h5 data-bind="click: name.edit, text: name() ? name : 'Ingresa tu nombre' " style="text-transform:capitalize;"></h5></span>
    <input class="edit" data-bind="
         value: name, 
        enterKey: name.stopEditing, 
        selectAndFocus: name.editing, 
        event: { blur: name.stopEditing }
    " />
     </div>   
     <div><span data-bind="text : role" style="text-transform: capitalize;
position: absolute;
top: 17px;
left: 85px;"></span></div>

   
<button class="btn btn-mini btn-primary" type="button" onclick="location.href='/api/logout'" style="position: absolute;
bottom: 10px;
right: 5px;">logout</button> 
</div>
<div id="uploadimage" style="display:none">
<input  type="file"  multiple data-bind=" event:{change: imageUpload}" /> 
</div>
 
<!---------end topB------> 
</div> 
</div><!----[]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]--->





<div id="content" style="border-top: 1px solid #EEE;float: left;width: 100%;">

<!--
<input data-bind="value: formRegisterView"/></p>

<a href="#" data-bind="click:sort">click sort</a>-->
<div id="contentA" > 
<div style="border-bottom: 1px solid #EEE;float: left;width: 100%;">
 <h4 class="center" style="width:63%">
          <a  data-bind="click: function() {$root.navegateDate('left'); }" 
          style="float:left;cursor:pointer"><i class="icon-arrow-left "></i></a>
           
          <span data-bind="text: NombreMes(month())+'&nbsp;'" style="float:left;"></span>
          <span data-bind="text:year()+'&nbsp;'" style="float:left;"></span> 
          <a  data-bind="click: function() {$root.navegateDate('right'); }" 
          style="float:left;cursor:pointer"><i class="icon-arrow-right "></i></a>
          </h4>
</div>
<div id="contentA1" >

<div data-bind="visible: !type()">
    <div id="cubeA" class="round4">
        <a  data-bind="click: function() {$root.type('Ingresos'); }" 
        style="float:right;cursor:pointer"><i class="icon-list-alt "></i></a>
        <h4>Ingresos</h4>
        Total:<b data-bind="text:numberWithCommas(totalIngresos()) "></b> 
    </div>
    <div id="cubeB" class="round4"> 
        <a  data-bind="click: function() { $root.type('Egresos'); }" 
        style="float:right;cursor:pointer"><i class="icon-list-alt "></i></a>
        <h4>Egresos</h4>
        Total:<b data-bind="text:numberWithCommas(totalEgresos())"></b>
    </div>
    <div id="cubeC" class="round4">
        <a  data-bind="click: function() { $root.type('Activos'); }" 
        style="float:right;cursor:pointer"><i class="icon-list-alt "></i></a>
        <h4>Activos</h4>
        Total:<b data-bind="text:numberWithCommas(totalActivos()) "></b>
    </div>
    <div id="cubeD" class="round4"> 
        <a  data-bind="click: function() {$root.type('Pasivos');}" 
        style="float:right;cursor:pointer"><i class="icon-list-alt "></i></a>
        <h4>Pasivos</h4>
        Total:<b data-bind="text:numberWithCommas(totalPasivos()) "></b>
    </div> 
</div> 
 

 
<div data-bind="visible: type()">  
  
    <div style="width:100%;float:left;" class="round4 shadows"> 
      <div data-bind="style: { backgroundColor: typeColor() }" 
      style="width:94%;float:left; margin:1%;padding:2%;" class="round4">
      <div style="width:100%; float:left">
          <a data-bind="click: function() {$root.type('');formRegisterView('');}" 
          style="float:right; cursor:pointer;"><i class="icon-remove"></i></a>
      </div>
          <h4 class="center">

          <span data-bind="text:type()" style="float:left;"></span>  
          
          </h4>
      </div>
      <div style="width:98%;float:left;margin:1%" class="">
          <table class="table"  style="font-size:12px;width:100%;text-align:center"> 
          <tr class="hidden-phone">
              <th scope="col">&nbsp;</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Categoría</th>
              <th scope="col">Sub-Categoría</th>
              <th scope="col">Valor</th>
          </tr>
          <tbody class="visible-phone" data-bind="template: { name: 'registers-template',foreach: filteredItems,
          visible: filteredItems().length > 0}" style="width: 100%;"></tbody>
         
          <tbody style="background-color: rgb(236, 236, 236);" class="hidden-phone" data-bind="template: { name: 'registers-templatex',foreach: filteredItems,
          visible: filteredItems().length > 0}" style="width: 100%;"></tbody>

         
         <tbody class="hidden-phone" style="width: 100%;">
         <tr>
              <td style=" text-align:right;" colspan="4"><h5>Total</h5></td>
              <td  >
              <h5 data-bind="visible: type()=='Activos',text: numberWithCommas(totalActivos()) "></h5>
              <h5 data-bind="visible: type()=='Pasivos',text: numberWithCommas(totalPasivos()) "></h5>
              <h5 data-bind="visible: type()=='Ingresos',text: numberWithCommas(totalIngresos()) "></h5>
              <h5 data-bind="visible: type()=='Egresos',text: numberWithCommas(totalEgresos()) "></h5>
              </td>
          </tr> 
          </tbody> 
 
           <tbody  class="visible-phone" style="width: 100%;">
           <tr>
              <td><h5>Total</h5></td>
              <td  style=" text-align:right;">
              <h5 data-bind="visible: type()=='Activos',text: numberWithCommas(totalActivos()) "></h5>
              <h5 data-bind="visible: type()=='Pasivos',text: numberWithCommas(totalPasivos()) "></h5>
              <h5 data-bind="visible: type()=='Ingresos',text: numberWithCommas(totalIngresos()) "></h5>
              <h5 data-bind="visible: type()=='Egresos',text: numberWithCommas(totalEgresos()) "></h5>
              </td>
          </tr>
  </tbody>
          </table>
      </div> 
 
   
<!------- F O R M   N U E V O   R E G I S T R O----->
 <button data-bind="visible: !formRegisterView(),click:function(){formRegisterView('1')}" class="btn btn-mini btn-primary" type="button"  style="float:right;margin: -20px 5px 16px 5px;">Nuevo Monto</button> 
 
<div data-bind=" visible:formRegisterView()" class="round4" 
style="width:95%;float:left; margin:2% 1% 1% 1%;padding:3% 1% 1% 1%;display:none;border: 1px #ddd solid"> 
    <div style="float:left; width:100%;">
        <a data-bind="click:function(){formRegisterView('')}" 
        style="float:right; cursor:pointer;"><i class="icon-remove"></i></a>
    </div>
    <form class="form-horizontal">
        <input class="center" type="number" min="0" step="1000" id="inputValue" placeholder="Monto $" 
        style="min-width:140px; width:60%;display: block;clear:left"> 
        <input class="center" type="text" id="inputDescription" placeholder="Descripción" 
        style="min-width:140px; width:60%;display: block;">
        <input class="center" type="text" id="inputCategory1" placeholder="Categoría" 
        style="min-width:140px; width:60%;display: block;">
        <input class="center" type="text" id="inputCategory2" placeholder="SubCategoría" 
        style="min-width:140px; width:60%;display: block;">
        <div style="float:left; margin: 3% 1% 1% 1%; width:98%;">
            <button type="submit" data-bind="click: addRegister" class="btn btn-mini btn-primary" 
            style="float:right">Subir</button>    
        </div>
    </form> 
</div> 
<!------- E N D  F O R M   N U E V O   R E G I S T R O----->
</div>
</div><!---end visible type--> 

​<div data-bind="visible: !type() || type()=='Ingresos' || type()=='Egresos'" id="grafico1" style="min-width: 200px;width:100%; height: 200px; float:left;margin-top: 34px;"></div>
<div  data-bind="visible: !type() || type()=='Activos' || type()=='Pasivos'" id="grafico2" style="min-width: 200px;width:100%; height: 200px; float:left;margin-top: 5px;"></div>
 
</div><!---end content A1-->  
<div id="contentA2">
<div style="width:100%; float:left;margin-left: 10%;">
<h4>Exedentes: <span data-bind="{text: '$'+numberWithCommas(exedentes()),style:{color:masMenos(exedentes())}}"></span> </h4>
</div> 
<div style="width:100%; float:left;margin-left: 10%;">
<h4>Patrimonio: <span data-bind="{text:'$'+numberWithCommas(patrimonio()),style:{color:masMenos(patrimonio())}}""></span> </h4>
</div>

   
<div id="gauge1" style="width: 50%;float: left;"></div>
<div id="gauge2" style="width: 50%;float: left;"></div>
<div id="gauge3" style="width: 50%;float: left;"></div>
<div id="gauge4" style="width: 50%;float: left;"></div>
<div id="gauge5" style="width: 50%;float: left;"></div> 
<div id="gauge6" style="width: 50%;float: left;"></div> 

</div>
</div><!---end content A-->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++->
<!-------------------  C O N T E N T    B  --------------------------------------->
<!-------------------------------------------------------------------------------->
<div id="contentB"> 
<!-------------------N U E V O   P O S T--------------------------------------->
<div data-bind="visible: !postView()">
    <div data-bind="visible: !formPostView()">
        <button  class="btn btn-mini btn-primary" type="button" data-bind="click:function(){formPostView('1')}" 
        style="float:right;margin: 10px 10px 0px 0px;">Nuevo Mensaje</button>  
    </div>
    <div data-bind="visible: formPostView()" class="round4 shadows" style="width:92%;float:left; margin:2%;padding:2%;display:none"> 
        <a data-bind="click:function(){formPostView('')}"  
        style="float:right; cursor:pointer;"><i class="icon-remove"></i></a>
        <div  style="width:100%;float:left;">
            <span data-bind ="text: role" class="littleBlueBIG"></span>:
            <span data-bind ="text: name" class="littleBlue"></span>
        </div>
        <div  style="width:100%;float:left;border-top: 1px solid #EEE;">
            <img class="thumbPost"  data-bind = "attr: {'src':src }" style="float:left"/> 
            <input type="hidden" id="inputUser_id"  value="<?php echo($_SESSION['id']);?>">
            <input type="hidden" id="inputReply_id"  value="0">
            <div  data-bind="with: selectedTree">
                <img src="../img/arrow_orange.png" style="width: 40px;margin-top: 20px;float: left;">  
                <img class="thumbPost"  data-bind = "attr: {'src':src }" style="float:left"/> 
            </div>
            <div  style="width:100%;float:left;">
                <select data-bind="options: trees, optionsText: 'name', value: selectedTree, optionsCaption: 'Para...'"
                 style="width:100%;"></select>
                <input type="text" id="inputSubject" placeholder="Subject" style="width:97%;">
                <textarea rows="5"  id="inputText" placeholder="Mensaje" style="width:97%"></textarea>
                <button type="submit" class="btn btn-mini btn-primary"  data-bind="click: function(){addPost('New')}" 
                style="float:right">Enviar</button>
            </div>
       </div> 
   </div><!--E N D  data-bind="visible: formPostView()"---------------------------------->
</div><!---- E N D data-bind="visible: postView"--------------->


<!-----------------L I S T A   P O S T------------------------------------->  
      <div data-bind="visible: postView()"> 
          <div class="round4 shadows" style="width:96%;float:left; margin:1%;padding:1%;"> 
              <div data-bind="template: { name: 'person-template2',foreach: replys, visible: replys().length > 0}"></div>
          </div>
      </div>
         
      <div data-bind="visible: !postView()">
          <div data-bind="template: { name: 'person-template',foreach: posts, visible: posts().length > 0 }"></div>
      </div>
 <!-----------------form REply------------------------------------------>   
<div class="round4 shadows" style="width:92%;float:left; margin:2%;padding:2%;" data-bind="visible: postView()">
  <div  style="width:100%;float:left;">
      <span data-bind ="text: role" class="littleBlueBIG"></span>:
      <span data-bind ="text: name" class="littleBlue"></span>
  </div>
  <div  style="width:100%;float:left;border-top: 1px solid #EEE;">
      <img class="thumbPost"  data-bind = "attr: {'src':src }" style="float:left"/> 
      <div  style="width:100%;float:left;">
        <textarea rows="5"  id="inputReply"  placeholder="Mensaje" style="width:97%"></textarea>
        <button type="submit" class="btn btn-mini btn-primary" data-bind="click: function(){addPost('Reply')}"  
        style="float:right">Responder</button>
      </div>
  </div>
</div> 
    
    
    
    

</div><!-----E N D  C O N T E N B------->




</div> 
</div><!--content---->





</body><!-----END BODY------->
<!------------------------  R E G I S T E R S    T E M P L A T E S ----------------------------------->
<script type="text/html" id="registers-template">

    <tr>
    <td colspan="2">
	<a data-bind="click: $parent.deleteRegister" style="float:right; cursor:pointer;"><i class="icon-remove"></i></a>
	</td>
    </tr>
	
    <tr>
    <td>Valor</td>
    <td>
	<div data-bind="liveEditor: value">
		<span class="view"><span data-bind="click: value.edit, text: numberWithCommas(value()) || '0' "></span></span>
		<input class="edit" style="width:200px"  
		data-bind="value: value, enterKey: value.stopEditing, selectAndFocus: value.editing, event: { blur: value.stopEditing } " />
    </div>
	</td>
    </tr>
	
    <tr>
    <td>Descripción</td>
    <td><div data-bind="liveEditor: description">
		<span class="view"><span data-bind="click: description.edit, text: description() || 'no ingresada'"></span></span>
		<input class="edit" style="width:200px"  
		data-bind="value: description, enterKey: description.stopEditing, selectAndFocus: description.editing, event: { blur: description.stopEditing } " />
    </div> 
	</td>
  </tr>
  <tr>
    <td>Cat1</td>
    <td><div data-bind="liveEditor: category1">
		<span class="view"><span data-bind="click: category1.edit, text: category1() || 'no ingresada'"></span></span>
		<input class="edit" style="width:200px"  
		data-bind="value: category1, enterKey: category1.stopEditing, selectAndFocus: category1.editing, event: { blur: category1.stopEditing } " />
    </div></td>
  </tr>
  <tr>
    <td>Cat2</td>
    <td><div data-bind="liveEditor: category2">
		<span class="view"><span data-bind="click: category2.edit, text: category2() || 'no ingresada' "></span></span>
		<input class="edit" style="width:200px"  
		data-bind="value: category2, enterKey: category2.stopEditing, selectAndFocus: category2.editing, event: { blur: category2.stopEditing } " /> 
    </div></td> 
  </tr>



</script>
<script type="text/html" id="registers-templatex">
<tr style="cursor:pointer"> 
    <td><a data-bind="click: $parent.deleteRegister" style="float:right; cursor:pointer;"><i class="icon-remove"></i></a></td>
     <td>
	<div  data-bind="liveEditor: description">
		<span class="view" data-bind="click: description.edit">
		<span data-bind=" text: description() || 'no ingresada'"></span>
        </span>
		<span class="edit">
		<input style="width:97%"  
		data-bind="value: description,  selectAndFocus: description.editing" />
        <i class="icon-ok-sign" data-bind="click:description.stopEditing"></i>
		</span>
    </div> 
	</td>
    <td>
	<div data-bind="liveEditor: category1">
		<span class="view" data-bind="click: category1.edit">
		<span data-bind=" text: category1() || 'no ingresada'"></span>
		</span>
		<span class="edit">
		<input  style="width:97%"  
		data-bind="value: category1, selectAndFocus: category1.editing" />
		 <i class="icon-ok-sign" data-bind="click:category1.stopEditing"></i>
		</span>
    </div>
	</td>
     <td>
	<div data-bind="liveEditor: category2">
		<span class="view" data-bind="click: category2.edit">
		<span data-bind=" text: category2() || 'no ingresada'"></span>
		</span>
		<span class="edit">
		<input  style="width:97%"  
		data-bind="value: category2, selectAndFocus: category2.editing" />
		 <i class="icon-ok-sign" data-bind="click:category2.stopEditing"></i>
		</span>
    </div>
	</td>
	    <td>
	<div data-bind="liveEditor: value">
		<span class="view" data-bind="click: value.edit">
		<span data-bind=" text: value() || 'no ingresada'"></span>
		</span>
		<span class="edit">
		<input  style="width:97%"  
		data-bind="value: value, selectAndFocus: value.editing" />
		 <i class="icon-ok-sign" data-bind="click:value.stopEditing"></i>
		</span>
    </div>
	</td>
   
  </tr>
 
</script>
<!------------------------ P E R S O N S   T E M P L A T E S ----------------------------------->
<script type="text/html" id="person-template">
<div class="round4 shadows" style="width:92%;float:left; margin:2%;padding:2%;"> 
	<div  style="width:90%;float:left;">
		<span data-bind ="text: subject" class="littleBlueBIG" style="margin-left:10px;text-transform:capitalize;"></span>
	</div>
            
	<div style="width:9%;float:left;border-left: 1px solid #EEE;">
		<img data-bind="click: $root.loadReplys"  src="/img/blueArrowRight.gif" style=" float:right; padding-right:10px;cursor:pointer;width:15px;height:15px"> 
	</div>
	
	<div style="width:100%;float:left;border-top: 1px solid #EEE;">
		<span data-bind ="text: role" class="littleBlueBIG"></span>:
		<span data-bind ="text: name" class="littleBlue"></span>
	</div>
	
	<div  style="width:100%;float:left;">
		  <img class="thumbPost"  data-bind = "attr: {'src':src }" style="float:left"/> 
		  <div data-bind=" text: text" style="padding:10px 10px 10px 10px; text-align:left;text-align: justify;text-justify: newspaper;"></div>
		  <span data-bind ="text: timeAgo" class="littleBlue" style="float:right; padding-right:5px;"></span>
	</div>
</div>
</script>	
<!------------------------T E M P L A T E S 2 ----------------------------------->

<script type="text/html" id="person-template2">

<div  style="width:90%;float:left;"><!-----body--->
	    
        <div data-bind="if: reply_id()==0"><!-----cabeza----->
        <div  style="width:9%;float:left;">
		<img data-bind="click:$root.loadPosts"  src="/img/blueArrowLeft.gif" width="15px" style=" float:right; padding-right:10px;cursor:pointer;width:15px;height:15px"> 
		</div>
        
            <div  style="width:90%;float:left;border-left: 1px solid #EEE;">
       <span data-bind ="text: subject" class="littleBlueTittle" style="margin-left:10px;text-transform:capitalize;"></span>
            </div>
  
            
		</div><!-----cabeza----->
		
		
		 
</div>
         <!-----texto----->
<div  style="width:100%;float:left;border-top: 1px solid #EEE;">
            <div style="width:100%;float:left;">
			<span data-bind ="text: role" class="littleBlueBIG" style="float:left; margin-right:10px;"></span>:
            <span data-bind ="text: name" class="littleBlue" style="float:left;"></span></div>
		<img class="thumbPost"  data-bind = "attr: {'src':src }" style="float:left;clear:left"/> 
		<div data-bind=" text: text" style="padding:36px 10px 10px 10px; text-align:left;text-align: justify;text-justify: newspaper;"></div>
        <span data-bind ="text: timeAgo" class="littleBlue" style="float:right; padding-right:5px;"></span>
</div> <!-----end texto--->
</script>

<script>
var user_id=<?php echo($_SESSION['id']);?>

</script>
<script src="/js/gauges.js"></script>
<script src="/js/main.js"></script>

<script>
</script>

</html>