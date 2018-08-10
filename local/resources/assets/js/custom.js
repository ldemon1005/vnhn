var url = $('.currentUrl').text();
function open_video(url) {
    newwindow=window.open(url,'VietNamHoiNhap','height=500,width=800,top=150,left=200, location=0');
    if (window.focus) {newwindow.focus()}
    return false;
}

function set_lang(lang) {
    $.ajax({
        url: url+'/set_lang/' + lang,
        method: 'get',
        dataType: 'json',
    }).fail(function (ui, status) {
    }).done(function (data, status) {
        if (data.status == 1) window.location="/";
    })
}


$(document).on('change', '#province', function (e) {
    
    e.preventDefault();
    $.ajax({
        url: url+'/advert/get_district/' + $(this).val(),
        method: 'get',
        dataType: 'json',
    }).fail(function (ui, status) {
    }).done(function (data, status) {
        console.log(data.content);
        if(data.content){
            console.log(data.content);
            setTimeout(function () {
                $('#district_id').html(data.content);
                $('#district_id').selectpicker('refresh');
            },200);
        }
    })
});
$(document).on('change', '#district_id', function (e) {
    e.preventDefault();
    $.ajax({
        url: url+'/advert/get_wards/' + $(this).val(),
        method: 'get',
        dataType: 'json',
    }).fail(function (ui, status) {
    }).done(function (data, status) {
        if(data.content){
            setTimeout(function () {
                $('#ward_id').html(data.content);
                $('#ward_id').selectpicker('refresh');
            },200);

        }
    })
});