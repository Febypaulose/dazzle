
	 @php  $i = 0; @endphp
                    
                         	 @foreach($productimagess as $fimg)
@if($fimg->image_url!='')        
                         	 @if($i == 0)

                             <img id="image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $fimg->image_url }}" alt="Product" />

                             @endif
 
                             @php  $i++; @endphp
 @endif 
         
                             @endforeach
       @if($fimg->image_url!='')                     
 <div class="pagination">
              {{ $productimagess->links() }}
    </div>
             
 @endif 
             