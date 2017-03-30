$('.edit_subcat').on('click',function () {
    var edit_id = $(this).attr('edit-id');
    var action = $(this).attr('action');
      if(edit_id != ''){
        $('#edit-sub-cat-form').attr('action', action);

          $.ajax({
             url: 'get-subcategory-ailments/'+edit_id,
              type: 'GET',
              dataType: 'json',
              success: function (data) {
                $('#sub-cat-id').val(data['category_id']);
                $('#sub-cat-name').val(data['sub_category_name']);
                $('#sub-cat-code').val(data['sub_category_code']);
                $('#sub-cat-status').val(data['sub_category_status']);
              }
          });
    }
});

$('.delete-sub-cat').on('click',function () {
    var id = $(this).attr('delete-id');
    if( id != '') {
        var action = $(this).attr('action');
        $('#delete-sub-cat-form').attr('action', action);
    }
})