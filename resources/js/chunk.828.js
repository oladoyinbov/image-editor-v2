$(document).ready(() => {
    var imageInput = $('#image_file');
    var image = $('#img_prev');
    var indicator = $('#indic');
    var download_btn = $('#download_btn');
    var alert_box = $('#alert_message');
    var compression_btn = $('#cmp_btn');
    var realtime_opt = $('#realtime_opt');
    const handle_feedback = (msg, type = 'warning') => {
        return '<div role="alert" class="alert alert-dark text-warning mt-3"><span><i class="fad fa-info-circle"></i> '+msg+'</span></div>';
    }

    document.getElementById('cmp_form').addEventListener('htmx:beforeRequest', function (event) {
        document.getElementById('spinner').style.display = 'block';
        document.getElementById('cmp_btn').style.display = 'none';
    });

    document.getElementById('cmp_form').addEventListener('htmx:afterRequest', function (event) {
      document.getElementById('spinner').style.display = 'none';
      document.getElementById('cmp_btn').style.display = 'block';
    });


    indicator.hide();
    download_btn.hide();

    imageInput.change(function() {
        var file = this.files[0];
        var fileName = $(this).val();
        var fileExtension = fileName.split('.').pop().toLowerCase();

        // List of allowed file extensions
        var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if ($.inArray(fileExtension, allowedExtensions) == -1) {
            var msg = 'Invalid file type.';
            image.attr('src', 'https://i.ibb.co/fH41Ck7/image-is-not-available.jpg');
            alert_box.html(handle_feedback(msg));
            compression_btn.attr('disabled', 'disabled');
            return '';
        }

        if (file) {
            realtime_opt.prop('checked', false);
            var fileSize = (file.size / 1024).toFixed(2) + ' KB';
            
            // enable compress button 
            compression_btn.removeAttr('disabled');

            // remove alert, if exist
            alert_box.html('');

            // Display image preview
            var reader = new FileReader();
            reader.onload = function(e) {
                image.attr('src', e.target.result);
            }

            reader.readAsDataURL(file);
        } else {
            image.attr('src', 'https://i.ibb.co/fH41Ck7/image-is-not-available.jpg');
        }
    });

    // fix this, only if realtime btn is checked, then submit
    realtime_opt.on('change, click', function() {
        var fileExtension = imageInput.val().split('.').pop().toLowerCase();
        var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        $('#compression_level').on('change', () => {
            if($.inArray(fileExtension, allowedExtensions) != -1 && realtime_opt.prop('checked') == true) {
                htmx.trigger('#cmp_form', 'submit');
            }
        });
    });
});