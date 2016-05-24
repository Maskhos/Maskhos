@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row" id="go">
			<div class="col-md-12">
				<h1 class="maskhos-section-title maskhos-section-section">Mecánicas de juego</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div id="bg-asset"></div>
				<div id="ninja-slider">
					<div class="slider-inner">
						<ul>
							<li>
								<div class="content">
									<img src="3/meter.png" />
									<h3>Unrestricted Content</h3>
									<p>The content can be anything: HTML, text, images, ...</p>
								</div>
							</li>
							<li>
								<div class="content">
									<img src="3/bulb.png" />
									<h3>Showcase the important</h3>
									<p>
										Organize, highlight and showcase your most important content in a sleek and stylish manner.
									</p>
								</div>
							</li>
							<li>
								<div class="content">
									<img src="3/responsive.png" />
									<h3>Responsive</h3>
									<p>The Content Slider is responsive. The image in this slide is always 30% of the screen size.</p>
								</div>
							</li>
							<li>
								<div class="content">
									<img src="3/browser-support.png" />
									<h3>Mobile Friendly</h3>
									<p>The Carousel is compatible with mobile platforms like iphone/ipad.</p>
								</div>
							</li>
						</ul>
						<div class="fs-icon" title="Expand/Close"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection