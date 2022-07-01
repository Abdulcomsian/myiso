<style>.iti.iti--allow-dropdown.iti--separate-dial-code{width: 100%;}</style>
<?php $id=Auth::user()->id;?>
<script type="text/javascript">

	/*================CONTACT INIT====================*/
    function update_user_notifications_badge(){
    $.ajax({
    url: "<?php echo e(url('/get_user_inbox_count')); ?>",
    type: "POST",
    data: {
    "_token": "<?php echo e(csrf_token()); ?>",
    id: <?php echo e($id); ?>,
    },

    }).done(function(resp) {
    if(resp != 0){
    $('#notifications>a>span.count_notifications').html(resp);
    }else{
    $('#notifications>a>span.count_notifications').hide();
    }
    });
    }
    function update_admin_notifications_badge(){
    $.ajax({
    url: "<?php echo e(url('/get_admin_inbox_count')); ?>",
    type: "POST",
    data: {
    "_token": "<?php echo e(csrf_token()); ?>",
    id: <?php echo e($id); ?>,
    },

    }).done(function(resp) {
    if(resp != 0){
    $('#admin_notifications>a>span.count_notifications').html(resp);
    }else{
    $('#admin_notifications>a>span.count_notifications').hide();
    }
    });
    }

    setTimeout(	update_user_notifications_badge(), 1000);
    setTimeout(	update_admin_notifications_badge(), 1000);

    $(function(){

    setTimeout(	update_user_notifications_badge(), 1000);
    setTimeout(	update_admin_notifications_badge(), 1000);

    });



     $(".read_it").on('click',function(){
         console.log('what the....!');
    	 let the_id = $(this).data('id'), user = $(this).data('user'), the_bolding_class = $(this).closest('tr.New').removeClass('New');

    	console.log('ID: '+the_id+' User: '+user);


        $.ajax({
        url: "<?php echo e(url('/upd_msg_status')); ?>",
        type: "POST",
        data: {
        "_token": "<?php echo e(csrf_token()); ?>",
        id: the_id,
        user_type: user
          },

        }).done(function(resp) {
        update_admin_notifications_badge();
        update_user_notifications_badge();
        console.log( resp );
        });


    });

	/*================CONTACT FINISH====================*/

     jQuery(".validate_number").bind('keyup blur',function(){
         var value=parseInt($(this).val());
         if(value>10000000)
         {
             $(this).val('');
         }
         else if(value<1)
         {
             $(this).val('');
         }

    });

     jQuery(".validate_number_z").bind('keyup blur',function(){
         var value=parseInt($(this).val());
         if(value>10000000)
         {
             $(this).val('');
         }
         else if(value<0)
         {
             $(this).val('');
         }

     });
    jQuery('.alpha-only').bind('keyup blur',function(){
        //console.log('reaching....');
        var node = $(this);
        node.val(node.val().replace(/[^a-zA-Z]/gs,'') );
    });



// /**************###***********/
//     var input = document.querySelector("#phone");
//     window.intlTelInput(input, {
//         separateDialCode: true,
//         customPlaceholder: function (
//             selectedCountryPlaceholder,
//             selectedCountryData
//         ) {
//             return "e.g. " + selectedCountryPlaceholder;
//         },
//     });
//      var input = document.querySelector("#contact_iso");
//     window.intlTelInput(input, {
//         separateDialCode: true,
//         customPlaceholder: function (
//             selectedCountryPlaceholder,
//             selectedCountryData
//         ) {
//             return "e.g. " + selectedCountryPlaceholder;
//         },
//     });
</script>
<?php /**PATH /home/hashir/Documents/myiso/resources/views/script.blade.php ENDPATH**/ ?>