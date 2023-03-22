$(document).ready(function () {
    $('.razorpay_btn').click(function (e) {
        e.preventDefault();


        var firstname = $('.firstname').val();
        var lastname = $('.lastname').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var address1 = $('.address1').val();
        var address2 = $('.address2').val();
        var city = $('.city').val();
        var pincode = $('.pincode').val();

        if(!firstname)
        {
            fname_error = "Họ không được để trống";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        }else
        {
            fname_error = "";
            $('#fname_error').html('');
        }

        if(!lastname)
        {
            lname_error = "Tên không được để trống";
            $('#lname_error').html('');
            $('#lname_error').html(lname_error);
        }else
        {
            lname_error = "";
            $('#lname_error').html('');
        }

        if(!email)
        {
            email_error = "email không được để trống";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        }else
        {
            email_error = "";
            $('#email_error').html('');
        }

        if(!phone)
        {
            phone_error = "phone không được để trống";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        }else
        {
            phone_error = "";
            $('#phone_error').html('');
        }

        if(!address1)
        {
            address1_error = "Địa chỉ không được để trống";
            $('#address1_error').html('');
            $('#address1_error').html(address1_error);
        }else
        {
            address1_error = "";
            $('#address1_error').html('');
        }


        if(!address2)
        {
            address2_error = "Địa chỉ không được để trống";
            $('#address2_error').html('');
            $('#address2_error').html(address2_error);
        }else
        {
            address2_error = "";
            $('#address2_error').html('');
        }

        if(!city)
        {
            city_error = "Địa chỉ không được để trống";
            $('#city_error').html('');
            $('#city_error').html(city_error);
        }else
        {
            city_error = "";
            $('#city_error').html('');
        }

        if(!pincode)
        {
            pincode_error = "Zip code không được để trống";
            $('#pincode_error').html('');
            $('#pincode_error').html(pincode_error);
        }else
        {
            pincode_error = "";
            $('#pincode_error').html('');
        }
        if(fname_error != ''|| lname_error != '' || email_error != '' || phone_error != '' || address1_error != ''|| address2_error != '' || city_error != '' || pincode_error != '')
        {
            return false;
        }else
        {
            var data = {
             'firstname':firstname,
             'lastname':lastname,
             'email':email,
             'phone':phone,
             'address1':address1,
             'address2':address2,
             'city':city,
             'pincode':pincode
            }

           $.ajax({
            method: "POST",
            url: "/proceed-to-pay",
            data: data,
            success: function (response) {

                var options = {
                    "key": "rzp_test_w1dNs5gBAuJLXD", // Enter the Key ID generated from the Dashboard
                    "amount": response.total_price*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": response.firstname+' '+response.lastname, //your business name
                    "description": "Cảm ơn vì đã ủng hộ shop",
                    "image": "https://example.com/your_logo",
                    // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (responsea){

                        $.ajax({
                          method:"POST",
                            url: "/place-order",
                            data: {
                                'fname':response.firstname,
                                'lname':response.lastname,
                                'phone':response.phone,
                                'email':response.email,
                                'address1':response.address1,
                                'address2':response.address2,
                                'city':response.city,
                                'pincode':response.pincode,
                                'payment_mode':"Thanh toán qua Razorpay",
                                'payment_id':responsea.razorpay_payment_id
                            },
                            success: function (responseb) {
                                //alert(responseb.status);
                                swal(responseb.status).then((value) => {
                                    window.location.href = "/my-order";
                                  });

                            }
                        });

                    },
                    "prefill": {
                        "name": response.firstname+' '+response.lastname,  //your customer's name
                        "email": response.email,
                        "contact": response.phone
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                    rzp1.open();
            }
           });
        }
    });
});
