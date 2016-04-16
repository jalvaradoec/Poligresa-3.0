
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

    var data = google.visualization.arrayToDataTable([
        ['City', '2010 Population',],
        ['New York City, NY', 8175000],
        ['Los Angeles, CA', 3792000],
        ['Chicago, IL', 2695000],
        ['Houston, TX', 2099000],
        ['Philadelphia, PA', 1526000]
    ]);

    var options = {
        title: 'Population of Largest U.S. Cities',
        chartArea: {width: '50%'},
        hAxis: {
            title: 'Total Population',
            minValue: 0
        },
        vAxis: {
            title: 'City'
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

// ref link : https://developers.google.com/chart/interactive/docs/gallery/columnchart#examples
jQuery(document).ready(function () {
    var today = todayDate();
    loadTasks(today);
});
function loadTasks(date) {
    var dt = date || null;
    $.ajax({
            method: "POST",
            url: "ajax.php?action=loadTasks",
            data: {"date": dt},
            // dataType: 'json',
            beforeSend: function (xhr) {
                $("#tasksTbody").html("Loading tasks...");
            },
            success: function (response) {
                $("#tasksTbody").html(response);
            }
        })
        .done(function (msg) {
            console.log("Data loaded: " + msg);
        });
}

//The Calender
$("#op_calendar").datepicker("setDate", todayDate())
    .on("changeDate", function (e, date) {
        var selected_date = e.format();
        if (selected_date)
            loadTasks(selected_date);
        // `e` here contains the extra attributes
    });

// change task status

$(".clsTaskStaus").change(function (e) {
    if ($(this).is(":checked"))
        alert("checked");
    else
        alert("not checked");
});

/*$(".clsTaskStaus").each(function () {
 $(this).click(function () {
 var task_id = $(this).attr("id");
 var task_status;
 if ($(this).attr("checked"))
 task_status = 1;
 else
 task_status = 0;

 console.log("task id : " + task_id + ", status = " + task_status);
 });
 });*/

$(document).on("change", ".clsTaskStaus", function () {
    var id = $(this).attr("id");
    if ($(this)[0].checked) {
        updateTaskStatus(id,1);
    }
    else {
        updateTaskStatus(id,0);
    }
});

function updateTaskStatus(taskId,status)
{
    $.ajax({
            method: "POST",
            url: "ajax.php?action=updateTaskStatus",
            data: {"taskId":taskId,"status": status},
            dataType: 'json',
            success: function (response) {

                if(response.status == 1) {
                    var statusStr = status == 1 ? "Done" : "Peding";
                    alert("Task status has been updated to "+statusStr+" successfully.");
                }else{
                    alert("something went wrong.");
                }
            }
        })
        .done(function (msg) {
            // console.log("Data loaded: " + msg);
        });
}

/*
 $("#tasksTbody .clsTaskStaus").each(function(){
 $(this).change(function(){
 $(this).val();
 });
 })*/
