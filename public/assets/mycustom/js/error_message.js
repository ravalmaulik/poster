function ajax_fail_alert(res) {
    var data = res.responseJSON;
    var el = document.createElement('ul');
    $.each(data.errors, function( index, value ) {
        var my_li = document.createElement('li');
        t = document.createTextNode(value);
        my_li.appendChild(t);
        el.appendChild(my_li);
    });
    swal({
        title: data.message,
        content: {
            element: el,
        }
    });
}

// function success_alert(title) {
//     swal({
//         title: title,
//         icon: 'success'
//     })
// }

function post_request(route,form_data,custome_function=null) {
    $.post(route,form_data, function(result) {
        if (custome_function!=null) {
            custome_function(result);   
        }
    }).fail(function(res) {
        ajax_fail_alert(res);
    });
}
function insert_sucessfully_alert() {
    swal({
        title: "Inserted Sucessfully",
        icon: 'success'
    })
}
function update_sucessfully_alert() {
    swal({
        title: "Updated Sucessfully",
        icon: 'success'
    })
}
function delete_confirm(delete_fun) {
    swal({
        title: "Are you sure want to delete?",
        // text: "Delete this row",
        icon: 'warning',
        dangerMode: true,
        buttons: {
            cancel: 'No, Please!',
            delete: 'Yes, Delete It'
        }
    }).then(function (willDelete) {
        if (willDelete) {
            delete_fun();
        } else {
            swal({
                title: 'Cancelled',
                icon: "error",
            });
        }
    });
}

function delete_sucessfully_alert(){
    swal({
        title: "Record deleted sucessfully",
        icon: "success",
    });
}