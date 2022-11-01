jQuery(document).ready(function( $ ){
    
    $('form').submit(function(e){
        e.preventDefault();
    });

    $('form button').click(function(){
        let data = {
            name: $('#floatingName').val(),
            surname: $('#floatingSurname').val(),
            email: $('#floatingEmail').val(),
            password: $('#floatingPassword').val(),
            confirm: $('#floatingConfirm').val()
        }

        $.ajax({
            url: '/validate.php',
            method: 'post',
            dataType: 'json',
            data: data,
            success: function(data){
                // console.log(data);
                if(data['class'] == 'alert-success') {
                    $('form').hide();
                }
                $('.alert').removeClass().addClass('alert ' + data['class']).html(data['message']); 
            }
        });


    });
});
