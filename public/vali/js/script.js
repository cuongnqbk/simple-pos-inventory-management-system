/*var monthName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

$(function(){
    $('.datepicker').datepicker();
});
function formatDate(date){
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
$(function(){
    $('.datepicker').change(function(){
        var date = $(this).val();
        $(this).val(formatDate(date));
    });
});


$(function(){
    $('#status').change(function(){
        $('#status_value').val($('#status option:selected').text());
    });
});
$(function(){
    $('.generateRent .datepicker').change(function(){
        var pickedDate = $(this).val();
        var date = new Date(pickedDate);
        var month = date.getMonth();
        var year = date.getFullYear();
        var monthDate = monthName[month]+', '+year;
        $(this).val(monthDate);
    });
});*/

$(function(){
    /*$('#room_id').bind('change', function() { 
    $.ajax({ 
        url:  'rooms-ajax', 
        type: json
        data: $foo,  
        success: function(data) {
            $('input .targetAjax').val(data.newValue);
            console.log(data);
        });
    );*/

    /* Resident Create */
    $('.residence #room_id').bind('change', function() { 
        var room_id = $('#room_id').val();
        var token = $('input[name=_token]').val();
        var rent = $('#rent').val();
        $.ajax({
            type: "POST",
            url:  '/roomAjaxPost',
            dataType: 'json',
            data: {
                'room_id' : room_id,
                '_token' : token,
                'rent' : rent
            },
            success: function(data) { 
                var id = $('#room_id').val();
                var index = data.findIndex(x => x.id== id);
                var rent = data[index].rent;
                $('#rent').val(rent);
            }/*,
            error: function(res) {
                alert('wrong');
                //console.log(res.responseText);
            }*/
        });
    });

    /* Receive Payment */
    $('.receivePayment #resident_id').bind('change', function() { 
        var resident = $('#resident_id').val();
        var token = $('input[name=_token]').val();
        $.ajax({
            type: "POST",
            url:  '/residentAjaxPost',
            dataType: 'json',
            data: {
                '_token' : token,
                'resident_id' : resident
            },
            success: function(data) { 
                var id = $('#resident_id').val();
                var index = data.findIndex(x => x.id== id);
                var due = data[index].due;
                //var due = data[index].due;
                $('#due').val(due);
            }/*,
            error: function(res) {
                alert('wrong');
                //console.log(res.responseText);
            }*/
        });
    });
    /* Receive Payment */
    $('.receivePayment #paid_amount').change(function() { 
        var paid_amount = $('#paid_amount').val();
        var due = $('#due').val();
        var new_due = due - paid_amount;
        $('#new_due').val(new_due);
    });
});