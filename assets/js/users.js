function login()
{
    $.ajax({
        url: base_url+'pos/login',
        type: 'post',
        dataType: 'JSON',
        data: $('#frmLogin').serialize(),
        beforeSend: function(){
            $('#btnLogin').button('loading')
            $('.login-panel .alert').hide()
        },
        success: function(data){
            if( data.success )
                window.location = data.r
            else
            {
                $('.login-panel .alert').show()
                $('#btnLogin').button('reset')
            }
        }
    })
}