var jobinit;
var jobs;
var resType;
const url = "http://localhost/OfferDeclineRatio/api/index.php";
$(document).ready(function(){

 
    jobinit = $('#jobini');
    initdate = $('#date');
    getJobCount(jobinit);



    var why = $('#why');
    why.hide();

    // Job Update
    $("#jobbtn").click(function(){
        if(jobinit.val() != jobs)
        {
            updateJob(jobinit.val(),initdate.val());
            return false;
        }
    });


    var feedback = $("#feedback")

    feedback.on('change',function(){
       if($(this).val() == 2){
           resType = 2;
           why.slideDown(500);
       }else{
           why.hide();
       }
    })


    $('#resbtn').click(function(){
        if($("#dated").val() == "" || feedback.val() == 0)
        {
            swal("All Fields Manditory", "", "warning");
        }else{
            var dated = $('#dated').val();
            var type = (feedback.val() == 1) ? 'accepted' : 'decline';
            var reason = $("input[name='group1']:checked").val();
            if(type == 'decline' && reason == undefined) {alert("Please Select the reason");}
            $.get(url+"?tag=feedback&data="+type+"&date="+dated+"&why="+reason,function(data,status){
                var json = JSON.parse(data);
                if (json.type == "success") {
                    swal("Feedback Submited", "", "success");
                }
            });
        }
    })

    $('select').formSelect();
});


function getJobCount()
{
        $.get(url+"?tag=getJobCount",function(data,status){
            jobinit.focus();
            jobs = data;
            jobinit.val(data);
        });
}


function updateJob(data,date)
{
    $.get(url+"?tag=jobInit&data="+data+"&date="+date,function(json,status){
            var obj = JSON.parse(json);
            if(obj.type == "success")
            {
                swal("Updated", "", "success");
                getJobCount();
            }
            
    });
}