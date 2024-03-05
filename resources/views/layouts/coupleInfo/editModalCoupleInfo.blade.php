<!-- Developed By CBS -->
    <div class="modal-header">
        <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Rediger Profil</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
            <nav class="nav main-nav-line">
                <a class="nav-link active" data-toggle="tab" href="#male">Mand</a>
                <a class="nav-link" data-toggle="tab" href="#female">Kvinde</a>
            </nav><br>
            <div class="card-body tab-content h-100">
                <div class="tab-pane active" id="male">
                    {!! Form::open(['route' => ['profile.update', Auth::user()->id ], 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'file'=>'true'
                        ])!!} {{csrf_field()}}

                            @include('layouts.coupleInfo.editField.editField',['editItem' => Auth::user()->portalInfo->coupleMale()])
         
                        <div class="modal-footer">
                            <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Opdatér</button>
                        </div>   
                    {!! Form::close() !!}
                </div>
                <div class="tab-pane" id="female">
                    {!! Form::open(['route' => ['profile.update', Auth::user()->id ], 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'file'=>'true'
                        ])!!} {{csrf_field()}}
                       
                            @include('layouts.coupleInfo.editField.editField',['editItem' => Auth::user()->portalInfo->coupleFemale()])
                   
                        <div class="modal-footer">
                            <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Opdatér</button>
                        </div>   
                    {!! Form::close() !!}
                </div>
            </div>
    </div>
<!-- ./Developed By CBS -->