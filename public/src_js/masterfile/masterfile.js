// start form wizard validation
var FormWizard = function () {

    var form1 = $('#form_sample_1');
    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            // default form wizard
            $('#form_wizard_2').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index) {
                    alert('on tab click disabled');
                    return false;
                },
                onNext: function (tab, navigation, index) {
                    // validate
                    var valid = Masterfile.validateMyWizard();
                    if(!valid){
                        return false;
                    }

                    var total = navigation.find('li').length;
                    var current = index + 1;

                    // validate address details
                    if(current == 3){
                        alert(current);
                        var valid2 = Masterfile2.validateMyWizard2();
                        if(!valid2){
                            return false;
                        }
                    }

                    // set wizard title
                    $('.step-title', $('#form_wizard_2')).text('Step ' + (index + 1) + ' of ' + total);
                    // set done steps
                    jQuery('li', $('#form_wizard_2')).removeClass("done");
                    var li_list = navigation.find('li');
                    for (var i = 0; i < index; i++) {
                        jQuery(li_list[i]).addClass("done");
                    }

                    if (current == 1) {
                        $('#form_wizard_2').find('.button-previous').hide();
                    } else {
                        $('#form_wizard_2').find('.button-previous').show();
                    }

                    if (current >= total) {
                        $('#form_wizard_2').find('.button-next').hide();
                        $('#form_wizard_2').find('.button-submit').show();
                    } else {
                        $('#form_wizard_2').find('.button-next').show();
                        $('#form_wizard_2').find('.button-submit').hide();
                    }
                    App.scrollTo($('.page-title'));
                },
                onPrevious: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    // set wizard title
                    $('.step-title', $('#form_wizard_2')).text('Step ' + (index + 1) + ' of ' + total);
                    // set done steps
                    jQuery('li', $('#form_wizard_2')).removeClass("done");
                    var li_list = navigation.find('li');
                    for (var i = 0; i < index; i++) {
                        jQuery(li_list[i]).addClass("done");
                    }

                    if (current == 1) {
                        $('#form_wizard_2').find('.button-previous').hide();
                    } else {
                        $('#form_wizard_2').find('.button-previous').show();
                    }

                    if (current >= total) {
                        $('#form_wizard_2').find('.button-next').hide();
                        $('#form_wizard_2').find('.button-submit').show();
                    } else {
                        $('#form_wizard_2').find('.button-next').show();
                        $('#form_wizard_2').find('.button-submit').hide();
                    }

                    App.scrollTo($('.page-title'));
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_2').find('.bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_2').find('.button-previous').hide();
            $('#form_wizard_2 .button-submit').click(function () {
                //alert('Finished! Hope you like it :)');
            }).hide();
        }
    };
}();

//on tab next validations
var Masterfile = {
    validateMyWizard: function(){
        if($('#b_role').val() == ''){
            alert('You must provide a Business Role!');
            $('#b_role').focus();
            return false;
        }

        var b_role = $('#b_role').val();
        switch(b_role){
            case 'Administrator':
                // validation
                if($('#surname').val() == ''){
                    alert('You Must Provide Surname!');
                    $('#surname').focus();
                    return false;
                }else if($('#firstname').val() == ''){
                    alert('You Must Provide First Name!');
                    $('#firstname').focus();
                    return false;
                }else if($('#email').val() == ''){
                    alert('You Must Provide Email!');
                    $('#email').focus();
                    return false;
                }else if($('#user_role').val() == ''){
                    alert('You Must Provide User Role!');
                    $('#user_role').focus();
                    return false;
                }else if($('#customer_type_name').val() == ''){
                    alert('You Must Provide Masterfile Type!');
                    $('#customer_type_name').focus();
                    return false;
                }else{
                    return true;
                }
                break;

            case 'Customer':
                // validation
                if($('#surname').val() == ''){
                    alert('You Must Provide Surname!');
                    $('#surname').focus();
                    return false;
                }else if($('#firstname').val() == ''){
                    alert('You Must Provide First Name!');
                    $('#firstname').focus();
                    return false;
                }else if($('#email').val() == ''){
                    alert('You Must Provide Email!');
                    $('#email').focus();
                    return false;
                }else if($('#id_passport').val() == ''){
                    alert('You Must Provide Id/Passport!');
                    $('#id_passport').focus();
                    return false;
                }else if($('#gender').val() == ''){
                    alert('You Must Provide Gender!');
                    $('#gender').focus();
                    return false;
                // }else if($('#user_role').val() == ''){
                //     alert('You Must Provide User Role!');
                //     $('#user_role').focus();
                //     return false;
                }else if($('#customer_type_name').val() == ''){
                    alert('You Must Provide Masterfile Type!');
                    $('#customer_type_name').focus();
                    return false;
                }else{
                    return true;
                }
                break;

            case 'Staff':
                if($('#surname').val() == ''){
                    alert('You Must Provide Surname!');
                    $('#surname').focus();
                    return false;
                }else if($('#firstname').val() == ''){
                    alert('You Must Provide First Name!');
                    $('#firstname').focus();
                    return false;
                }else if($('#id_passport').val() == ''){
                    alert('You Must Provide Id/Passport!');
                    $('#id_passport').focus();
                    return false;
                }else if($('#id_passport').val() == ''){
                    alert('You Must Provide Id/Passport!');
                    $('#id_passport').focus();
                    return false;
                }else if($('#gender').val() == ''){
                    alert('You Must Provide Gender!');
                    $('#gender').focus();
                    return false;
                }else if($('#email').val() == ''){
                    alert('You Must Provide Email!');
                    $('#email').focus();
                    return false;
                }else if($('#user_role').val() == ''){
                    alert('You Must Provide User Role!');
                    $('#user_role').focus();
                    return false;
                }else if($('#customer_type_name').val() == ''){
                    alert('You Must Provide Masterfile Type!');
                    $('#customer_type_name').focus();
                    return false;
                }else{
                    return true;
                }
            break;

            case 'Supplier':
                if($('#surname').val() == ''){
                    alert('You Must Provide Surname!');
                    $('#surname').focus();
                    return false;
                }else if($('#firstname').val() == ''){
                    alert('You Must Provide First Name!');
                    $('#firstname').focus();
                    return false;
                }else if($('#id_passport').val() == ''){
                    alert('You Must Provide Id/Passport!');
                    $('#id_passport').focus();
                    return false;
                }else if($('#id_passport').val() == ''){
                    alert('You Must Provide Id/Passport!');
                    $('#id_passport').focus();
                    return false;
                }else if($('#gender').val() == ''){
                    alert('You Must Provide Gender!');
                    $('#gender').focus();
                    return false;
                }else if($('#email').val() == ''){
                    alert('You Must Provide Email!');
                    $('#email').focus();
                    return false;
                // }else if($('#user_role').val() == ''){
                //     alert('You Must Provide User Role!');
                //     $('#user_role').focus();
                //     return false;
                }else if($('#customer_type_name').val() == ''){
                    alert('You Must Provide Masterfile Type!');
                    $('#customer_type_name').focus();
                    return false;
                }else{
                    return true;
                }
                break;
        }
    },
}

// masterfile address details validation
var Masterfile2 = {
    validateMyWizard2: function(){
        if($('#county').val() == ''){
            alert('You must provide County Name!');
            $('#county').focus();
            return false;
        }else if($('#town').val() == ''){
            alert('You must provide Town/City for the selected County!');
            $('#town').focus();
            return false;
        }else if($('#phone').val() == ''){
            alert('You must provide Provide Phone Number!');
            $('#phone').focus();
            return false;
        }else if($('#box').val() == ''){
            alert('You must provide Box Number!');
            $('#box').focus();
            return false;
        }else if($('#postal_code').val() == ''){
            alert('You must provide Postal Code!');
            $('#postal_code').focus();
            return false;
        }else if($('#address_type_id').val() == ''){
            alert('You must provide Address Type!');
            $('#address_type_id').focus();
            return false;
        }else{
            return true;
        }
    },
}

$('#b_role').on('change', function(){
    var role = $(this).val();

    if(role == 'Customer'){
        // alert('working');
        $('#user_role').attr('disabled', 'disabled');
    }else if(role == 'Staff'){
        $('#user_role').attr('readonly', 'readonly').val('STAFF');
    }else if(role == 'Supplier'){
        $('#user_role').attr('disabled', 'disabled');
    }else if(role == 'Administrator'){
        $('#user_role').attr('readonly', 'readonly').val('SYS_ADMIN');
    }
});