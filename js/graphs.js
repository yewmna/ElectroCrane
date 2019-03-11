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
            var parsed = JSON.parse(response);
            coils_array = parsed.map(e => e.coils);
            console.log(coils_array);
            volts_array = parsed.map(e => e.current);
            length_array = parsed.map(e => e.length);
            paperclips_array = parsed.map(e => e.paperclips);
            trials_array = parsed.map(e => e.trial);


            //coils
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: trials_array,
        datasets: [{
            label: '# of paperclips',
            data: paperclips_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderWidth: 1
        },
        {
            label: '# of coils',
            data: coils_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)',
            ],
            borderColor: [
                'rgba(54, 162, 235,1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
         title: {
            display: true,
            text: 'Coils & Paperclips'
        }
    }
});

//coils
var myChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: trials_array,
        datasets: [{
            label: '# of paperclips',
            data: paperclips_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Voltage',
            data: volts_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)',
            ],
            borderColor: [
                'rgba(54, 162, 235,1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
         title: {
            display: true,
            text: 'Voltage & Paperclips'
        }
    }
});

//coils
var myChart3 = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: trials_array,
        datasets: [{
            label: '# of paperclips',
            data: paperclips_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Length of Nail',
            data: length_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0)',
            ],
            borderColor: [
                'rgba(54, 162, 235,1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
         title: {
            display: true,
            text: 'Nail Length & Paperclips'
        }
    }
});

            }).fail(function(jqXHR, textStatus, errorThrown){
});

console.log(coils_array);
var ctx = document.getElementById("myChart");
var ctx2 = document.getElementById("myChart2");
var ctx3= document.getElementById("myChart3");



};



