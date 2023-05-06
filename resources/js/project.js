$(".edit").click(function (){
    let id=$(this).parent()[0].id
    let name=$(this).prev().val()
    console.log(name);
    console.log(id);
    if($.trim(name)===""){
        alert("Please input task name")
    }
    $.ajax({

        type: "post",
        url: "/update",
        data: {id:id,name:name},
        success: function(msg) {
            if (msg===0){
                alert("TASK "+name+" UPDATE FAILED");
                return
            }
            alert("TASK "+name+" UPDATE SUCCESS");
            window.location.reload(true)
        },
        failed:function (msg){
            alert(msg);
        }
    });
});
$(".add").click(function (){
    let project_id=$(this).parent().parent().parent()[0].id
    let name=$(this).prev().val()
    console.log(name,project_id);
    if($.trim(name)==""){
        alert("Please input task name")
        return
    }
    $.ajax({

        type: "post",
        url: "/add",
        data: {project_id:project_id,name:name},
        success: function(msg) {
            window.location.reload(true)
        },
        failed:function (msg){
            alert(msg)
        }
    });
});
$(".delete").click(function () {
    let id=$(this).parent()[0].id
    $.ajax({

        type: "post",
        url: "/delete",
        data: {id:id},
        success: function(msg) {
            if (msg===0){
                alert("TASK  DELETE FAILED");
                return
            }
            alert("TASK DELETE SUCCESS");
            window.location.reload(true)
        },
        failed:function (msg){
            alert(msg)
        }
    });
})

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".task-list").sortable({
        cursor:"move",
        items:".task",
        opacity:0.6,
        revert:true,
        // cancel:".task-add",
        update:function (event,ui){
            let new_order=$(this).sortable("toArray")
            $.ajax({

                type: "post",
                url: "/change_order",
                data: {order:new_order },
                success: function(msg) {
                    //alert(msg);

                },
                failed:function (msg){
                    alert(msg)
                }
            });
        }

    });
})

$("#project_form").submit(function (event) {
    var formData = {
        name: $("#project_name").val(),
    };

    $.ajax({
        type: "POST",
        url: "/project/add",
        data: formData,
        dataType: "json",
        encode: true,
    }).done(function (data) {

    alert("Project "+formData.name+" added successfully");
    window.location.reload(true)
    });

    event.preventDefault();
});


$('.project-delete').click(
    function () {
        let id=$(this).parent().parent()[0].id

        $.ajax({
            type: "POST",
            url: "/project/delete",
            data: {id:id},
            dataType: "json",
            encode: true,
        }).done(function (data) {

            alert("Project deleted successfully");
            window.location.reload(true)
        });

        event.preventDefault();
    }
)
