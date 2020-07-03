function  getSales() {
	 var sales = document.getElementById('getSales');


	var xhtttp =new XMLHttpRequest();
	
	xhtttp.onreadystatechange = function () {
		if (xhtttp.readyState ==4 && xhtttp.status==200) {

var data = this.responseText;
		var dataArray=data.data;
		var total=0;
for (var i = 0; i < dataArray.length; i++) {
	var myObject = dataArray[i];

var mySelect = document.createElement('p');

mySelect.innerHTML=myObject.id+" \xa0\xa0 \xa0\xa0  "+myObject.user_id+" \xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0   " +"   "+myObject.date +"  \xa0\xa0\xa0\xa0  "+myObject.total;
sales.append(mySelect);

 total  =total + parseInt(myObject.total) ;

	
}
var b = myObject.date;


 
var options = {
  chart: {
    type: 'bar'
  },
  series: [{
    name: 'sales',
    data: [200,,400,,100,,1000]
  }],
   plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '125%',
            endingShape: 'rounded'
          },
        },
  xaxis: {
    categories: ['President','','Vice President','','Secretary','','Minister of Finance']
  }
}

var chart = new ApexCharts(document.querySelector("#graph"), options);

chart.render();



		}

		else if (xhtttp.readyState !=1 &&xhtttp.status!=200) {
			// alert('Error 500')
		}
			
	}

	xhtttp.open("get","http://localhost/evoteApp/getData.php", true);
	xhtttp.send();

}

