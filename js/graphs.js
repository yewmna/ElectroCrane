function pretendLoad(){
    $('#resy').hide();
    $('#loading').show();
}

var trials_array=[];
var coils_array=[];
var volts_array=[];
var length_array=[];
var paperclips_array=[];


window.onload = function() {
                 $.ajax({
           url: "experiments.json",
         contentType: "application/json; charset=utf-8",
          type: 'GET',

        }).done(function(response){
            try{
        var parsed = jQuery.parseJSON(JSON.stringify(response));
       coils_array = parsed.map(e => e.coils);
            console.log(coils_array);
            volts_array = parsed.map(e => e.current);
            length_array = parsed.map(e => e.length);
            paperclips_array = parsed.map(e => e.paperclips);
            trials_array = parsed.map(e => e.trial);

            }catch{
         var parsed = JSON.parse(response);
       coils_array = parsed.map(e => e.coils);
            console.log(coils_array);
            volts_array = parsed.map(e => e.current);
            length_array = parsed.map(e => e.length);
            paperclips_array = parsed.map(e => e.paperclips);
            trials_array = parsed.map(e => e.trial);


            }

            //coils
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: trials_array,
        datasets: [{
            label: 'Paperclips',
            data: paperclips_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderWidth: 3
        },
        {
            label: 'Coils',
            data: coils_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)',
            ],
            borderColor: [
                'rgba(54, 162, 235,1)',
            ],
            borderWidth: 3
        }]
    },
    options: {
        legend:{
             labels: {
                  fontFamily: "Montserrat"
            }

        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                        fontFamily: "Montserrat"
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero:true,
                        fontFamily: "Montserrat"

                }
            }]
        },
         title: {
            display: false,
            text: 'COILS & PAPERCLIPS',
            fontFamily: "Montserrat",
            fontColor:'#252004',
            fontSize:20,
            fontStyle: 900
        }
    }
});

//coils
var myChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: trials_array,
        datasets: [{
            label: 'Paperclips',
            data: paperclips_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderWidth: 3
        },
        {
            label: 'Current',
            data: volts_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)',
            ],
            borderColor: [
                'rgba(54, 162, 235,1)',
            ],
            borderWidth: 3
        },
        ]
    },
    options: {
        legend:{
             labels: {
                  fontFamily: "Montserrat"
            }

        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                        fontFamily: "Montserrat"
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero:true,
                        fontFamily: "Montserrat"

                }
            }]
        },
         title: {
            display: false,
            text: 'Current & Paperclips',
            fontFamily: "Montserrat"
        },
    }
});

//coils
var myChart3 = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: trials_array,
        datasets: [{
            label: 'Paperclips',
            data: paperclips_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderWidth: 3
        },
        {
            label: 'Current',
            data: volts_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)',
            ],
            borderColor: [
                'rgba(54, 162, 235,1)',
            ],
            borderWidth: 3
        },
        {
            label: 'Coils',
            data: coils_array,
            backgroundColor: [
                'rgba(255, 220, 0, 0)',
            ],
            borderColor: [
                'rgba(255, 220, 0, 1)',
            ],
            borderWidth: 3
        },
        ]
    },
    options: {
        legend:{
             labels: {
                  fontFamily: "Montserrat"
            }

        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                        fontFamily: "Montserrat"
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero:true,
                        fontFamily: "Montserrat"

                }
            }]
        },
         title: {
            display: false,
            text: 'Current & Paperclips',
            fontFamily: "Montserrat"
        },
    }
});

            }).fail(function(jqXHR, textStatus, errorThrown){
});

console.log(coils_array);
var ctx = document.getElementById("myChart");
var ctx2 = document.getElementById("myChart2");
var ctx3= document.getElementById("myChart3");



};



