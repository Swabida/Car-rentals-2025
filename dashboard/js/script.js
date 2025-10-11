$(document).ready(function() {
    // Handle form submission with AJAX
    $('form').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var formData = new FormData(form[0]);
        
        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success
                if (response.success) {
                    showNotification(response.message, 'success');
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function(xhr) {
                showNotification('An error occurred: ' + xhr.responseText, 'error');
            }
        });
    });
    
    // Show notification
    function showNotification(message, type) {
        var notification = $('<div class="notification ' + type + '">' + message + '</div>');
        $('body').append(notification);
        
        setTimeout(function() {
            notification.fadeOut(function() {
                $(this).remove();
            });
        }, 3000);
    }
    
    // Delete confirmation
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var id = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this item?')) {
            window.location.href = url;
        }
    });
});