<li class="list-group-item clearfix">
    <div class="pull-left">
        <h5>{{ $plan->name }}</h5>
        <h5>{{ number_format($plan->cost, 2) }} Kr./ {{ lcfirst($plan->name) }}</h5>
        <h5>{{ $plan->description }}</h5>
        <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-outline-dark pull-right">Vælg</a>
    </div>
</li>