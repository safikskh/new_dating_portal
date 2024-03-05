    <div class="row" style="min-width: 100%;">
        <div class="col profile-edit-area">
            <h3 class="h4">Rediger profil</h3>
            <br>
        </div>
        <div class="col">
            <ul class="nav nav-pills justify-content-end" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#male" role="tab" aria-controls="male" aria-selected="true">{{Auth::user()->portalInfo->coupleMale()->sex}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#female" role="tab" aria-controls="female" aria-selected="false">{{Auth::user()->portalInfo->coupleFemale()->sex}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="male" role="tabpanel" aria-labelledby="male-tab">                   
            {!! Form::open(['route' => ['profile.update', Auth::user()->id ], 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'file'=>'true'
            ])!!} {{csrf_field()}}
            <div>
                @include('layouts.coupleInfo.editField.editField',['editItem' => Auth::user()->portalInfo->coupleMale()])
            </div>
            <div class="modal-footer single-submit">
                <button type="submit" class="btn-radiaus">Opdatér</button>
            </div>    
            {!! Form::close() !!}            
        </div>
        <div class="tab-pane fade" id="female" role="tabpanel" aria-labelledby="female-tab">        
        {!! Form::open(['route' => ['profile.update', Auth::user()->id ], 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'file'=>'true'
        ])!!} {{csrf_field()}}
            <div>
                @include('layouts.coupleInfo.editField.editField',['editItem' => Auth::user()->portalInfo->coupleFemale()])
            </div>
            <div class="modal-footer single-submit">
                <button type="submit" class="btn-radiaus">Opdatér</button>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
    
</div>