<!-- Developed By CBS -->
    <div class="table-responsive ">
        <table class="table row table-borderless">

            <tbody class="col-lg-6 col-xl-6 p-0">
                <tr>
                    <td><strong>Køn :</strong> {{Auth::user()->portalInfo->coupleMale()->sex}}</td>
                </tr>
                <tr>
                    <td><strong>Lokation :</strong> {{Auth::user()->portalInfo->coupleMale()->regionName}}</td>
                </tr>
                <tr>
                    <td><strong>Postnummer :</strong> {{Auth::user()->portalInfo->coupleMale()->zipCode}}</td>
                </tr>
                <tr>
                    <td><strong>Civilstatus :</strong> {{Auth::user()->portalInfo->coupleMale()->civilStatus}}</td>
                </tr>
                <tr>
                    <td><strong>Alder :</strong> {{Carbon\Carbon::parse(Auth::user()->portalInfo->coupleMale()->dob)->age}} Years</td>
                </tr>
                <tr>
                    <td><strong>Højde :</strong> {{Auth::user()->portalInfo->coupleMale()->height}}</td>
                </tr>
                <tr>
                    <td><strong>Vægt :</strong> {{Auth::user()->portalInfo->coupleMale()->weight}}</td>
                </tr>
                <tr>
                    <td><strong>Hårfarve :</strong> {{Auth::user()->portalInfo->coupleMale()->hairColor}}</td>
                </tr>
                <tr>
                    <td><strong>Øjenfarve :</strong> {{Auth::user()->portalInfo->coupleMale()->eyeColor}}</td>
                </tr>
                <tr>
                    <td><strong>Seksualitet :</strong> {{Auth::user()->portalInfo->coupleMale()->sexualOrientation}}</td>
                </tr>
                <tr>
                    <td><strong>Kropsbygning :</strong> {{Auth::user()->portalInfo->coupleMale()->bodyType}}</td>
                </tr>
                <tr>
                    <td><strong>Piercinger :</strong> {{Auth::user()->portalInfo->coupleMale()->piercing}}</td>
                </tr>
                <tr>
                    <td><strong>Tatoveringer :</strong> {{Auth::user()->portalInfo->coupleMale()->tattoos}}</td>
                </tr>
                <tr>
                    <td><strong>Ryger :</strong> {{Auth::user()->portalInfo->coupleMale()->smoking}}</td>
                </tr>
                <tr>
                    <td><strong>Søger :</strong>
                        @if(Auth::user()->portalInfo->coupleMale()->searching !=null)
                            @foreach(json_decode(Auth::user()->portalInfo->coupleMale()->searching) as $male_s) 
                                <span style="margin:3px; font-size: 12px; font-weight: bold;" class="badge badge-pill badge-dark">{{$male_s}}</span>
                            @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>

            <tbody class="col-lg-6 col-xl-6 p-0">
                <tr>
                    <td><strong>Køn :</strong> {{Auth::user()->portalInfo->coupleFemale()->sex}}</td>
                </tr>
                <tr>
                    <td><strong>Lokation :</strong> {{Auth::user()->portalInfo->coupleFemale()->regionName}}</td>
                </tr>
                <tr>
                    <td><strong>Postnummer :</strong> {{Auth::user()->portalInfo->coupleFemale()->zipCode}}</td>
                </tr>
                <tr>
                    <td><strong>Civilstatus :</strong> {{Auth::user()->portalInfo->coupleFemale()->civilStatus}}</td>
                </tr>
                <tr>
                    <td><strong>Alder :</strong> {{Carbon\Carbon::parse(Auth::user()->portalInfo->coupleFemale()->dob)->age}} Years</td>
                </tr>
                <tr>
                    <td><strong>Højde :</strong> {{Auth::user()->portalInfo->coupleFemale()->height}}</td>
                </tr>
                <tr>
                    <td><strong>Vægt :</strong> {{Auth::user()->portalInfo->coupleFemale()->weight}}</td>
                </tr>
                <tr>
                    <td><strong>Hårfarve :</strong> {{Auth::user()->portalInfo->coupleFemale()->hairColor}}</td>
                </tr>
                <tr>
                    <td><strong>Øjenfarve :</strong> {{Auth::user()->portalInfo->coupleFemale()->eyeColor}}</td>
                </tr>
                <tr>
                    <td><strong>Seksualitet :</strong> {{Auth::user()->portalInfo->coupleFemale()->sexualOrientation}}</td>
                </tr>
                <tr>
                    <td><strong>Kropsbygning :</strong> {{Auth::user()->portalInfo->coupleFemale()->bodyType}}</td>
                </tr>
                <tr>
                    <td><strong>Piercinger :</strong> {{Auth::user()->portalInfo->coupleFemale()->piercing}}</td>
                </tr>
                <tr>
                    <td><strong>Tatoveringer :</strong> {{Auth::user()->portalInfo->coupleFemale()->tattoos}}</td>
                </tr>
                <tr>
                    <td><strong>Ryger :</strong> {{Auth::user()->portalInfo->coupleFemale()->smoking}}</td>
                </tr>
                <tr>
                    <td><strong>Søger :</strong>
                        @if(Auth::user()->portalInfo->coupleFemale()->searching !=null)
                            @foreach(json_decode(Auth::user()->portalInfo->coupleFemale()->searching) as $female_s) 
                                <span style="margin:3px; font-size: 12px; font-weight: bold;" class="badge badge-pill badge-dark">{{$female_s}}</span>
                            @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>

        </table>
        </table>
    </div>
<!-- Developed By CBS -->