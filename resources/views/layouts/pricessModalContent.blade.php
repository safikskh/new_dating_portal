<div class="row">
            <div class="col">
              @foreach(App\Models\Membership::whereIn('slug',
              ['free','md','ugo','weekend','day','kvartal','arllg','ar','2week'])->get()->slice(0
              , 4) as $plan)
              <li class="list-group-item clearfix">
                <div class="pull-left">
                  <h5>{{ $plan->name }}</h5>
                  <h5>{{ number_format($plan->cost, 2) }} Kr./ @if ($plan->name ==
                    "Gratis profil") md @else {{lcfirst($plan->name)}}
                    @endif
                  </h5>
                  <h5>{{ $plan->description }}</h5>
                </div>
              </li>
              @endforeach
            </div>
            <div class="col">
              @foreach(App\Models\Membership::whereIn('slug',
              ['free','md','ugo','weekend','day','kvartal','arllg','ar','2week'])->get()->slice(4,
              8) as $plan)
              <li class="list-group-item clearfix">
                <div class="pull-left">
                  <h5>{{ $plan->name }}</h5>
                  <h5>{{ number_format($plan->cost, 2) }} Kr./ @if ($plan->name ==
                    "1 år") år @else {{lcfirst($plan->name)}}
                    @endif
                  </h5>
                  <h5>{{ $plan->description }}</h5>
                </div>
              </li>
              @endforeach
            </div>
          </div>