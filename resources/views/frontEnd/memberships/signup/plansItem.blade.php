<div class="card-body">
    <ul class="list-group">
        @foreach($plans as $plan)
        <form action="{{route('membership.show', $plan->slug, $newUserObj)}}" method="get" id="signupPlanForm">
            @csrf
        <li class="list-group-item clearfix">
            <div class="pull-left">
                <h5>{{ $plan->name }}</h5>
                <h5>&nbsp {{ number_format($plan->cost, 2) }} Kr./ @if($plan->name == "1 år")
                    år
                    @else
                    {{lcfirst($plan->name)}}
                    @endif
                </h5>
                @if(session()->has('coupon') &&  $plan->slug != "free" &&
                session()->get('coupon')[$plan->slug.'discount'] > 0)
                <h5> -{{session()->get('coupon')[$plan->slug.'discount']}} Kr.
                    discount({{session()->get('coupon')['name']}}) &nbsp;
                    <form action="{{route('coupon.destroy')}}" method="POST" style="display:inline">
                        @csrf @method('delete')
                        <button class="btn btn-outline-danger btn-sm" style="font-size:10px"
                            type="submit">remove</button>
                    </form>
                </h5>
                <hr>
                <h5>{{$plan->cost - session()->get('coupon')[$plan->slug.'discount']}} Kr. New SubTotal</h5>
                @endif
                <h5>{{ $plan->description }}</h5>
                
                <button onclick="signupAggrement(this.form)" type="button" class="btn btn-outline-dark pull-right">Vælg</button>
            </div>
        </li>
        </form>
        @endforeach
    </ul>
   

</div>