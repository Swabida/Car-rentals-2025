 $(document).ready(function() {
    // Form validation
    $('#carForm').validate({
        rules: {
            make: {
                required: true,
                minlength: 2
            },
            model: {
                required: true,
                minlength: 2
            },
            year: {
                required: true,
                digits: true,
                min: 1900,
                max: new Date().getFullYear() + 1
            },
            price: {
                required: true,
                number: true,
                min: 0
            },
            rental_price: {
                required: true,
                number: true,
                min: 0
            },
            status: {
                required: true
            }
        },
        messages: {
            make: {
                required: 'Make is required',
                minlength: 'Make must be at least 2 characters'
            },
            model: {
                required: 'Model is required',
                minlength: 'Model must be at least 2 characters'
            },
            year: {
                required: 'Year is required',
                digits: 'Year must be a number',
                min: 'Year must be after 1900',
                max: 'Year must be in the future'
            },
            price: {
                required: 'Price is required',
                number: 'Price must be a number',
                min: 'Price must be at least 0'
            },
            rental_price: {
                required: 'Rental price is required',
                number: 'Rental price must be a number',
                min: 'Rental price must be at least 0'
            },
            status: {
                required: 'Status is required'
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    // Login form validation
    $('#loginForm').validate({
        rules: {
            username: {
                required: true,
                minlength: 3
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            username: {
                required: 'Username is required',
                minlength: 'Username must be at least 3 characters'
            },
            password: {
                required: 'Password is required',
                minlength: 'Password must be at least 6 characters'
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    // Register form validation
    $('#registerForm').validate({
        rules: {
            full_name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            username: {
                required: true,
                minlength: 3
            },
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: '#password'
            }
        },
        messages: {
            full_name: {
                required: 'Full name is required',
                minlength: 'Full name must be at least 3 characters'
            },
            email: {
                required: 'Email is required',
                email: 'Please enter a valid email address'
            },
            username: {
                required: 'Username is required',
                minlength: 'Username must be at least 3 characters'
            },
            password: {
                required: 'Password is required',
                minlength: 'Password must be at least 6 characters'
            },
            confirm_password: {
                required: 'Confirm password is required',
                minlength: 'Password must be at least 6 characters',
                equalTo: 'Passwords do not match'
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});