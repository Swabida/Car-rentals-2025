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
                required: 'Please confirm your password',
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
    
    // User form validation
    $('#userForm').validate({
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
            },
            role: {
                required: true
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
                required: 'Please confirm your password',
                minlength: 'Password must be at least 6 characters',
                equalTo: 'Passwords do not match'
            },
            role: {
                required: 'Role is required'
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
    
    // Blog form validation
    $('#blogForm').validate({
        rules: {
            title: {
                required: true,
                minlength: 5
            },
            content: {
                required: true,
                minlength: 20
            }
        },
        messages: {
            title: {
                required: 'Title is required',
                minlength: 'Title must be at least 5 characters'
            },
            content: {
                required: 'Content is required',
                minlength: 'Content must be at least 20 characters'
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
    
    // Booking form validation
    $('#bookingForm').validate({
        rules: {
            car_id: {
                required: true
            },
            customer_name: {
                required: true,
                minlength: 3
            },
            customer_email: {
                required: true,
                email: true
            },
            start_date: {
                required: true,
                date: true
            },
            end_date: {
                required: true,
                date: true,
                greaterThan: '#start_date'
            },
            status: {
                required: true
            }
        },
        messages: {
            car_id: {
                required: 'Please select a car'
            },
            customer_name: {
                required: 'Customer name is required',
                minlength: 'Customer name must be at least 3 characters'
            },
            customer_email: {
                required: 'Customer email is required',
                email: 'Please enter a valid email address'
            },
            start_date: {
                required: 'Start date is required',
                date: 'Please enter a valid date'
            },
            end_date: {
                required: 'End date is required',
                date: 'Please enter a valid date',
                greaterThan: 'End date must be after start date'
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
    
    // Profile form validation
    $('#profileForm').validate({
        rules: {
            full_name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
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
    
    // Password form validation
    $('#passwordForm').validate({
        rules: {
            current_password: {
                required: true,
                minlength: 6
            },
            new_password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: '#new_password'
            }
        },
        messages: {
            current_password: {
                required: 'Current password is required',
                minlength: 'Current password must be at least 6 characters'
            },
            new_password: {
                required: 'New password is required',
                minlength: 'New password must be at least 6 characters'
            },
            confirm_password: {
                required: 'Please confirm your new password',
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
    
    // Custom validation for greaterThan date
    $.validator.addMethod('greaterThan', function(value, element, param) {
        return new Date(value) > new Date($(param).val());
    });
});