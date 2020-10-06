// Globals
const url = "http://localhost/OfferDeclineRatio/api/index.php";
var ordData;

//Window Ready
$(document).ready(function(){

    $("#jobi").circliful();
    $("#job").circliful();
    $("#dec").circliful();
    $("#rat").circliful();
    getODR();
    getReason();
    getJobCount($("#jobcount"));
    getAcceptedCount($("#acceptedcount"));
    getDeclineCount($("#declinecount"));
    getPending($("#pending"));

})

// Get Job Init Count
function getJobCount(item)
{
        $.get(url+"?tag=getJobCount",function(data,status){
         
            item.html(data);
        });
}

// Get Job Accepted Count
function getAcceptedCount(item)
{
        $.get(url+"?tag=getAccepted",function(data,status){
     
            item.html(data);
        });
}

// Get Job Declined Count
function getDeclineCount(item)
{
        $.get(url+"?tag=getDecline",function(data,status){
           
            item.html(data);
        });
}

// Get Pending Job
function getPending(item)
{
    $.get(url+"?tag=getPending",function(data,status){
        item.html(data);
    });
}

// Pie chart for the Decline Reasons
function getReason()
{
    $.get(url+"?tag=reason",function(data,status){
        var option = {
            series: JSON.parse(data),
            chart: {
            width: 380,
            type: 'pie',
        },
        labels: ['Better Opportunity', 'Location Constraint', 'Others','Not Answered'],
        responsive: [{
            breakpoint: 480,
            options: {
            chart: {
                width: 300
            },
            legend: {
                position: 'bottom'
            }
            }
        }]
    };
    var charts = new ApexCharts(document.querySelector("#rej"), option);
    charts.render();
    });
}

// Bar chart for the Offer Decline Ratio
function getODR()
{
    $.get(url+"?tag=odr",function(data,status){
        var options = {
            series: [{
            data: JSON.parse(data)
        }],
            chart: {
            type: 'bar',
            height: 200
        },
        plotOptions: {
            bar: {
            horizontal: false,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: ['30', '21-30', '15-21', '7-15', '2-7', '1'],
        }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    })
}