@extends('magazine.master')
@section('title','Magazine')
@section('main')

<link rel="stylesheet" type="text/css" href="css/magazine_main.css">
<main>
	<div class="mainLogo">
		<div class="mainLogoImg" style="background: url('{{ asset('local/resources/assets/images/emagazine-logo.png') }}') no-repeat center /cover;"></div>
		
	</div>

	{{-- <section class="mainItem1">
		<div class="listArticle1">
			<div class="articleItem">
				<div class="articleItemAva" style="background: url('{{ asset('local/resources/assets/images/photo1532079843170-15320798431701414490616.png') }}') no-repeat center /cover;">
					
				</div>
				<div class="articleItemTitle">
					<h2>
						<a href="{{ asset('magazine') }}">Dù thế giới có đảo điên, người Ý vẫn chỉ có một “Pizza” - thứ pizza được nướng từ lò củi</a>
					</h2>
					<div class="articleItemTitleMini">
						<span class="articleItemTime">
							12 ngày trước
						</span>
						<span class="articleItemView">
							<i class="fas fa-eye"></i>
							868
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="listArticle2">
			<div class="articleItem">
				<div class="articleItemAva" style="background: url('{{ asset('local/resources/assets/images/photo1532079843170-15320798431701414490616.png') }}') no-repeat center /cover;">
					
				</div>
				<div class="articleItemTitle">
					<h2>
						<a href="{{ asset('magazine') }}">Dù thế giới có đảo điên, người Ý vẫn chỉ có một “Pizza” - thứ pizza được nướng từ lò củi</a>
					</h2>
					<div class="articleItemTitleMini">
						<span class="articleItemTime">
							12 ngày trước
						</span>
						<span class="articleItemView">
							<i class="fas fa-eye"></i>
							868
						</span>
					</div>
				</div>
				<div class="articleItemContent">
					Dù cho những trường phái pizza hiện đại kiểu Mỹ đã cùng những chuỗi quán ăn nhanh trở nên thắng thế, pizza kiểu Nhật tỉ mỉ, chau chuốt và hơi có nét kỳ dị lại rất được lòng dân Châu Á, nhưng những gì kinh điển vốn dĩ không thể chết.
				</div>
			</div>
			<div class="articleItem">
				<div class="articleItemAva" style="background: url('{{ asset('local/resources/assets/images/photo1532079843170-15320798431701414490616.png') }}') no-repeat center /cover;">
					
				</div>
				<div class="articleItemTitle">
					<h2>
						<a href="{{ asset('magazine') }}">Dù thế giới có đảo điên, người Ý vẫn chỉ có một “Pizza” - thứ pizza được nướng từ lò củi</a>
					</h2>
					<div class="articleItemTitleMini">
						<span class="articleItemTime">
							12 ngày trước
						</span>
						<span class="articleItemView">
							<i class="fas fa-eye"></i>
							868
						</span>
					</div>
				</div>
				<div class="articleItemContent">
					Dù cho những trường phái pizza hiện đại kiểu Mỹ đã cùng những chuỗi quán ăn nhanh trở nên thắng thế, pizza kiểu Nhật tỉ mỉ, chau chuốt và hơi có nét kỳ dị lại rất được lòng dân Châu Á, nhưng những gì kinh điển vốn dĩ không thể chết.
				</div>
			</div>
		</div>
	</section> --}}
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="articleItem first">
						<a href="{{ asset('magazine') }}" class="articleItemAva" style="background: url('{{ asset('local/resources/assets/images/photo1532079843170-15320798431701414490616.png') }}') no-repeat center /cover;">
							
						</a>
						<div class="articleItemTitle">
							<h2>
								<a href="{{ asset('magazine') }}">Dù thế giới có đảo điên, người Ý vẫn chỉ có một “Pizza” - thứ pizza được nướng từ lò củi</a>
							</h2>
							<div class="articleItemTitleMini">
								<span class="articleItemTime">
									12 ngày trước
								</span>
								<span class="articleItemView">
									<i class="fas fa-eye"></i>
									868
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				@for ($i = 0; $i < 2 ; $i++)
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="articleItem second">
							<a  href="{{ asset('magazine') }}" class="articleItemAva" style="background: url('{{ asset('local/resources/assets/images/photo'.$i.'.png') }}') no-repeat center /cover;">
								
							</a>
							<div class="articleItemTitle">
								<h2>
									<a href="{{ asset('magazine') }}">Đại chiến nhạc Việt hay Tháng 5 rực rỡ của V-Pop: Chưa bao giờ, khán giả được ...</a>
								</h2>
								<div class="articleItemTitleMini">
									<span class="articleItemTime">
										3 tháng trước
									</span>
									<span class="articleItemView">
										<i class="fas fa-eye"></i>
										2k
									</span>
								</div>
							</div>
							<div class="articleItemContent">
								World Cup đã kết thúc, sau 1 tháng cuồng nhiệt và đầy đam mê. Những gì để lại là một dư vị ngọt ngào về sự trỗi dậy của thế hệ tài năng mới, trẻ trung, táo bạo và nhiều mơ ước.
							</div>
						</div>
					</div>
				@endfor
			</div>
			<div class="row">
				@for ($i = 2; $i < 14 ; $i++)
					<div class="col-md-4 col-sm-6 col-xs-12 articleItemBig">
						<div class="articleItem">
							<a  href="{{ asset('magazine') }}" class="articleItemAva" style="background: url('{{ asset('local/resources/assets/images/photo'.$i.'.png') }}') no-repeat center /cover;">
								
							</a>
							<div class="articleItemTitle">
								<h2>
									<a href="{{ asset('magazine') }}">Đại chiến nhạc Việt hay Tháng 5 rực rỡ của V-Pop: Chưa bao giờ, khán giả được ...</a>
								</h2>
								<div class="articleItemTitleMini">
									<span class="articleItemTime">
										3 tháng trước
									</span>
									<span class="articleItemView">
										<i class="fas fa-eye"></i>
										2k
									</span>
								</div>
							</div>
							<div class="articleItemContent">
								Không hẹn mà gặp, hàng loạt nghệ sĩ Việt tự ghi tên mình vào một trận chiến đầy sôi động với hàng triệu khán giả đang háo hức mong chờ. Chưa bao ...
							</div>
						</div>
					</div>
				@endfor
					
			</div>
		</div>
		
		</div>
		
			
	</section>
</main>
@stop
@section('script')
@stop