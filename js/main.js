/*FUNCIONES*/
function prettyDate(date_str){
	//alert('prettydate');
	var time_formats = [
	[60, 'segundos', 1], // 60
	[120, 'hace un minuto', '1 minute from now'], // 60*2
	[3600, 'minutos', 60], // 60*60, 60
	[7200, 'hace una hora', '1 hour from now'], // 60*60*2
	[86400, 'horas', 3600], // 60*60*24, 60*60
	[172800, 'ayer', 'tomorrow'], // 60*60*24*2
	[604800, 'dias', 86400], // 60*60*24*7, 60*60*24
	[1209600, 'una semana', 'next week'], // 60*60*24*7*4*2
	[2419200, 'semanas', 604800], // 60*60*24*7*4, 60*60*24*7
	[4838400, 'un mes', 'next month'], // 60*60*24*7*4*2
	[29030400, 'meses', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4


	];
	var time = ('' + date_str).replace(/-/g,"/").replace(/[TZ]/g," ").replace(/^\s\s*/, '').replace(/\s\s*$/, '');
	if(time.substr(time.length-4,1)==".") time =time.substr(0,time.length-4);
	var seconds = (new Date - new Date(time)) / 1000;
	var token = 'hace', list_choice = 1;
	if (seconds < 0) {
		seconds = Math.abs(seconds);
		token = 'hace';
		list_choice = 2;
	}
	var i = 0, format;
	while (format = time_formats[i++])
		if (seconds < format[0]) {
			if (typeof format[2] == 'string'){
			   //console.log(format[list_choice]);
				return format[list_choice];}
			else{
			   // console.log(token+' '+Math.floor(seconds / format[2]) + ' ' + format[1]);
				return token+' '+Math.floor(seconds / format[2]) + ' ' + format[1]}
		}
	//console.log(time);	
	return time;};
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");}
function formatMonth(month)  {
	if (month<10){
		return '0'+month;
		}
	return month;}
function NombreMes(month)    { 
	var monthNames = [ "nada","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Augosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ];
    return monthNames[month];}	
function getIndexByX(chart,n){
	
	for (var i=0;i<15;i++){ 
		if(chart.points[i].x==n){return i} 
	}
}
ko.extenders.liveEditor2 = function (target,option) { 
    target.editing = ko.observable(false);//inicializa
    
    target.edit = function () {  
       target.editing(true);
    };
 
    target.stopEditing = function () { 
        target.editing(false);
		switch (option.model){
			case "user": 
			userModel.userEdit(option);
			break;
			case "register": 
			userModel.registerEdit(option);
			break;
			default : alert("I\'m sure it was great");
		}
    };
    return target;
};
	
ko.bindingHandlers.liveEditor = {
    init: function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) { 
	    var observable = valueAccessor();
        observable.extend({ liveEditor2: viewModel });
    },
    update: function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var observable = valueAccessor();
		console.log(observable.editing());
 ko.bindingHandlers.css.update(element, function () { return { editing: observable.editing }; });
 console.log(observable.editing());
    }};	

/*MODELS*/
function tree(data)    { 
	this.name = ko.observable(data.name);
	this.id = ko.observable(data.id);
	this.src= ko.observable(data.src);
	this.role= ko.observable(data.role);}
function register(data){
	var self = this;
	self.model='register';
	this.id=ko.observable(data.id);
	this.description=ko.observable(data.description);
	this.value=ko.observable(data.value);
	this.type=ko.observable(data.type);
	this.category1=ko.observable(data.category1);
	this.category2=ko.observable(data.category2);
	}
function post(data)    {
    var self = this;
	var interval;
	self.model='posts';
	self.id = ko.observable(data.id);//lista cd cds
	self.user_id=   ko.observable(data.user_id);
	self.to_id=   ko.observable(data.to_id);
	self.modified= ko.observable(data.modified);
	self.text= ko.observable(data.text);
	self.subject= ko.observable(data.subject);
	self.name= ko.observable(data.name);
	self.role= ko.observable(data.role);
	self.reply_id= ko.observable(data.reply_id);
	self.src= ko.observable(data.src);
	self.timeAgo= ko.observable();
	this.calltimeAgo = ko.computed(function() {
			  self.timeAgo(prettyDate(self.modified()));  
			  interval=setInterval(function(){self.timeAgo(prettyDate(self.modified()));},10000);  
		  }, this);}


/************* M O D E L  U S E R ********************************************************/
function user() {
    var self = this;
	self.model='user';
	self.id = ko.observable(user_id);
	self.idCoach=ko.observable();
	self.email=ko.observable();
	self.src=ko.observable();
	self.name=ko.observable();
    self.role=ko.observable();
	self.imageUpload=function (element,event) {
		var files =  event.target.files;
		f = files[0];
		if (f.type.match('image.*')) { //si el archivo es una imagen
			var reader = new FileReader();
			reader.onload = (function(theFile) {
				return function(e) { 
					self.src(e.target.result);
					userEdit(self);
				};                            
			})(f);
		    reader.readAsDataURL(f);
		}
	
	};
	self.year=ko.observable(new Date().getFullYear());
	self.month=ko.observable((new Date().getMonth()+1));
	self.navegateDate=function(direction){
		if(direction=="left"){ 
			if(self.month()==1){self.month(12);self.year(self.year()-1);
			}else{self.month(self.month()-1)}   
		}else{
		if(self.month()==12){self.month(1);self.year(self.year()+1);}
		else{self.month(self.month()+1)} 
		}
	}
	self.type=ko.observable();
	self.registers = ko.observableArray([]);
	self.filteredItems = ko.computed(function() {
		var filter = self.type();
		if (!filter) {
			return self.registers();
		} else {
			return ko.utils.arrayFilter(self.registers(), function(item) {
				if (item.type()==filter) {return item;}
			});
		}
	}, self);	
	/*LOAD USER DATA*/
	self.loadUser=ko.computed(function() {
		  //console.log('self.loadUser');
		  $.getJSON('/api/userById/'+self.id(), function(data) {
				self.idCoach(data[0].coach_id);
				self.email(data[0].email);
				self.src(data[0].src);
				self.name(data[0].name);
				self.role(data[0].role);  				
				chart3.series[0].data[0].update(70); 
				self.getIds();//obtienes el array de ids para senders y view posts
		  });
	}, self.id());
    
	/*LOAD TOTAL VALUES*/
	self.totalActivos = ko.computed(function() {
		//console.log('self.totalActivos');
		var total = 0;
		ko.utils.arrayForEach(self.registers(), function(item) {
			var value = parseInt(item.value());
			if (item.type()=="Activos") {total += value;}
		});
		return total; 
	}, self.registers());
    self.totalPasivos = ko.computed(function() {
		//console.log('self.totalPasivos');
	    var total = 0;
	    ko.utils.arrayForEach(self.registers(), function(item) {
		    var value = parseInt(item.value());
		    if (item.type()=="Pasivos") {total += value;}
	    });
	    return total; 
	}, self.registers());
    self.totalIngresos = ko.dependentObservable(function() {
	  var total = 0;
	   ko.utils.arrayForEach(self.registers(), function(item) {
		  var value = parseInt(item.value());
		  if (item.type()=="Ingresos") {
			  total += value;
		  }
	  });
	  return total; 
	  }, self.registers());
    self.totalEgresos = ko.computed(function() {
	  var total = 0;
	   ko.utils.arrayForEach(self.registers(), function(item) {
		  var value = parseInt(item.value());
		  if (item.type()=="Egresos") {
			  total += value;
		  }
	  });
	  return total;  
	  }, self.registers());
    self.exedentes= ko.computed(function() {
	  return self.totalIngresos()-self.totalEgresos();  
	  }, self);
	self.patrimonio= ko.computed(function() {
	  return self.totalActivos()-self.totalPasivos();  
	  }, self);
    self.ilp= ko.computed(function() {
	  var waca=self.exedentes()/self.totalEgresos(); 
	  chart1.series[0].data[0].update(parseFloat(waca));
	  return waca;  
	  }, self);
    self.ila=ko.dependentObservable(function() {
		var total = 0;
		ko.utils.arrayForEach(self.registers(), function(item) {
			var value = parseInt(item.value());
			if (item.type()=="Activos" && item.category1()>7) {total += value;}
		});
		var waca=total/self.totalEgresos(); 
		chart5.series[0].data[0].update(parseFloat(waca));
		return waca 
	}, self);
	/*LOAD LINEAR GRAPH*/
	self.graficos= ko.computed(function() {
		     //var waca=self.registers();

			$.getJSON("/api/getActivesGraf/"+self.id()+"/"+self.year()+'/Activos', function(data) {
			chart8.series[1].setData(data);
			});
			$.getJSON("/api/getActivesGraf/"+self.id()+"/"+self.year()+'/Pasivos', function(data) {
			chart8.series[0].setData(data);
			});
			$.getJSON("/api/getActivesGraf/"+self.id()+"/"+self.year()+'/Ingresos', function(data) {
			chart7.series[1].setData(data);
			});
			$.getJSON("/api/getActivesGraf/"+self.id()+"/"+self.year()+'/Egresos', function(data) {
			chart7.series[0].setData(data);
			});
		 
	  }, self);
	/*UPDATE LINEAR GRAPH BY TYPE WHEN ADD OR DELETE REGISTER*/  
	self.graficosType= function() {
         if(self.type()=="Activos"){
			$.getJSON("/api/getActivesGraf/"+self.id()+"/"+self.year()+'/Activos', function(data) {
			chart8.series[1].setData(data);
			});
		 }else if(self.type()=="Pasivos"){
			$.getJSON("/api/getActivesGraf/"+self.id()+"/"+self.year()+'/Pasivos', function(data) {
			chart8.series[0].setData(data);
			});
		}else if(self.type()=="Ingresos"){
			$.getJSON("/api/getActivesGraf/"+self.id()+"/"+self.year()+'/Ingresos', function(data) {
			chart7.series[1].setData(data);
			});
		}else if(self.type()=="Egresos"){
			$.getJSON("/api/getActivesGraf/"+self.id()+"/"+self.year()+'/Egresos', function(data) {
			chart7.series[0].setData(data);
			});
		}
		 
	  };
	
	/*- R E G I S T E R--------------------------------------------------*/
	self.deleteRegister = function(register) {   
		$.post('/api/deleteRegister',JSON.stringify({id:register.id()}),
		function(data){
		self.registers.remove(register);
				 self.graficosType(); 
		}, "json");
	};
    self.addRegister= function()             {   
		 var formValues = {
			user_id: self.id(),
            type: self.type(),
            description: $('#inputDescription').val(),
			value:$('#inputValue').val(),
			category1:$('#inputCategory1').val(),
			category2:$('#inputCategory2').val(),
			date:self.year()+'-'+formatMonth(self.month())+'-07'  
        }; 
		$.post('/api/addRegister',JSON.stringify(formValues),
		function(data){
			  self.registers.push(new register(data));
			  self.graficosType();
			  self.formRegisterView('');
		}, "json");
    };	
    self.getRegisters=ko.computed(function() {
	    self.registers.removeAll(); 
		$.get('api/getRegisters/'+self.id()+'/'+self.year()+'-'+formatMonth(self.month()),
		function(data){
			  $.map(data, function(item) {self.registers.push(new register(item));}); 
		}, "json");
	
	},self);
	self.registerEdit=function(data){
		 var formValues = {   
		    id:data.id(),
			value:data.value(),
			description:data.description(),
			category1:data.category1(),
			category2:data.category2(),
		};
		$.post('/api/editRegister',JSON.stringify(formValues),
		function(data){
		    if(self.type()=="Ingresos"){
               chart7.series[1].points[getIndexByX(chart7.series[1],self.month()-1)].update({"y":self.totalIngresos()})
            }else if(self.type()=="Egresos"){
				chart7.series[0].points[getIndexByX(chart7.series[0],self.month()-1)].update({"y":self.totalEgresos()})
			}else if(self.type()=="Activos"){
				chart8.series[1].points[getIndexByX(chart8.series[1],self.month()-1)].update({"y":self.totalActivos()})
			}else if(self.type()=="Pasivos"){
				chart8.series[0].points[getIndexByX(chart8.series[0],self.month()-1)].update({"y":self.totalPasivos()})
			} 
		}, "json");
	}

    
	/*- CHANGE COLORS BY TYPE --------------------------------------------*/
    self.typeColor= ko.computed(function(){ 
		switch (self.type()){
			case "Activos": 
			return '#0CF';
			break;
			case "Pasivos": 
			return '#639';
			break;
			case "Ingresos": 
			return '#0C0';
			break;
			case "Egresos": 
			return 'red';
			break;
			
		}
  },this);
    self.masMenos=function(value){
	  if (value>0){ return 'green'}
	  else{return 'red'}
	  }
    
	/*SHOW AND HIDE DIVS*/
	self.postView=ko.observable(''); //change view bettween post and reply
	self.formPostView=ko.observable('');//show and hidden send post form 
	self.formRegisterView=ko.observable('');//show and hidden send register form   
	
	/*-CHARGE SENDERS (depende de SELECT IDS)----------------------------------------------------*/ 
	self.trees = ko.observableArray([]);
    self.selectedTree = ko.observable();
	self.chargeSenders=function () {
		$.post("/api/chargeSenders", JSON.stringify({id: self.idSenders().toString() }),
		function(data){
			$.map(data, function(item) {self.trees.push(new tree(item));});
			self.loadPosts();
		}, "json");
		
	};
	
	/*-SELECT IDS----------------------------------------------------*/ 

	self.idSenders=ko.observableArray([]); //ids disponibles para enviar mensajes
	self.idPosts=ko.observableArray([]);   //ids de quienes veo sus mensajes
    self.getIds=function(){
		self.idSenders.removeAll();
		self.idPosts.removeAll();
		$.getJSON("/api/myStudentId/"+self.id(),
		 function(data) {
			$.map(data, function(item) {
				self.idPosts.push(item.id);
				self.idSenders.push(item.id);
			});
			self.idSenders.push(self.idCoach());
			self.idPosts.push(self.id());
			self.chargeSenders();
		});   
	};

	
	
	/*- P O S T------------------------------*/
	self.posts=ko.observableArray([]);
	self.replys=ko.observableArray([]);
	self.lastId =ko.observable();
	/*self.sort=ko.computed(function(){
		var waca=self.posts();
		if(self.postView()!=''){
			self.posts.sort(function (a, b) {
			     return a.modified() > b.modified(); 
			});
		}else{self.posts.sort(function (a, b) {
			     return a.modified() < b.modified(); 
			});
			
			}
		
		},self); */
	/*ADD POST*/	
    self.addPost = function(type)   {
			if(type=='Reply'){
				  var formValues = {
					  subject: self.replys()[0].subject(),
					  text: $('#inputReply').val(),  
					  reply_id:self.replys()[0].id(),
					  user_id:self.id(),
					  to_id:self.replys()[0].user_id() 
				  };
			}else{
				  var formValues = {
					  subject: $('#inputSubject').val(),
					  text: $('#inputText').val(),
					  reply_id:$('#inputReply_id').val(),
					  user_id:$('#inputUser_id').val(),
					  to_id:self.selectedTree().id()
				  }; 
			}
			$.post("/api/addPost", JSON.stringify(formValues),
			function(data){
				  data.name=self.name();
				  data.role=self.role();
				  data.src=self.src();
				  if (data.reply_id==0){self.posts.unshift(new post(data));self.lastId(data.id)}
				  else{self.replys.push(new post(data));}
				  self.formPostView('');
			}, "json");
	}
	/*LOAD POST*/
	self.loadPosts=function(){
        if(self.posts().length > 0){self.lastId(self.posts()[0].id());	
		}else{self.lastId(0)}
		$.post("/api/chargePosts", JSON.stringify({
			id: self.idPosts().toString(),
			lastId:self.lastId(),
			myId:self.id(),
			coachId:self.idCoach() }),
			function(data){
				$.map(data, function(item) {
					  self.posts.push(new post(item));
				});
		}, "json");
		self.postView(''); 
	}

	/*AUTO LOAD POST*/		
	self.autoPost=ko.observable();
	self.loadPostInterval=ko.computed(function() {
		if(self.postView()!=''){clearInterval(self.autoPost());  
		}else{
			  self.autoPost(setInterval(function () { //console.log(self.posts()[0].id()); 
					self.loadPosts(); 
			  }, 60000)); 
		}
	},self);	
	/*LOAD REPLY*/
	self.loadReplys=function (data,event)        { 
	        if(self.postView()==''){self.replys.removeAll();};  
			$.getJSON("/api/replysById/"+data.id(), 
			function(data) {
                $.map(data, function(item) {self.replys.push(new post(item));});
				self.postView(data[0].id);  //error
			});
	};
	/*AUTO LOAD REPLY*/		
	self.autoReply=ko.observable(); //guarda la variable clear interval que busca nuevas respuestas
	self.loadReplyInterval=ko.computed(function(){
		if(self.postView()==''){clearInterval(self.autoReply());  
		}else{
			  self.autoReply(setInterval(function () {
					$.getJSON("/api/replysById/"+self.postView(), 
					function(allData) {
						  var waca = $.map(allData, function(item) {return new post(item)});
						  self.replys(waca);  
					});
			  }, 10000));
		}
	},self); 			

    /* U S E R  -------------------------------------------------*/
	
	self.userEdit= function (data)       {
		 var formValues = {
			id:data.id(),
			email:data.email(),
			name:data.name(),
			src:data.src()
        }; 
		$.post('/api/updateUser',JSON.stringify(formValues),
		function(data){
			 $('#uploadimage').css({display: 'none'});
		}, "json");
	}	  


}/*E N D   U S E R ()*/

var userModel = new user();
ko.applyBindings(userModel);


