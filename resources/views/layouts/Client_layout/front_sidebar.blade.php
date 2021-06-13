<div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                    @foreach ($sections as $section)
                        <li>
                            <a class=" mb-3 collapsed" data-toggle="collapse" 
                            href="#collapseContent-{{ $section ['id']}}" role="button" 
                            aria-expanded="false" aria-controls="collapseContent" >

                            <span class="if-collapsed">
                            <i class="icon_tag_alt"></i> {{ $section ['name']}}
                            </span>
                            <span class="if-not-collapsed"></span>
                            </a>
                            <div class="collapse" id="collapseContent-{{ $section ['id']}}">
                        @foreach($section['categories'] as $category)
                        <ul class="filter-catagories">
                            <li>
                                <a  href="{{url($category['url'])}}"><i class="icon_tags_alt"></i> {{ $category['category_name']}}</a>
                                <ul class="filter-catagories"> 
                                @foreach($category['subcategories'] as $subcategory)
                                    <li><a  href="{{url($subcategory['url'])}}" class="font-weight-normal pt-0 pl-2">{{$subcategory['category_name']}}</a></li>
                                @endforeach
                                </ul>
                            </li>
                        </ul>            
                        @endforeach     
                                </div>
                        </li>   
                    @endforeach
                       
                    </ul>
                </div>
                @if(isset($page_name) && $page_name=="listing")
                @foreach($options as $option)
                <div class="filter-widget">
                    <h4 class="fw-title">{{$option['name']}}</h4>
                    @foreach($option['values'] as $value)
                    <div class="fw-brand-check">
                        <div class="bc-item">
                            <label for="{{$value['value']}}">
                                {{$value['value']}}
                                <input class="filter-value" type="checkbox" name="value-{{$value['id']}}[]" id="{{$value['value']}}" value="{{$value['id']}}">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        
                    </div>
                    @endforeach
                </div>
                @endforeach
                @endif
                <div class="filter-widget">
                    <h4 class="fw-title">Brand</h4>
                    <div class="fw-brand-check">
                    @foreach($brands as $brand)
                    
                        <div class="bc-item">
                            <label for="brand-{{$brand->name}}">
                                {{$brand->name}}
                                <input  class="filter-brand" type="checkbox" id="brand-{{$brand->name}}" value="{{$brand['id']}}">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    @endforeach 
                    </div>
                </div>
            </div>