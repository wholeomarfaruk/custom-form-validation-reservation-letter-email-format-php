const mailForm =$('#messageForm');
const sendBtn = $('#send_btn');
const fullName= $("input[name*='fullName'");
const email= $("input[name*='email'");
const phoneNumber= $("input[name*='phoneNumber'");
const date= $("input[name*='date'");
const estartTime= $("input[name*='starttime'");
const eendTime= $("input[name*='endtime'");
const numberOfPerson= $("input[name*='numberOfPerson'");
const incoming_address= $("input[name*='incoming_address'");
const msg= $("textarea[name*='msg'");


function form_value_catch(){
    // form value 
var form_value= [{
fullName: fullName.val(),
email: email.val(),
phoneNumber: phoneNumber.val().toString(),
date: date.val().toString(),
starttime: estartTime.val().toString(),
endtime: eendTime.val().toString(),
numberOfPerson: numberOfPerson.val().toString(),
incoming_address: incoming_address.val(),
msg: msg.val()
}]

}



function mail_send(form_value){
    var stringdata = form_value;
    $.ajax({
        type: "POST",
        url: "./assets/server/mail_server.php",
        data:  stringdata,
        dataType: 'json',
        beforeSend: function() {
            $("#send_btn").html("Sending...");
        },
        success: function(data){
            setTimeout(function(){

                if(data.status=='error'){
                    $('#send_btn').html(data.error);
                }else if(data.status=='success'){
                    $('#send_btn').html(data.status);
                }else{
                    $('#send_btn').html('No response found.');
                }
               //$('#result').html("<pre>"+data.status);
                //JSON.stringify(data)
            },2000);

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#send_btn').html("Send error!");
        },
        
    });
}


// bootstrap tooltips 
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  //time validation 

  function checkTimings(argument) {
    var sTime = new Date($("[id$=txtStartTimings]").val());
    var eTime = new Date($("[id$=txtEndTimings]").val());
    argument.IsValid = sTime < eTime;
}




 
// $('').on('change',function(){


//     var current_date=new Date();
//     var current_time= new Date().toLocaleTimeString();
//     console.log("local time", current_time);
//     var plan_date = $("#plan_date").val();
//     var start_time = $("#stime").val();
//     var current_date_value= current_date.valueOf();
//     var plan_date_value= new Date(plan_date+ ' '+ current_time).valueOf();


//     //end time
//     var end_time = $("#etime").val();
//     console.log("curnt date:",current_date );
//     console.log("plan date:", new Date(plan_date+ ' '+ current_time));
//     var date_value = plan_date_value - current_date_value;

//     console.log("curnt date:",current_date_value );
//     console.log("plan date:", plan_date_value);
//     console.log('substraction: ',plan_date_value - current_date_value);
//     if(date_value<0){
//        // $("#plan_date").after('<lebel class="error mt-0 text-danger">Select Date From next day.</lebel>');
//     }

// var start = new Date(plan_date+' '+start_time);
// var end = new Date(plan_date+' '+end_time);

// var hrs = end.getHours() - start.getHours();
// var min = end.getMinutes() - start.getMinutes(); 
// var sec = end.getSeconds() - start.getSeconds();  

// var hour_carry = 0;
// var minutes_carry = 0;
// if(min < 0){
//        min += 60;
//        hour_carry += 1;
//    }
// hrs = hrs - hour_carry;
// if(sec < 0){
//        sec += 60;
//        minutes_carry += 1;
//    }

// min = min - minutes_carry;

// // console.log("hrs",hrs);
// // console.log("min",min);
// // console.log("sec",sec);
// // console.log(hrs + "hrs " + min +"min " + sec + "sec");

// });

// datepicker
// Contains Victorian public holidays which date selection needs to be restricted

$('#plan_date').datepicker({
    dateFormat: 'yy-mm-dd',
    firstDay: 6,
    minDate: '+1d',
    maxDate: '1m',
      /**
     * A function that takes a date as a parameter and must return an array with:
     * [0]: true/false indicating whether or not this date is selectable
     * [1]: a CSS class name to add to the date's cell or "" for the default presentation
     * [2]: an optional popup tooltip for this date
     * 
     */
      beforeShowDay: function(date) {
        return [!(date.getDay()==5)]
     }

});

// form validation



const fname = $('#fullName');

const phone = $('#number');
const dateOnly = $('#plan_date');
const startTime = $('#stime');
const endTime = $('#etime');
const numberValueOnly = $('#numberofperson');
const address = $('#incoming_address');

var cFormData = {
    name: fname,
    email: email,
    phone: phone,
    dateOnly: dateOnly,
    startTime: startTime,
    endTime:endTime,
    numberValueOnly: numberValueOnly,
    address: address
};




function formValidation(cFormData){
    // console.log("Data: ");
    // console.log(cFormData);

    
    // input value assign in variabl
   var name = $(cFormData.name).val();
    // console.log("Name value: ",name);            
   var email = $(cFormData.email).val();
    // console.log("email value: ",email);
   var phone = $(cFormData.phone).val();
    // console.log("phone value: ",phone);
   var dateOnly = $(cFormData.dateOnly).val();
    // console.log("dateOnly value: ",dateOnly);
   var startTime = $(cFormData.startTime).val();
    // console.log("startTime value: ",startTime);
   var endTime = $(cFormData.endTime).val();
    // console.log("endTime value: ",endTime);
   var numberValueOnly = $(cFormData.numberValueOnly).val();
    // console.log("numberValueOnly value: ",numberValueOnly);
   var address = $(cFormData.address).val();
    // console.log("address value: ",address);

    var msgfname= 'Enter at least 2 Character.';
    var msgemail = 'Enter your valid Email.';
    var msgphone = 'Enter your valid phone.';
    var msgdateOnly = 'Enter a valid Date (YYYY-MM-DD).';
    var msgstartTime = 'Enter a valid Time.';
    var msgendTime = 'Enter a valid Time.';
    var msgnumberValueOnly = 'Enter a valid Number only.';
    var msgaddress = 'Enter a valid Address.';

    var errorMsg = {
        name: msgfname,
        email: msgemail,
        phone: msgphone,
        dateOnly: msgdateOnly,
        startTime: msgstartTime,
        endTime: msgendTime,
        numberValueOnly: msgnumberValueOnly,
        address: msgaddress
    };

    //error element findorappend funtion
    $.fn.findOrAppend = function(selector,errorMsg) {
        var elements = $(selector).nextAll('span').length;
        // console.log(selector);
        // console.log(elements);

        switch(elements) {
            case 0:
                $(selector).after('<span class="ps-1 text-danger small">'+errorMsg+'</span>');
              break;
            case 1:
              // code block
              break;
            default:
                $(selector).after('<span class="ps-1 text-danger small">'+errorMsg+'</span>');
          };
    }

    // Validation Pattern 
    var emailFormat = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var phoneFormat = /\+?1?\s*\(?-*\.*(\d{3})\)?\.*-*\s*(\d{3})\.*-*\s*(\d{4})$/;
    var dateFormat = /^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/;
    var timeFormat = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
    var numberOnlyFormat = /^[0-9]/;

    if(name.length<2) {
        $(cFormData.name).findOrAppend(cFormData.name,errorMsg.name);
    }else{
        $(cFormData.name).nextAll().remove();
    };
    if(!emailFormat.test(email)) {
        $(cFormData.email).findOrAppend(cFormData.email,errorMsg.email);
    }else{
        $(cFormData.email).nextAll().remove();
    };
    if(!phoneFormat.test(phone)) {
        $(cFormData.phone).findOrAppend(cFormData.phone,errorMsg.phone);
    }else{
        $(cFormData.phone).nextAll().remove();
    };
    if(!dateFormat.test(dateOnly)) {
        $(cFormData.dateOnly).findOrAppend(cFormData.dateOnly,errorMsg.dateOnly);
    }else{
        $(cFormData.dateOnly).nextAll().remove();
    };
    if(!timeFormat.test(startTime)) {
        $(cFormData.startTime).findOrAppend(cFormData.startTime,errorMsg.startTime);
    }else{
        $(cFormData.startTime).nextAll().remove();
    };
    if(!timeFormat.test(endTime)) {
        $(cFormData.endTime).findOrAppend(cFormData.endTime,errorMsg.endTime);
    }else{
        $(cFormData.endTime).nextAll().remove();
    };
    if(!numberOnlyFormat.test(numberValueOnly)) {
        $(cFormData.numberValueOnly).findOrAppend(cFormData.numberValueOnly,errorMsg.numberValueOnly);
    }else{
        $(cFormData.numberValueOnly).nextAll().remove();
        return true;
    };

    

};


$("#messageForm").on('change',function(){
    formValidation(cFormData);
});

sendBtn.on('click',function(){
    // console.log(fullName.val(),email.val(),phoneNumber.val(),date.val(),time.val(),numberOfPerson.val(),msg.val());
    form_value_catch()

    var form_value= {
     fullName: fullName.val(),
     email: email.val(),
     phoneNumber: phoneNumber.val(),
     date: date.val(),
     starttime: estartTime.val(),
     endtime: eendTime.val(),
     numberOfPerson: numberOfPerson.val(),
     incoming_address: incoming_address.val(),
     msg: msg.val()
     }
     form_value= JSON.stringify(form_value);
     //mail_send(form_value)

     //console.log('Value: ',form_value);

     if (formValidation(cFormData)) {
         //console.log("Success validation");
         mail_send(form_value);
     }else{
        //  console.log("Failed validation");

     }

 })