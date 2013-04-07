<!------topB---------->
<button id="nuevoMensaje0" class="btn btn-mini btn-primary" type="button" onclick="nuevoMensaje();" style="float:right;margin: 10px 10px 0px 0px;">Nuevo Mensaje</button> 



<!-------------------N U E V O   P O S T--------------------------------------->
<div id="nuevoMensaje1" class="round4 shadows" style="width:92%;float:left; margin:2%;padding:2%;display:none"> 

<a onClick="nuevoMensajeEnd();" style="float:right; cursor:pointer;"><i class="icon-remove"></i></a>
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
    <select data-bind="options: trees, optionsText: 'name', value: selectedTree, optionsCaption: 'Para...'" style="width:100%;"></select>

      <input type="text" id="inputSubject" placeholder="Subject" style="width:97%;">

      <textarea rows="5"  id="inputText" placeholder="Mensaje" style="width:97%"></textarea>
      <button type="submit" class="btn btn-mini btn-primary" id="loginButton" data-bind="click: addPost" style="float:right">Enviar</button>
</div>



    </div>
</div>
<!-------------------L I S T A   P O S T--------------------------------------->
    <div data-bind="foreach: posts, visible: posts().length > 0">
        <div class="round4 shadows" style="width:92%;float:left; margin:2%;padding:2%;"> 
            <div  style="width:90%;float:left;">
             <span data-bind ="text: role" class="littleBlueBIG"></span>:
              <span data-bind ="text: name" class="littleBlue"></span>
              <span data-bind ="text: timeAgo" class="littleBlue" style="float:right; padding-right:5px;"></span>
            </div>
            
            <div  style="width:9%;float:left;border-left: 1px solid #EEE;">
               <img src="/img/blueArrowRight.gif" width="15px" style=" float:right; padding-right:10px"> 
            </div>
            <div  style="width:100%;float:left;border-top: 1px solid #EEE;">
            <span data-bind ="text: subject" class="littleBlueBIG" style="margin-left:10px;text-transform:capitalize;"></span>
            </div>
            <div  style="width:100%;float:left;">
                <img class="thumbPost"  data-bind = "attr: {'src':src }" style="float:left"/> 
    <div data-bind=" text: text" style="padding:10px 10px 10px 10px; text-align:left;text-align: justify;text-justify: newspaper;"></div>
            </div>
            
        </div>
    </div>