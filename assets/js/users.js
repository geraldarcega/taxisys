function login()
{
    $.ajax({
        url: base_url+'dashboard/login',
        type: 'post',
        dataType: 'JSON',
        data: $('#frmLogin').serialize(),
        beforeSend: function(){
            $('#btnLogin').button('loading')
            $('.login-panel .alert').hide()
        },
        success: function(data){
            if( data.success )
                window.location = base_url+"dashboard"
            else
            {
                $('.login-panel .alert').show()
                $('#btnLogin').button('reset')
            }
        }
    })
}