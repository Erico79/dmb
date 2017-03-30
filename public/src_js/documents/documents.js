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