function open_video(url) {
    newwindow=window.open(url,'VietNamHoiNhap','height=500,width=800,top=150,left=200, location=0');
    if (window.focus) {newwindow.focus()}
    return false;
}