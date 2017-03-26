
var Audit_trail = $('#audits').DataTable({
    processing: true,
    serverProcessing: true,
    order: [[0, 'desc']],
    ajax: '/profile-settings/profile-audit/'+$('#id').val(),
    columns: [
        { data: 'id', 'name': 'id' },
        { data: 'case_name', 'name': 'case_name' },
        { data: 'description', 'name': 'description' },
        { data: 'created_at', 'name': 'created_at' },
        { data: 'user_name', 'name': 'user_name' }
    ]
});

var users = {
    splash: function(type, content, modal){
        switch(type){
            case 'success':
                var html = '<div class="alert alert-success">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Success!</strong> '+content;
                html += '</div>';
                return html;
                break;

            case 'warning':
                var html = '<div class="alert alert-warning">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Warnings!</strong> ';

                for(var key in content.errors) {
                    var errors = content.errors[key];
                    for(var i = 0; i < errors.length; i++){
                        html += '<li>'+errors[i]+'</li>';
                    }
                }

                html += '</div>';
                return html;
                break;

            case 'error':
                var html = '<div class="alert alert-error">';
                html += '<button class="close" data-dismiss="alert">&times;</button>';
                html += '<strong>Error!</strong> '+content;
                html += '</div>';
                return html;
                break;
        }
    },
    resetFields: function(){
        $('input[type="number"], input[type="text"], input[type="email"], textarea').val('');
    }
};

// $('#change-pass').on('submit', function (e) {
//     e.preventDefault();
//
//     $.ajax({
//         url: '/change-password/'+$('#id').val(),
//         type: 'POST',
//         data: $(this).serialize(),
//         dataType: 'json',
//         success: function(data){
//             if(data.success){
//
//                 // alert success
//                 var success =  users.splash('success', 'Password Changed Successfully!please check your email for your new credentials');
//                 $('#feedback').html(success);
//
//                 //remove alert after 3 seconds
//                 setTimeout(function(){
//                     $('#feedback').slideUp('slow');
//                 }, 3000);
//             }else if(!data.success){
//                 // alert errors
//                 var warnings = users.splash('warning', data);
//                 $('#feedback').html(warnings);
//             }
//         }
//     });
// });