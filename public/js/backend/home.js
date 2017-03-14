$(document).ready(function() {

//console.log("Come")
                    var sparklineCharts = function(){
                       
                       //Providers Details
                       //console.log(providers);
                       var provider_value = [];
                       var provider_month = {}
                       for (index = 0; index < providers.length; ++index) {
                            provider_value[index] = parseInt(providers[index].total);
                       }

                       for (index = 0; index < providers.length; ++index) {
                            var a = parseInt(providers[index].m);
                            var b = "";
                            switch(a){
                            case 1: b = "January";
                                break;
                            case 2: b = "February";
                                break;
                            case 3: b = "March";
                                break;
                            case 4: b = "April";
                                break;
                            case 5: b = "May";
                                break;
                            case 6: b = "June"; 
                                break;
                            case 7: b = "July";
                                break;
                            case 8: b = "August";
                                break;
                            case 9: b = "September";
                                break;
                            case 10: b = "October";
                                break;
                            case 11: b = "November";
                                break;
                            case 12: b = "December";
                                break;
                            }
                            provider_month[index] = b;
                       }
                       //console.log(provider_value);
                       //console.log(provider_month);

                       //Tenant Details
                       var tenant_value = [];
                       var tenant_month = {}
                       for (index = 0; index < tenants.length; ++index) {
                            tenant_value[index] = parseInt(tenants[index].total);
                       }

                       for (index = 0; index < tenants.length; ++index) {
                            var a = parseInt(tenants[index].m);
                            var b = "";
                            switch(a){
                            case 1: b = "January";
                                break;
                            case 2: b = "February";
                                break;
                            case 3: b = "March";
                                break;
                            case 4: b = "April";
                                break;
                            case 5: b = "May";
                                break;
                            case 6: b = "June"; 
                                break;
                            case 7: b = "July";
                                break;
                            case 8: b = "August";
                                break;
                            case 9: b = "September";
                                break;
                            case 10: b = "October";
                                break;
                            case 11: b = "November";
                                break;
                            case 12: b = "December";
                                break;
                            }
                            tenant_month[index] = b;
                       }


                       //New Bookings
                       var new_booking_value = [];
                       var new_booking_month = {}
                       for (index = 0; index < new_bookings.length; ++index) {
                            new_booking_value[index] = parseInt(new_bookings[index].total);
                       }

                       for (index = 0; index < new_bookings.length; ++index) {
                            var a = parseInt(new_bookings[index].m);
                            var b = "";
                            switch(a){
                            case 1: b = "January";
                                break;
                            case 2: b = "February";
                                break;
                            case 3: b = "March";
                                break;
                            case 4: b = "April";
                                break;
                            case 5: b = "May";
                                break;
                            case 6: b = "June"; 
                                break;
                            case 7: b = "July";
                                break;
                            case 8: b = "August";
                                break;
                            case 9: b = "September";
                                break;
                            case 10: b = "October";
                                break;
                            case 11: b = "November";
                                break;
                            case 12: b = "December";
                                break;
                            }
                            new_booking_month[index] = b;
                       }


                       //Yearly Bookings
                       var yearly_booking_value = [];
                       var yearly_booking_month = {}
                       for (index = 0; index < yearly_bookings.length; ++index) {
                            yearly_booking_value[index] = parseInt(yearly_bookings[index].total);
                       }

                       for (index = 0; index < yearly_bookings.length; ++index) {
                            var a = parseInt(yearly_bookings[index].m);
                            var b = "";
                            switch(a){
                            case 1: b = "January";
                                break;
                            case 2: b = "February";
                                break;
                            case 3: b = "March";
                                break;
                            case 4: b = "April";
                                break;
                            case 5: b = "May";
                                break;
                            case 6: b = "June"; 
                                break;
                            case 7: b = "July";
                                break;
                            case 8: b = "August";
                                break;
                            case 9: b = "September";
                                break;
                            case 10: b = "October";
                                break;
                            case 11: b = "November";
                                break;
                            case 12: b = "December";
                                break;
                            }
                            yearly_booking_month[index] = b;
                       }
                       
                       //List Number of Booking
                       var property_value = [];
                       var property_month = {}
                       for (index = 0; index < properties.length; ++index) {
                            property_value[index] = parseInt(properties[index].total);
                       }

                       for (index = 0; index < properties.length; ++index) {
                            var a = parseInt(properties[index].m);
                            var b = "";
                            switch(a){
                            case 1: b = "January";
                                break;
                            case 2: b = "February";
                                break;
                            case 3: b = "March";
                                break;
                            case 4: b = "April";
                                break;
                            case 5: b = "May";
                                break;
                            case 6: b = "June"; 
                                break;
                            case 7: b = "July";
                                break;
                            case 8: b = "August";
                                break;
                            case 9: b = "September";
                                break;
                            case 10: b = "October";
                                break;
                            case 11: b = "November";
                                break;
                            case 12: b = "December";
                                break;
                            }
                            property_month[index] = b;
                       }


                       $("#sparkline35").sparkline(provider_value,{
                            type: 'pie', 
                            height: '140',
                            tooltipFormat: '{{offset:offset}} {{value}}',
                            tooltipValueLookups: {
                            'offset': provider_month
                        }});
                        $("#sparkline36").sparkline(tenant_value, {
                            type: 'pie',
                            height: '140',
                            tooltipFormat: '{{offset:offset}} {{value}}',
                            tooltipValueLookups: {
                            'offset': tenant_month
                        }});

                        $("#sparkline37").sparkline([2, 2], {
                            type: 'pie',
                            height: '140',
                            sliceColors: ['#ed5565', '#F5F5F5']
                        });

                        $("#sparkline38").sparkline([2, 3], {
                            type: 'pie',
                            height: '140',
                            sliceColors: ['#ed5565', '#F5F5F5']
                        });

                        $("#sparkline39").sparkline(new_booking_value, {
                             type: 'pie',
                             height: '140',
                             tooltipFormat: '{{offset:offset}} {{value}}',
                             tooltipValueLookups: {
                            'offset': new_booking_month
                        }});

                         $("#sparkline40").sparkline(yearly_booking_value, {
                             type: 'pie',
                             height: '140',
                             tooltipFormat: '{{offset:offset}} {{value}}',
                             tooltipValueLookups: {
                            'offset': yearly_booking_month
                        }});

                         $("#sparkline41").sparkline([2, 2], {
                             type: 'pie',
                             height: '140',
                             sliceColors: ['#ed5565', '#F5F5F5']
                         });

                         $("#sparkline42").sparkline([2, 3], {
                             type: 'pie',
                             height: '140',
                             sliceColors: ['#ed5565', '#F5F5F5']
                         });

                         $("#sparkline100").sparkline([2, 3], {
                             type: 'pie',
                             height: '140',
                             sliceColors: ['#ed5565', '#F5F5F5']
                         });

                         $("#sparkline13").sparkline(property_value,{
                            type: 'pie', 
                            height: '140',
                            tooltipFormat: '{{offset:offset}} {{value}}',
                            tooltipValueLookups: {
                            'offset': property_month
                        }});


                    };

                    var sparkResize;

                    $(window).resize(function(e) {
                        clearTimeout(sparkResize);
                        sparkResize = setTimeout(sparklineCharts, 500);
                    });

                    sparklineCharts();
                    var key, count = 0;
                    for(key in income) {
                    if(income.hasOwnProperty) {
                    count++;
                    }
                    }
                    //console.log(Object.keys(income).length);
                    var mlabel = [0];
                    var mdata = [0];
                    for (var i = 1; i <= Object.keys(income).length; i++) {
                        mlabel.push(i) ;
                        if(income[i].length == 0){
                            mdata.push(parseInt(income[i].length));
                        }else{
                            var percent = parseInt((3.5 * income[i].a)/100);
                            mdata.push(percent);
                        }
                        
                    }
                    // console.log(mlabel.substring(1));
                    var tlabel = mlabel.join();
                    var tdata = mdata.join();
                    //console.log(tlabel);
                    //console.log(tdata);

 var barData1 = {
        labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30],
        datasets: [
            {
                label: "Monthly Income",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [0,0,108,0,0,0,0,55,0,0,0,0,0,0,0,11,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
            }
        ]
    };
    



 var barData = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [
            {
                label: "Data 1",
                backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
                data: [65, 59, 80, 81, 56, 55, 40, 67, 45, 23, 78, 12]
            },
            {
                label: "Data 2",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [28, 48, 40, 19, 86, 27, 90, 67, 45, 23, 78, 12]
            }
        ]
    };

    var barOptions = {
        responsive: true
    };


    /*var ctx2 = document.getElementById("barChart").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData1, options:barOptions});
*/
    var polarData = {
        datasets: [{
            data: [
                300,140,200
            ],
            backgroundColor: [
                "#a3e1d4", "#dedede", "#b5b8cf"
            ],
            label: [
                "My Radar chart"
            ]
        }],
        labels: [
            "App","Software","Laptop"
        ]
    };

   /* var ctx2 = document.getElementById("barChart1").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});*/

    var polarData = {
        datasets: [{
            data: [
                300,140,200
            ],
            backgroundColor: [
                "#a3e1d4", "#dedede", "#b5b8cf"
            ],
            label: [
                "My Radar chart"
            ]
        }],
        labels: [
            "App","Software","Laptop"
        ]
    };


     
                

});
    
