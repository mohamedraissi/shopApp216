
<div class=" form-group ">
	<label class="col-sm-12  col-form-label">Select Category Level</label>
	<div class="col-sm-12 col-md-12">
		<select name="parent_id"  id="parent_id" class="custom-select2 form-control select2-hidden-accessible" style ="width:100%;">
        <option value="0">Main Category </option>
            @if(!empty($getCategories))
               @foreach($getCategories as $category)
                 <option value=" {{ $category['id'] }}"> {{ $category['category_name'] }} </option>
                    @if(!empty($category['subcategories']))
                      @foreach($category['subcategories'] as $subcategory)
                        <option value=" {{ $subcategory['id'] }}">
                         {{ $subcategory['category_name'] }} </option>
                      @endforeach
                    @endif
                @endforeach
            @endif
		</select>	
	</div>					 
</div>