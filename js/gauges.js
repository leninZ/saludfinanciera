Highcharts.theme = {
  // colors: ['#0c0', 'red', '#0CF', '#639', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'], 
   chart: {
	   	backgroundColor: 'white',
	borderColor: 'white',
	borderWidth: 2,
	plotBackgroundColor:'white',
    /*  backgroundColor: {
         linearGradient: [0, 0, 500, 500],
         stops: [
            [0, 'rgb(255, 255, 255)'],
            [1, 'rgb(240, 240, 255)']
         ]
      },
	  */
      borderWidth: 0,
      plotBackgroundColor: 'rgba(255, 255, 255, .9)',
     // plotShadow: true,
      //plotBorderWidth: 1
   },  
   title: {
      style: {
         color: '#000',
         font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   subtitle: {
      style: {
         color: '#666666',
         font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   xAxis: {
      gridLineWidth: 1,
      lineColor: '#000',
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

         }
      }
   },
   yAxis: {
      minorTickInterval: 'auto',
      lineColor: '#000',
      lineWidth: 1,
      tickWidth: 1,
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: 'black'

      },
      itemHoverStyle: {
         color: '#039'
      },
      itemHiddenStyle: {
         color: 'gray'
      }
   },
   labels: {
      style: {
         color: '#99b'
      }
   }
};


// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme); 


chart1 = new Highcharts.Chart({
 chart: {
	renderTo: 'gauge1',
	type: 'gauge',
	plotBorderWidth: 0,
	plotBackgroundImage: null,
	height: 150
},

title: {
	text: ''
},
exporting: {
  enabled:false,
  url:false
},

pane: [{
	startAngle: -120,
	endAngle: 120,
	background: null,
	center: ['50%', '60%'],
	size: 60
}],                        

yAxis: [{
	min: 0,
	max: 2,
	minorTickPosition: 'outside',
	tickPosition: 'outside',
	labels: {
	   // rotation: 'auto',		
		distance: 30
	},

	plotBands: [{
		from: 0,
		to: 0.1,
		color: 'red',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 0.11,
		to: 0.5,
		color: 'yellow',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 0.51,
		to: 100,
		color: '#0C0',
	   innerRadius: '100%',
		outerRadius: '160%'
	}],
	pane: 0,
	title: {
		text: 'ILP',
		y: -40
	}
}],

plotOptions: {
	gauge: {
		dataLabels: {
			enabled: true,
			borderWidth:0,
			formatter: function() {
					return this.y.toFixed(2);  
                    },
			style:{
				y:6
			}
		},
		
		dial: {
			radius: '100%'
		}
	}
},
tooltip: {
                formatter: function() {
                  return this.y.toFixed(2);    
                }
            }, 
 credits: {
                enabled: false
            },
	

series: [{
	data: [0],
	yAxis: 0
}]


});
chart2 = new Highcharts.Chart({
 chart: {
	renderTo: 'gauge2',
	type: 'gauge',
	plotBorderWidth: 1,
	plotBackgroundImage: null,
	height: 150
},

title: {
	text: ''
},
exporting: {
  enabled:false,
  url:false
},

pane: [{
	startAngle: -120,
	endAngle: 120,
	background: null,
	center: ['50%', '60%'],
	size: 60
}],                        

yAxis: [{
	min: 0,
	max: 2,
	minorTickPosition: 'outside',
	tickPosition: 'outside',
	labels: {
	   // rotation: 'auto',
	   /*formatter: function() {
					return this.y.toFixed(2);  
                    },*/
		enabled:false,			
		distance: 30
	},
	plotBands: [{
		from: 0,
		to: 0.1,
		color: 'red',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 0.11,
		to: 0.5,
		color: 'yellow',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 0.51,
		to: 100,
		color: '#0C0',
	   innerRadius: '100%',
		outerRadius: '160%'
	}],
	pane: 0,
	title: {
		text: 'ILP',
		y: -40
	}
}],

plotOptions: {
	gauge: {
		dataLabels: {
			formatter: function() {
					return this.y.toFixed(2);  
                    },
			enabled: true,
			borderWidth:0,
			style:{
				y:6
			}
		},
		
		dial: {
			radius: '100%'
		}
	}
},
	

series: [{
	data: [0.7],
	yAxis: 0
}]


});
chart3 = new Highcharts.Chart({
 chart: {
	renderTo: 'gauge3',
	type: 'gauge',
	plotBorderWidth: 0,
	plotBackgroundImage: null,
	height: 150
},

title: {
	text: ''
},
exporting: {
  enabled:false,
  url:false
},

pane: [{
	startAngle: -120,
	endAngle: 120,
	background: null,
	center: ['50%', '60%'],
	size: 60
}],                        

yAxis: [{
	min: 0,
	max: 200,
	minorTickPosition: 'outside',
	tickPosition: 'outside',
	labels: {
	   // rotation: 'auto',
		distance: 30
	},
	plotBands: [{
		from: 0,
		to: 50,
		color: '#0C0',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 50.1,
		to: 90,
		color: 'yellow',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 90.1,
		to: 100,
		color: 'red',
	   innerRadius: '100%',
		outerRadius: '160%'
	},
	{
		from: 100.1,
		to: 300,
		color: 'black',
	   innerRadius: '100%',
		outerRadius: '160%'
	}],
	pane: 0,
	title: {
		text: 'ICL',
		y: -40
	}
}],

plotOptions: {
	gauge: {
		dataLabels: {
			formatter: function() {
					return this.y+'%'; 
                    },
			enabled: true,
			borderWidth:0,
			style:{
				y:6
			}
		},
		
		dial: {
			radius: '100%'
		}
	}
},
 credits: {
                enabled: false
            },
	

series: [{
	data: [40],
	yAxis: 0
}]


});
chart4 = new Highcharts.Chart({
 chart: {
	renderTo: 'gauge4',
	type: 'gauge',
	plotBorderWidth: 1,
	plotBackgroundImage: null,
	height: 150
},

title: {
	text: ''
},
exporting: {
  enabled:false
},

pane: [{
	startAngle: -120,
	endAngle: 120,
	background: null,
	center: ['50%', '60%'],
	size: 60
}],                        

yAxis: [{
	min: 0,
	max: 200, 
	minorTickPosition: 'outside',
	tickPosition: 'outside',
	labels: {
	   // rotation: 'auto',
		distance: 30
	},
   plotBands: [{
		from: 0,
		to: 50,
		color: '#0C0',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 50.1,
		to: 90,
		color: 'yellow',
		innerRadius: '100%',
		outerRadius: '160%'
	},{
		from: 90.1,
		to: 100,
		color: 'red',
	   innerRadius: '100%',
		outerRadius: '160%'
	},
	{
		from: 100.1,
		to: 300,
		color: 'black',
	   innerRadius: '100%',
		outerRadius: '160%'
	}],
	pane: 0,
	title: {
		text: 'ICL',
		y: -40
	}
}],

plotOptions: {
	gauge: {
		dataLabels: {
			formatter: function() {
					return this.y+'%'; 
                    },
			enabled: true,
			borderWidth:0,
			style:{
				y:6
			}
		},
		
		dial: {
			radius: '100%'
		}
	}
},
	

series: [{
	data: [61],
	yAxis: 0
}]


});

/*-------------------------------------------------------------------------------------*/	  
chart5 = new Highcharts.Chart({
         chart: {
            renderTo: 'gauge5',
            type: 'gauge',
            plotBorderWidth: 0,
            plotBackgroundImage: null,
            height: 150
        },
    
        title: {
            text: ''
        },
        exporting: {
          enabled:false,
          url:false
        },
        
        pane: [{
            startAngle: -120,
            endAngle: 120,
            background: null,
            center: ['50%', '60%'],
            size: 60
        }],                        
    
        yAxis: [{
            min: 0,
            max: 10,
            minorTickPosition: 'outside',
            tickPosition: 'outside',
            labels: {
               // rotation: 'auto',
                distance: 30
            },
            plotBands: [{
                from: 0,
                to: 2,
                color: 'red',
                innerRadius: '100%',
                outerRadius: '160%'
            },{
                from: 2.1,
                to: 5,
                color: 'yellow',
                innerRadius: '100%',
                outerRadius: '160%'
            },{
                from: 5.1,
                to: 10,
                color: '#0C0',
               innerRadius: '100%',
                outerRadius: '160%'
            }],
            pane: 0,
            title: {
                text: 'ILA',
                y: -40
            }
        }],
        
        plotOptions: {
            gauge: {
                dataLabels: {
				    formatter: function() {
					return this.y.toFixed(2);   
                    },
                    enabled: true,
                    borderWidth:0,
                    style:{
                        y:6
                    }
                },
                
                dial: {
                    radius: '100%'
                }
            }
        },
		tooltip: {
                formatter: function() {
                  return this.y.toFixed(2);    
                }
            },
		 credits: {
                enabled: false
            },
            
    
        series: [{
            data: [1.8],
            yAxis: 0,
        }]
    
    
      }); 
/*--------------------------------------------------------------------------------------------*/
chart6 = new Highcharts.Chart({
         chart: {
            renderTo: 'gauge6',
            type: 'gauge',
            plotBorderWidth: 1,
            plotBackgroundImage: null,
            height: 150
        },
    
        title: {
            text: ''
        },
        exporting: {
          enabled:false,
          url:false
        },
        
        pane: [{
            startAngle: -120,
            endAngle: 120,
            background: null,
            center: ['50%', '60%'],
            size: 60
        }],                        
    
        yAxis: [{
            min: 0,
            max: 10,
            minorTickPosition: 'outside',
            tickPosition: 'outside',
            labels: {
               // rotation: 'auto',
                distance: 30
            },
             plotBands: [{
                from: 0,
                to: 2,
                color: 'red',
                innerRadius: '100%',
                outerRadius: '160%'
            },{
                from: 2.1,
                to: 5,
                color: 'yellow',
                innerRadius: '100%',
                outerRadius: '160%'
            },{
                from: 5.1,
                to: 10,
                color: '#0C0',
               innerRadius: '100%',
                outerRadius: '160%'
            }],
            pane: 0,
            title: {
                text: 'ILA',
                y: -40
            }
        }],
        
        plotOptions: {
            gauge: {
                dataLabels: {
                    enabled: true,
                    borderWidth:0,
                    style:{
                        y:6
                    }
                },
                
                dial: {
                    radius: '100%'
                }
            }
        },
            
    
        series: [{
            data: [3],
            yAxis: 0
        }]
    
    
      });
/*--------------------------------------------------------------------------------------------*/
chart7 =  chart = new Highcharts.Chart({
	 lang: {
        decimalPoint: ",",
        thousandsSep: ".",
        
    },
	       colors: ['#0c0', 'red'], 
            chart: {
                renderTo: 'grafico1',
			    plotShadow: true,
               plotBorderWidth: 1 
            },
            title: {
                text: 'Ingresos/Egresos'
            },
			 exporting: {
          enabled:false
        },
            subtitle: {
                text: '',
                floating: true, 
                align: 'right',
                verticalAlign: 'bottom',
                y: 15
            },
            legend: {
               enabled: false
            },
            xAxis: {
              categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May','jun','jul', 'Ago', 'Sep', 'Oct','Nov','Dic']
            },
            yAxis: {
                title: {
                    text: 'Monto'
                },
                labels: {
                    formatter: function() {
                    //    return this.value;
                    }
                }
            },
              tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ Highcharts.numberFormat(this.y,0,'','.');
                }
            },
            plotOptions: {
                area: {
                    fillOpacity: 0.5,
					dataLabels: {enabled: true, formatter: function() {
					return Highcharts.numberFormat(this.y,0,'','.');
                    }}
                },
				 line: {
					dataLabels: {enabled: true,formatter: function() {
					return Highcharts.numberFormat(this.y,0,'','.');
                    }},
					 
                },
				animation:true,
				duration:100000
            },
            credits: {
                enabled: false
            },
            series: [{
				type:'line', 
				index:2,
                name: 'Ingresos',
				//data: [{"x":10,"y":1},{"x":11,"y":10}]//[{x:3,y: 0}, {x:4,y: 5}] 
				      
            }, {
				type:'area',
				index:1,
                name: 'Egresos',
			 //  data:[[3,3],[4,2],[5,10],[6,4]]
            }]
        });
chart8 =  chart = new Highcharts.Chart({
	

	 colors: ['#0CF', '#639'], 
            chart: {
                renderTo: 'grafico2',
               type: 'area',
			    plotShadow: true,
               plotBorderWidth: 1 
            },
            title: {
                text: 'Activos/Pasivos'
            },
			 exporting: {
          enabled:false
        },
            subtitle: {
                text: '',
                floating: true, 
                align: 'right',
                verticalAlign: 'bottom',
                y: 15
            },
            legend: {
               enabled: false
            },
            xAxis: {
                categories:['Ene', 'Feb', 'Mar', 'Abr', 'May','jun','jul', 'Ago', 'Sep', 'Oct','Nov','Dic']
            },
            yAxis: {
                title: {
                    text: 'Monto'
                },
                labels: {
                    formatter: function() {
                    //    return this.value;
					//return Highcharts.numberFormat(this.y,0,'','.');
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ Highcharts.numberFormat(this.y,0,'','.');
                }
            },
            plotOptions: {
                area: {
                    fillOpacity: 0.5,
					dataLabels: {enabled: true, formatter: function() {
					return Highcharts.numberFormat(this.y,0,'','.');
                    }}
                },
				 line: {
					dataLabels: {enabled: true,formatter: function() {
					return Highcharts.numberFormat(this.y,0,'','.');
                    }},
					 
                },
				animation:true,
				duration:100000
            },
            credits: {
                enabled: false
            },
            series: [{
				type:'line', 
				index:2,
                name: 'Activos'
                //data: [20700000, 600000, 470000, 800000, 920000, 723000, 1200000, 1132000]
            }, {
				type:'area',
				index:1,
                name: 'Pasivos',
               // data: [7300000, 7250000, 16000000, 16300000, 14004000, 12873500, 10987689, 11765700]
            }]
        });
  