@extends('magazine.master')
@section('title','Magazine')
@section('main')

<link rel="stylesheet" type="text/css" href="css/magazine_main.css">
<main>
	<div class="mainLogo">
		<div class="mainLogoImg">
			<img src="{{ asset('local/resources/assets/images/emagazine-logo.png') }}">
		</div>
		
	</div>

	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@if(isset($items[0]))
					<div class="articleItem first">
						<a href="{{ asset('magazine/'.$items[0]->e_slug) }}" class="articleItemAva" style="background: url('{{ asset('local/storage/app/emagazine/resized-'.$items[0]->e_img) }}') no-repeat center /cover;" onclick="view('{{ $items[0]->e_id }}')">
							
						</a>
						<div class="articleItemTitle">
							<h2>
								<a href="{{ asset('magazine/'.$items[0]->e_slug) }}" onclick="view('{{ $items[0]->e_id }}')">{{ cut_string($items[0]->e_title, 100)}}</a>
							</h2>
							<div class="articleItemTitleMini">
								<span class="articleItemTime">
									{{date_format_vn($items[0]->created_at)}}
								</span>
								<span class="articleItemView">
									<i class="fas fa-eye"></i>
									{{ $items[0]->e_view}}
								</span>
							</div>
						</div>
					</div>
					@endif
				</div>
			</div>
			<div class="row">

				@for ($i = 1; $i < 3 ; $i++)
					@if(isset($items[$i]))
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="articleItem second">
							<a  href="{{ asset('magazine/'.$items[$i]->e_slug) }}" class="articleItemAva" style="background: url('{{ asset('local/storage/app/emagazine/resized-'.$items[$i]->e_img) }}') no-repeat center /cover;" onclick="view('{{ $items[$i]->e_id }}')">
								
							</a>
							<div class="articleItemTitle">
								<h2>
									<a href="{{ asset('magazine/'.$items[$i]->e_slug) }}" onclick="view('{{ $items[$i]->e_id }}')">{{ cut_string($items[$i]->e_title, 100)}}</a>
								</h2>
								<div class="articleItemTitleMini">
									<span class="articleItemTime">
										{{date_format_vn($items[$i]->created_at)}}

									</span>
									<span class="articleItemView">
										<i class="fas fa-eye"></i>
										{{$items[$i]->e_view}}
									</span>
								</div>
							</div>
							<div class="articleItemContent">
								{{ $items[$i]->e_summary}}
							</div>
						</div>
					</div>
					@endif
				@endfor
			</div>
			<div class="row contentMain">
				@for ($i = 3; $i < count($items) ; $i++)
					<div class="col-md-4 col-sm-6 col-xs-12 articleItemBig">
						<div class="articleItem">
							<a  href="{{ asset('magazine/'.$items[$i]->e_slug) }}" class="articleItemAva" style="background: url('{{ asset('local/storage/app/emagazine/resized-'.$items[$i]->e_img) }}') no-repeat center /cover;" onclick="view('{{ $items[$i]->e_id }}')">
								
							</a>
							<div class="articleItemTitle">
								<h2>
									<a href="{{ asset('magazine/'.$items[$i]->e_slug) }}" onclick="view('{{ $items[$i]->e_id }}')">{{ cut_string($items[$i]->e_title, 100)}}</a>
								</h2>
								<div class="articleItemTitleMini">
									<span class="articleItemTime">
										{{date_format_vn($items[$i]->created_at)}}
									</span>
									<span class="articleItemView">
										<i class="fas fa-eye"></i>
										{{$items[$i]->e_view}}
									</span>
								</div>
							</div>
							<div class="articleItemContent">
								{{ $items[$i]->e_summary}}
							</div>
						</div>
					</div>
				@endfor
					
			</div>
			<div class="loadMore">
				<img src="images/Rolling-1s-200px.gif">
			</div>
		</div>
		
		</div>
		<div class="btnLoad" style="display: none;"></div>
			
	</section>
</main>
@stop
@section('script')
<script type="text/javascript" src="js/emagazine.js"></script>
@stop