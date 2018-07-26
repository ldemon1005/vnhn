function open_video(url) {
    newwindow=window.open(url,'VietNamHoiNhap','height=500,width=800,top=150,left=200, location=0');
    if (window.focus) {newwindow.focus()}
    return false;
}

function set_lang(lang) {
    $.ajax({
        url: '/set_lang/' + lang,
        method: 'get',
        dataType: 'json',
    }).fail(function (ui, status) {
    }).done(function (data, status) {
        console.log(1,data)
        if (data.status == 1) window.location="/";;
    })
}