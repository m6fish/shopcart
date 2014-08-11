//RFish 2014
$(document).ready(function () {

    //Auto add price and num
    $('.cart_table').change(function () {
        var total =0;
        $('.buy_row').each(function(key, val){
            var price = parseInt($('td.price', this).text());
            var num = $('select.num',this).val();
            
            return total += price * num;
        });
        //console.log(total);
        $('label.total').text(total);
    }).trigger( "change" );
    
    // show edit hint
    $('.cart_table select.num').hover(
        function(){
            var row = $(this).parent().parent();
            $('#edit_hint', row).fadeIn(500);
        },
        function(){
            var row = $(this).parent().parent();
            $('#edit_hint', row).fadeOut(800);
        }
    );
    
    // AJAX Edit
    $('.cart_table select.num').change(function(){
        var row = $(this).parent().parent();
        var newNum = $(this).val();
        var uid = parseInt($('#uid', row).text());
        var pid = parseInt($('#pid', row).text());
        
        //AJAX POST
        var send = {'uid':uid ,'pid': pid ,'newNum':newNum };
        ajaxPost('2',send);
    });
    
    //AJAX Delete
    $('.del_btn').click(function () {
        var row = $(this).parent();
        var uid = parseInt($('#uid', row).text());
        var pid = parseInt($('#pid', row).text());
        
        //Hide the current row , change the price to 0 & change the total
        row.addClass('hidden');
        $('td.price', row).text(0)
        $('.cart_table').trigger( "change" );
        
        //AJAX POST
        var send = {'uid':uid ,'pid': pid };
        ajaxPost('-1',send);
    
    });
    
    //AJAX Add
    $('.add').click(function () {
        var fieldset = $(this).parent();
        var uid = parseInt($('#uid', fieldset).text());
        var pid = parseInt($('#pid', fieldset).text());
    
        if ('-1' == uid) {
            alert('login not yet!');
            
        //AJAX POST
        } else {
            var send = {'uid':uid ,'pid': pid };
            ajaxPost('1',send);
        }
    });
    
    //Open Login Form
    $('#login').click(function () {
        //show login form, Add the mask to body
        $('.login_form').fadeIn(500);
        $('body').append('<div id="mask"></div>');
        $('#mask').fadeIn(300);
    });
    
    // When clicking on the mask layer close the login form.
    $('body').on("click", '#mask', function () {
        $('#mask').fadeOut(300, function () {
            $('#mask').remove();
        });
        $('.login_form').fadeOut(500);
        return false;
    });
    
    
    //AJAX LogIn
    $('.login_btn').click(function () {
        //Get user form data
        var user = $('#user_name').val();
        var pw= $('#user_pw').val();
        
         //AJAX POST
        var send = {'user':user ,'pw': pw };
        ajaxPost('3',send);
        
    });
    
    //AJAX LogOut
    $('#logout').click(function () {
        //AJAX POST
        var send = {'logOut':'0'};
        ajaxPost('4',send);
    });
    
    
    
    
    /***AJAX POST***
        mode {
            -1 for delete
            0 for get now(view)
            1 for add
            2 for edit
            3 for login
            4 for logout
        }
        
    */
    function ajaxPost(mode, send) {
        console.log('mode: ' + mode); 
        console.log('send: ' + $.param( send )); 
        
        var result = 0;
        
        if(mode == '-1') {
            var url = 'http://127.0.0.1/sample/shopcar/function/delete.php'
        } else if (mode == '0'){
            //var url = 'http://127.0.0.1/sample/shopcar/function/view.php'
        } else if (mode =='1') {
            var url = 'http://127.0.0.1/sample/shopcar/function/add.php'
        } else if (mode =='2') {
            var url = 'http://127.0.0.1/sample/shopcar/function/edit.php'
        } else if (mode =='3') {
            var url = 'http://127.0.0.1/sample/shopcar/function/logIn.php'
        } else if (mode =='4') {
            var url = 'http://127.0.0.1/sample/shopcar/function/logOut.php'
        } else {
            alert('AJAX mode Error!');
            return result;
        }
        
        $.ajax({
            url: url,
            data: send,
            type:"POST",
            dataType:'json',
            //async:false,

            success: function(msg){
                console.log(msg);
                alert(msg['errorMessage']);
                
                //log in success,
                if (msg['errorCode'] == '0' && mode==3) {
                    logInSuccHandler();
                }
                
                //log out success,
                if (msg['errorCode'] == '0' && mode==4) {
                    logOutSuccHandler();
                }
                
                
            },

             error:function(xhr, ajaxOptions, thrownError){ 
                console.log(xhr.status); 
                console.log(thrownError); 
             }
        });
        
    }
    
    //hide logIn + login form + mask, show logOut
    function logInSuccHandler (){
        $('.login_form').fadeOut(500);
        $('#login').fadeOut(500);
        $('#logout').delay(500).fadeIn(500);
        
        $('#mask').fadeOut(300, function () {
            $('#mask').remove();
        });
    }
    
    //refresh page
    function logOutSuccHandler (){
        location.reload(true);
    }
    
});