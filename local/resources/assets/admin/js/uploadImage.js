/* UPLOAD ẢNH */
function uploadImage(input, image) {
    if (image != undefined) {
        var valid = check_image(image);
        if (!valid) {
            snackbar(2, get_check_message());
            input.value = '';
            return;
        }
        var formData = new FormData();
        formData.append('file', image);

        $.ajax({
            url: '/upload_image',
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: formData
        }).fail(function (ui, status) {
            snackbar(2, 'Có lỗi xảy ra!');
        }).done(function (data, status) {
            if (data.status) {
                $('div.blog-avatar').addClass('d-none');
                $('img#blog_avatar').attr('src', data.path);
                $('input#src_avatar').val(data.data);
                $('div.img-avatar').removeClass('d-none');
            }
            else {
                snackbar(2, 'Có lỗi xảy ra!');
            }
        });
        input.value = '';
    }
    else {
        snackbar(2, 'Ảnh không tồn tại! Vui lòng chọn lại!');
    }
}

var fileType = ['image/png', 'image/jpeg'];
var message;
var ImageSize = 5242880;
function check_image(image) {
    if (!image) {
        console.error("Bạn vui lòng chọn ảnh.");
        return false;
    }
    if (fileType.indexOf(image.type) == -1) {
        message = "File không đúng định dạng. Vui lòng chọn lại!";
        return false;
    }
    if (image.size > ImageSize) {
        message = ("Hình ảnh của bạn phải nhỏ hơn 5MB, Vui lòng thay đổi kích thước hình ảnh của bạn!");
        return false;
    }
    return true;
}
function get_check_message() {
    return this.message;
}
function removeImage() {
    $('input#src_avatar').value = '';
    $('div.img-avatar').addClass('d-none');
    $('div.blog-avatar').removeClass('d-none');
}
/* KẾT THÚC UPLOAD ẢNH */
// type = 1 là success
// type = 2 là error
function snackbar(type, message) {
    if (!$("#snackbar").length) {
        $("body").append('<div id="snackbar"></div>');
    }
    if (type == '2') {
        $("#snackbar").addClass('error');
    }
    $("#snackbar").html(message);
    $("#snackbar").removeClass('show');
    $("#snackbar").addClass('show');
    // After 3 seconds, remove the show class from DIV
    setTimeout(function () {
        $("#snackbar").removeClass('show');
    }, 3000);
}
