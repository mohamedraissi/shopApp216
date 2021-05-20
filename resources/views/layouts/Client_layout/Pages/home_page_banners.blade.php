<?php use App\Models\Banner; 
$getbanners = Banner::getbanners();

?>
<section class="hero-section">
        <div class="hero-items owl-carousel">
            @foreach($getbanners as $key => $banner)
            <div class="single-hero-items set-bg @if ($key==0) active @endif" data-setbg= {{ asset("images/banners_images/".$banner['banner_image']) }}>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag,kids</span>
                            <h1>Black friday</h1>
                            
                                
                            <a href="{{ url($banner['link']) }}" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div>
                </div>
            </div>
            @endforeach
            
               
    </section>
    
    <!-- Hero Section End -->
