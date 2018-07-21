@extends('client.master')
@section('main')
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <div id="main">
        <section class="section1">
            <div class="detailTitle">
                <a href="{{ asset('') }}" >
                    thời sự
                </a>
                <i class="fas fa-angle-right"></i>
                <a href="{{ asset('') }}">
                    Tiêu điểm nóng
                </a>
                
            </div>
            <div class="detailMain">
                <div class="mainDetailLeft">
                    <h1>Tăng cường phát triển thương mại, du lịch giữa Hà Nội và UAE</h1>
                    <div class="mainDetailLeftTime">
                        <i class="far fa-clock"></i>
                        Thứ tư, 18/7/2018, 09:30 (GMT+7)
                    </div>
                    <div class="mainDetailLeftContent">
                        <p style="text-align: justify;"><strong>BỐI CẢNH MỚI, C&Aacute;CH NH&Igrave;N MỚI</strong></p>

                        <p style="text-align: justify;">Nhiều học giả tin rằng, c&aacute;c hiệp định thương mại tự do, nhất l&agrave; Hiệp định Đối t&aacute;c xuy&ecirc;n Th&aacute;i B&igrave;nh Dương (TPP) với những cam kết rất mạnh mẽ sẽ tạo n&ecirc;n động lực v&agrave; sức &eacute;p cho qu&aacute; tr&igrave;nh cải c&aacute;ch nền kinh tế của Việt Nam. Đ&oacute; l&agrave; một phần l&yacute; do c&oacute; những người cảm thấy thất vọng khi tổng thống mới đắc cử Đ&ocirc;-nan Trăm (Donald Trump) tuy&ecirc;n bố Mỹ sẽ r&uacute;t khỏi TPP.</p>

                        <p style="text-align: justify;">Song, thiết nghĩ, với nền kinh tế Việt Nam, sự mất đ&agrave; của TPP, nếu c&oacute;, lại c&oacute; thể được nh&igrave;n nhận ở kh&iacute;a cạnh t&iacute;ch cực, như một động lực để kinh tế Việt Nam chọn được hướng đi dứt kho&aacute;t, r&otilde; r&agrave;ng trong chặng đường hội nhập tới.</p>

                        <p style="text-align: justify;">Ch&uacute;ng ta đứng trước đ&ograve;i hỏi phải th&uacute;c đẩy tốc độ tăng trưởng mạnh mẽ, để nhanh ch&oacute;ng đạt được mục ti&ecirc;u thịnh vượng cho người d&acirc;n, nhưng tr&ecirc;n thực tế vừa qua, cứ 10 năm tăng trưởng, Việt Nam lại tụt đi 1% v&agrave; xu hướng giảm dần vẫn c&ograve;n đ&oacute;. Nỗi lo tụt hậu so với c&aacute;c nước đ&atilde; được nh&igrave;n nhận kh&ocirc;ng c&ograve;n l&agrave; nguy cơ, nhưng qu&aacute; tr&igrave;nh cơ cấu lại, đổi mới m&ocirc; h&igrave;nh tăng trưởng để t&igrave;m ra động lực tăng trưởng mới, vẫn diễn ra kh&aacute; chậm chạp.</p>

                        <p style="text-align: justify;">V&agrave; cũng đứng trước việc phải t&igrave;m lời giải cho h&agrave;ng loạt c&acirc;u hỏi như: Phải chăng c&aacute;c hiệp định thương mại tự do v&agrave; cam kết hội nhập chưa tạo ra đủ &aacute;p lực cho cải c&aacute;ch trong nước?</p>

                        <p style="text-align: justify;">Nh&igrave;n v&agrave;o l&agrave;n s&oacute;ng đầu tư nước ngo&agrave;i đổ v&agrave;o Việt Nam thời gian qua cũng như xu hướng chuyển dịch c&aacute;c cơ sở sản xuất đến Việt Nam của nhiều nh&agrave; đầu tư nước ngo&agrave;i, c&oacute; thể thấy khu vực n&agrave;y đang l&agrave; một động lực quan trọng tạo n&ecirc;n tăng trưởng GDP. Thế nhưng, phải thẳng thắn, l&yacute; do ch&iacute;nh họ đến l&agrave; để tận dụng c&aacute;c lợi thế về xuất xứ, chi ph&iacute; khi những cam kết của Việt Nam về hội nhập, tham gia kết nối với c&aacute;c thị trường lớn nhất thế giới như Mỹ, EU, Nhật Bản&hellip;, c&oacute; hiệu lực, chứ kh&ocirc;ng ho&agrave;n to&agrave;n v&igrave; sự hấp dẫn của m&ocirc;i trường đầu tư - kinh doanh ở Việt Nam. Do đ&oacute;, sự chuyển dịch n&agrave;y kh&ocirc;ng phải thước đo ch&iacute;nh x&aacute;c về mức độ cải c&aacute;ch m&ocirc;i trường đầu tư trong nước.</p>

                        <p style="text-align: justify;">Hơn thế, cũng cần phải đặt một c&acirc;u hỏi - Liệu rằng, khi sự tăng trưởng dựa qu&aacute; nhiều v&agrave;o nguồn lực đầu tư b&ecirc;n ngo&agrave;i, nền kinh tế c&oacute; rơi v&agrave;o t&igrave;nh trạng bị chia cắt r&otilde; n&eacute;t giữa khu vực kinh tế trong nước v&agrave; khu vực c&oacute; vốn đầu tư nước ngo&agrave;i, giữa khu vực doanh nghiệp nh&agrave; nước v&agrave; doanh nghiệp tư nh&acirc;n; giữa khu vực th&agrave;nh thị v&agrave; n&ocirc;ng th&ocirc;n hay kh&ocirc;ng&hellip;? C&acirc;u trả lời l&agrave; c&oacute;, khi nhiều cơ hội được chỉ ra khi Việt Nam gia nhập WTO hay c&aacute;c cam kết thương mại tự do với H&agrave;n Quốc, Li&ecirc;n minh kinh tế &Aacute; - &Acirc;u hay EU, dường như chỉ c&oacute; nh&agrave; đầu tư nước ngo&agrave;i tận dụng được&hellip;</p>

                        <p style="text-align: justify;">C&oacute; thể thấy, nếu chỉ chờ những &aacute;p lực b&ecirc;n ngo&agrave;i từ c&aacute;c hiệp định thương mại tự do t&aacute;c động tới c&aacute;c kế hoạch cải c&aacute;ch nền kinh tế, chắc rằng, nền kinh tế Việt Nam kh&oacute; c&oacute; thể tạo n&ecirc;n những bước đột ph&aacute; như kỳ vọng.</p>

                        <p style="text-align: justify;">Đầu th&aacute;ng 11-2016, Ban Chấp h&agrave;nh Trung ương Đảng đ&atilde; ban h&agrave;nh hai Nghị quyết quan trọng, một l&agrave; về đổi mới m&ocirc; h&igrave;nh tăng trưởng v&agrave; hai l&agrave; n&acirc;ng cao hiệu quả hội nhập. Ngay sau đ&oacute;, Quốc hội cũng đ&atilde; th&ocirc;ng qua Nghị quyết về kế hoạch cơ cấu lại nền kinh tế giai đoạn 2016-2020.</p>

                        <p style="text-align: justify;">Đ&oacute; l&agrave; h&agrave;nh tr&igrave;nh ch&uacute;ng ta phải đi để thực hiện được mục ti&ecirc;u đưa thứ hạng của nền kinh tế Việt Nam đạt tới quy m&ocirc; lớn hơn nữa. Điều ấy, kh&ocirc;ng chỉ t&ugrave;y thuộc v&agrave;o những hiệp định thương mại. Nhưng, vấn đề c&ograve;n lại l&agrave; cần đến sự sắp xếp lại tư duy để hiện thực h&oacute;a quyết t&acirc;m v&agrave; đồng thuận tr&ecirc;n.</p>

                        <p style="text-align: center;"><img alt="" src="/data/data/phamvanthuy/2017/04/10/abc.jpg" style="height:313px; width:500px" /></p>

                        <p style="text-align: center;"><em>Ảnh minh họa</em></p>

                        <p style="text-align: justify;"><strong>&Aacute;P LỰC ĐỔI MỚI PHẢI TỪ B&Ecirc;N TRONG</strong></p>

                        <p style="text-align: justify;">Phải khẳng định lại, trọng t&acirc;m của qu&aacute; tr&igrave;nh cơ cấu lại nền kinh tế l&agrave; ph&acirc;n bố lại mọi nguồn lực v&agrave; n&acirc;ng cao hiệu quả sử dụng nguồn lực đ&oacute;. N&oacute;i một c&aacute;ch h&igrave;nh ảnh, nếu coi nền kinh tế l&agrave; một hồ nước mang đến sự sống, nguồn lực đầu tư l&agrave; d&ograve;ng chảy về từ s&ocirc;ng, suối, khe, lạch&hellip;, th&igrave; hồ nước chỉ thật sự c&oacute; &iacute;ch khi l&ograve;ng hồ trong v&agrave; sạch. C&acirc;u hỏi đang được đặt ra, sau giai đoạn 5 năm thực hiện t&aacute;i cơ cấu nền kinh tế (2011-2015), liệu &ldquo;hồ nước&rdquo; kinh tế Việt Nam c&oacute; c&ograve;n chỗ cho c&aacute;c d&ograve;ng chảy mới? Hay n&oacute;i một c&aacute;ch kh&aacute;c, nền kinh tế Việt Nam bước v&agrave;o năm 2017 v&agrave; những năm tới với h&agrave;nh trang như thế n&agrave;o?</p>

                        <p style="text-align: justify;">Nếu x&eacute;t về đầu tư, ch&uacute;ng ta đang huy động đầu tư kh&aacute; cao so với th&ocirc;ng lệ, nhưng hiệu quả đầu tư chưa tương xứng. Với Trung Quốc, trong thời kỳ tăng trưởng nhanh từ năm 1991 đến 2003, tỷ lệ đầu tư trong GDP l&agrave; 39,1%; tỷ lệ tăng trưởng GDP l&agrave; 9,5% v&agrave; suất đầu tư tăng trưởng l&agrave; 4,1. C&ograve;n với thời kỳ tăng trưởng nhanh của Nhật Bản giai đoạn 1961-1970, mức tăng trưởng GDP l&agrave; 10,2%, tỷ lệ đầu tư tr&ecirc;n GDP chỉ l&agrave; 32,6% v&agrave; do vậy, suất đầu tư tăng trưởng chỉ l&agrave; 3,2&hellip;</p>

                        <p style="text-align: justify;">Quay lại với Việt Nam, trong giai đoạn 2011-2015, tỷ lệ đầu tư tr&ecirc;n GDP l&agrave; 31,8% nhưng tỷ lệ tăng trưởng GDP chỉ l&agrave; 5,9%, do vậy, suất đầu tư tăng trưởng l&ecirc;n tới 5,39. So s&aacute;nh giữa c&aacute;c nguồn lực đầu tư, th&igrave; hiệu quả đầu tư nh&agrave; nước c&oacute; cải thiện chậm, hiệu quả thấp hơn. Trong khi đ&oacute;, mức huy động qua ng&acirc;n s&aacute;ch, bội chi v&agrave; th&acirc;m hụt ng&acirc;n s&aacute;ch đều ở mức cao dẫn đến mức nợ c&ocirc;ng cao v&agrave; tăng nhanh.</p>

                        <p style="text-align: justify;">Huy động vốn đầu tư trực tiếp nước ngo&agrave;i (FDI) cũng rất cao, đang ở mức khoảng 26-28% tổng đầu tư to&agrave;n x&atilde; hội. Cho đến thời điểm n&agrave;y, kh&ocirc;ng thể phủ nhận vai tr&ograve; của FDI trong c&ocirc;ng nghiệp ng&agrave;y c&agrave;ng tăng, chiếm 50% trong c&ocirc;ng nghiệp; 70% kim ngạch xuất khẩu&hellip; nhưng nếu tiếp tục tăng theo c&aacute;ch ấy, sự lấn &aacute;t của FDI tới c&aacute;c d&ograve;ng vốn trong nước sẽ đ&aacute;ng b&aacute;o động.</p>

                        <p style="text-align: justify;">Th&ecirc;m v&agrave;o đ&oacute;, trong khi khu vực doanh nghiệp nh&agrave; nước chưa cải thiện được hiệu quả hoạt động, th&igrave; khu vực tư nh&acirc;n đang mất đ&agrave; v&agrave; hao hụt độ m&aacute;u lửa trong kinh doanh. Sự gia tăng của số doanh nghiệp thua lỗ, số doanh nghiệp đăng k&yacute; v&agrave; đ&oacute;ng cửa do&atilde;ng ra về hai chiều, l&agrave; những chỉ dấu cho thấy, nếu t&igrave;nh trạng n&agrave;y k&eacute;o d&agrave;i, nền kinh tế sẽ rất kh&oacute; huy động th&ecirc;m nguồn vốn.</p>

                        <p style="text-align: justify;">Để khơi th&ocirc;ng mọi nguồn lực tạo n&ecirc;n sự thịnh vượng cho quốc gia, qu&aacute; tr&igrave;nh cơ cấu lại cần xo&aacute;y v&agrave;o việc ph&acirc;n bố lại nguồn lực. N&oacute;i đ&uacute;ng hơn l&agrave; cần phải thay đổi c&aacute;ch thức ph&acirc;n bố nguồn lực. B&ecirc;n cạnh đ&oacute; l&agrave; phải thiết lập c&aacute;c thị trường nh&acirc;n tố sản xuất. Cụ thể, đ&oacute; l&agrave; vận h&agrave;nh hiệu quả thị trường đất đai, thị trường t&agrave;i ch&iacute;nh, tiến đến thay thế cơ chế h&agrave;nh ch&iacute;nh xin - cho trong ph&acirc;n bố nguồn lực bằng cơ chế ph&acirc;n bố theo t&iacute;n hiệu thị trường.</p>

                        <p style="text-align: justify;">Ch&uacute;ng ta cũng cần thực thi t&aacute;i cơ cấu khu vực nh&agrave; nước chứ kh&ocirc;ng chỉ l&agrave; doanh nghiệp nh&agrave; nước. C&ograve;n đối với cơ cấu lại hệ thống ng&acirc;n h&agrave;ng, trọng t&acirc;m phải l&agrave; xử l&yacute; nhanh v&agrave; dứt điểm nợ xấu, phải để hệ thống t&agrave;i ch&iacute;nh được vận h&agrave;nh đ&uacute;ng chức năng. Đặc biệt, kế hoạch cơ cấu lại nền kinh tế gắn với đổi mới m&ocirc; h&igrave;nh tăng trưởng kh&ocirc;ng thể cứ đi b&ecirc;n r&igrave;a của c&aacute;c kế hoạch ph&aacute;t triển kinh tế - x&atilde; hội hằng năm của c&aacute;c địa phương như l&acirc;u nay. Thay v&agrave;o đ&oacute;, n&oacute; phải trở th&agrave;nh mục ti&ecirc;u của kế hoạch n&agrave;y.</p>

                        <p style="text-align: justify;">Đ&atilde; đến l&uacute;c, ch&uacute;ng ta kh&ocirc;ng thể kh&ocirc;ng thay đổi tư duy, c&aacute;ch thức thực hiện đổi mới m&ocirc; h&igrave;nh tăng trưởng. Bởi, chỉ c&oacute; vượt l&ecirc;n lợi &iacute;ch cục bộ của ng&agrave;nh, địa phương th&igrave; nền kinh tế Việt Nam mới vượt qua được ngưỡng quy m&ocirc; nhỏ để đạt được giấc mơ thịnh vượng&hellip;</p>

                        <p style="text-align: right;"><strong>NGUYỄN Đ&Igrave;NH CUNG</strong></p>

                        <p style="text-align: right;"><strong>Viện trưởng Viện Nghi&ecirc;n cứu quản l&yacute; kinh tế Trung ương</strong></p>

                        <p style="text-align: justify;">&nbsp;</p>
                    </div>

                    <div class="mainDetailLeftBanner">
                        <img src="images/Banner trung tâm 1 (728x90).png">
                    </div>
                    {{-- <div class="mainDetailLeftRecommend">
                        <div class="mainDetailLeftRecommendItem left">
                            <div class="mainDetailLeftRecommendItemImg">
                                <img src="images/Layer 66.png">
                            </div>
                            <div class="mainDetailLeftRecommendItemTitle">
                                <i class="fas fa-angle-double-left"></i>
                                Bài trước
                            </div>
                            <div class="mainDetailLeftRecommendItemContent">
                                Sở Giáo dục Hà Giang đề nghị khởi tố điều tra sai phạm về điểm thi
                            </div>
                        </div>
                        <div class="mainDetailLeftRecommendItem right">
                            <div class="mainDetailLeftRecommendItemImg">
                                <img src="images/Layer 66.png">
                            </div>
                            <div class="mainDetailLeftRecommendItemTitle">
                                <i class="fas fa-angle-double-right"></i>
                                Bài tiếp
                            </div>
                            <div class="mainDetailLeftRecommendItemContent">
                                Sở Giáo dục Hà Giang đề nghị khởi tố điều tra sai phạm về điểm thi
                            </div>
                        </div>
                    </div> --}}

                    <div class="mainDetailLeftInvolve">
                        <h4 class="mainDetailLeftTitle">Bài được quan tâm</h4> 
                        <div class="mainDetailLeftInvolveMain">
                            <div class="mainDetailLeftInvolveItem">
                                <div class="mainDetailLeftInvolveItemImg">
                                    <img src="images/Layer 69.png">
                                </div>
                                <div class="mainDetailLeftInvolveItemContent">
                                    Hà Nội sẽ trở thành đô thị thông minh an toàn, thân thiện
                                </div>
                                <div class="mainDetailLeftInvolveItemTime">
                                    <i class="far fa-clock"></i>
                                    9 giờ trước
                                </div>
                            </div>
                            <div class="mainDetailLeftInvolveItem">
                                <div class="mainDetailLeftInvolveItemImg">
                                    <img src="images/Layer 69.png">
                                </div>
                                <div class="mainDetailLeftInvolveItemContent">
                                    Hà Nội sẽ trở thành đô thị thông minh an toàn, thân thiện
                                </div>
                                <div class="mainDetailLeftInvolveItemTime">
                                    <i class="far fa-clock"></i>
                                    9 giờ trước
                                </div>
                            </div>
                            <div class="mainDetailLeftInvolveItem">
                                <div class="mainDetailLeftInvolveItemImg">
                                    <img src="images/Layer 69.png">
                                </div>
                                <div class="mainDetailLeftInvolveItemContent">
                                    Hà Nội sẽ trở thành đô thị thông minh an toàn, thân thiện
                                </div>
                                <div class="mainDetailLeftInvolveItemTime">
                                    <i class="far fa-clock"></i>
                                    9 giờ trước
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mainDetailLeftComment">
                        <h4 class="mainDetailLeftTitle">Ý kiến của bạn</h4> 
                        <div class="mainDetailLeftCommentMain">
                            <form method="post">
                                <label>Nội dung</label>
                                <div class="form-group">
                                    <textarea rows="4" name="content"></textarea>
                                </div>
                                <div class="mainDetailLeftCommentMainName_Email">
                                    <div class="mainDetailLeftCommentMainName">
                                        <label>Họ tên</label>
                                        <div class="form-group">
                                            <input type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="mainDetailLeftCommentMainEmail">
                                        <label>Email</label>
                                        <div class="form-group">
                                            <input type="text" name="email">
                                        </div>
                                    </div>
                                </div>
                                <label>Mã xác thực</label>
                                <div class="form-group">
                                    <input type="text" name="code">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="sbm" value="gửi bình luận">
                                </div>
                                
                                
                            </form>
                        </div>
                    </div>

                </div>
                <div class="mainDetailRight">
                    <div class="mainDetailRightFollow">
                        <h4 class="mainDetailRightTitle red">Bài được quan tâm</h4>
                        <ul class="mainDetailRightList">
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Ra mắt CLB Nhà báo Thành Nam</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Kí sự - Chuyến hành trình "Tri ân đồng đội - hướng về cội nguồn"</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Bản tin tạp trí Việt Nam Hội Nhập - Ngày 07.05.2018</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Kí sự - Chuyến hành trình "Tri ân đồng đội - hướng về cội nguồn"</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Bản tin tạp trí Việt Nam Hội Nhập - Ngày 07.05.2018</a></li>
                        </ul>
                    </div>
                    <div class="mainDetailRightJournal">
                        <h4 class="mainDetailRightTitle red">
                            Tạp trí thường kì
                        </h4>
                        <div class="owl-carousel">
                            <div class="item">
                                <img src="images/Bia VNHN 54 (bac trung bo)-01-01.jpg">
                            </div>
                            <div class="item">
                                <img src="images/Bia VNHN so 48-01.jpg">
                            </div>
                            <div class="item">
                                <img src="images/Bia VNHN so 49-01.jpg">
                            </div>
                            
                        </div>
                    </div>
                    <div class="mainDetailRightVideo">
                        <h4 class="mainDetailRightTitle red">
                            VNHN Video
                        </h4>
                        <iframe width="100%" height="auto" src="https://www.youtube.com/embed/UXdPQnSJQp8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        <ul class="mainDetailRightList">
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Ra mắt CLB Nhà báo Thành Nam</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Kí sự - Chuyến hành trình "Tri ân đồng đội - hướng về cội nguồn"</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Bản tin tạp trí Việt Nam Hội Nhập - Ngày 07.05.2018</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Kí sự - Chuyến hành trình "Tri ân đồng đội - hướng về cội nguồn"</a></li>
                            <li><a href="{{ asset('') }}"><i class="fas fa-caret-right"></i>Bản tin tạp trí Việt Nam Hội Nhập - Ngày 07.05.2018</a></li>
                        </ul>
                            
                    </div>
                    <div class="mainDetailRightAdvert">
                        <img src="images/Banner (300x250).png">
                        <img src="images/Banner (300x250).png">
                        <img src="images/Banner (300x250).png">

                    </div>
                        

                </div>

            </div>
        </section>
    </div>
@stop
@section('script')

<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoHeight:true,
        responsive:{
            0:{
                items:1
            },
            992:{
                items:2
            },
            1000:{
                items:2
            }
        }
    });
    // $('.involve-carousel').owlCarousel({
    //     loop:true,
    //     margin:0,
    //     nav:true,
    //     autoHeight:true,
    //     responsive:{
    //         0:{
    //             items:3
    //         },
    //         600:{
    //             items:3
    //         },
    //         1000:{
    //             items:3
    //         }
    //     }
    // });
</script>
@stop
