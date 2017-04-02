var Doc = {
    selectCustomer: function () {
        $('#select_customer').fadeIn('slow', function () {
            $('select[name=customer]').attr('required', 'required').removeAttr('disabled');

            $('#select_supplier').fadeOut('slow', function () {
                $('select[name=supplier]').removeAttr('required').attr('disabled', 'disabled');
            });
        });
    },
    selectSupplier: function (){
        $('#select_supplier').fadeIn('slow', function () {
            $('select[name=supplier]').attr('required', 'required').removeAttr('disabled');

            $('#select_customer').fadeOut('slow', function () {
                $('select[name=customer]').removeAttr('required').attr('disabled', 'disabled');
            });
        });
    },
    hideSelectors: function () {
        $('#select_supplier, #select_customer').fadeOut('slow');
    },
    loadSubCategories: function (cat_id) {
        if(cat_id != ''){
            $.ajax({
                url: 'load-subcategories/' + cat_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var sub_cats = '<option value="">--Choose Sub Category--</option>';
                    for(var i = 0; i < data.length; i++){
                        sub_cats += '<option value="'+ data[i].id +'">' + data[i].category_name + '</option>';
                    }

                    console.log(sub_cats);
                    $('#sub_category').show();
                    $('#sub_category select').html(sub_cats);
                }
            });
        } else {
            $('#sub_category').hide();
            $('#sub_category select').val('');
        }
    }
};

$('#attach_to').on('change', function () {
    var choice = $(this).val();

    if(choice == 'customer')
        Doc.selectCustomer();
    else if(choice == 'supplier')
        Doc.selectSupplier();
    else
        Doc.hideSelectors();
});

// delete document
$('#delete-doc').on('click', function () {
   if(confirm('Are you sure you want to delete the document?')) {
       // submit hidden form
       $('form#delete-document').submit();
   } else {
       return false;
   }
});

// load subcategories
$('#category').on('change', function () {
    var cat = $(this).val();

    Doc.loadSubCategories(cat);
});