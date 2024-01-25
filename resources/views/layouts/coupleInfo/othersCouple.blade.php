<!-- Developed By CBS -->
    <div class="table-responsive ">
        <table class="table row table-borderless">

            <tbody class="col-lg-6 col-xl-6 p-0">
                <tr>
                    <td><strong>Køn :</strong> {{$othersUser->portalInfo->coupleMale()->sex}}</td>
                </tr>
                <tr>
                    <td><strong>Lokation :</strong> {{$othersUser->portalInfo->coupleMale()->regionName}}</td>
                </tr>
                <tr>
                    <td><strong>Postnummer :</strong> {{$othersUser->portalInfo->coupleMale()->zipCode}}</td>
                </tr>
                <tr>
                    <td><strong>Civilstatus :</strong> {{$othersUser->portalInfo->coupleMale()->civilStatus}}</td>
                </tr>
                <tr>
                    <td><strong>Alder :</strong> {{Carbon\Carbon::parse($othersUser->portalInfo->coupleMale()->dob)->age}} Years</td>
                </tr>
                <tr>
                    <td><strong>Højde :</strong> {{$othersUser->portalInfo->coupleMale()->height}}</td>
                </tr>
                <tr>
                    <td><strong>Vægt :</strong> {{$othersUser->portalInfo->coupleMale()->weight}}</td>
                </tr>
                <tr>
                    <td><strong>Hårfarve :</strong> {{$othersUser->portalInfo->coupleMale()->hairColor}}</td>
                </tr>
                <tr>
                    <td><strong>Øjenfarve :</strong> {{$othersUser->portalInfo->coupleMale()->eyeColor}}</td>
                </tr>
                <tr>
                    <td><strong>Seksualitet :</strong> {{$othersUser->portalInfo->coupleMale()->sexualOrientation}}</td>
                </tr>
                <tr>
                    <td><strong>Kropsbygning :</strong> {{$othersUser->portalInfo->coupleMale()->bodyType}}</td>
                </tr>
                <tr>
                    <td><strong>Piercinger :</strong> {{$othersUser->portalInfo->coupleMale()->piercing}}</td>
                </tr>
                <tr>
                    <td><strong>Tatoveringer :</strong> {{$othersUser->portalInfo->coupleMale()->tattoos}}</td>
                </tr>
                <tr>
                    <td><strong>Ryger :</strong> {{$othersUser->portalInfo->coupleMale()->smoking}}</td>
                </tr>
                <tr>
                    <td><strong>Søger :</strong>
                        @if($othersUser->portalInfo->coupleMale()->searching !=null)
                            @foreach(json_decode($othersUser->portalInfo->coupleMale()->searching) as $male_s) 
                                <span style="margin:3px; font-size: 12px; font-weight: bold;" class="badge badge-pill badge-dark">{{$male_s}}</span>
                            @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>

            <tbody class="col-lg-6 col-xl-6 p-0">
                <tr>
                    <td><strong>Køn :</strong> {{$othersUser->portalInfo->coupleFemale()->sex}}</td>
                </tr>
                <tr>
                    <td><strong>Lokation :</strong> {{$othersUser->portalInfo->coupleFemale()->regionName}}</td>
                </tr>
                <tr>
                    <td><strong>Postnummer :</strong> {{$othersUser->portalInfo->coupleFemale()->zipCode}}</td>
                </tr>
                <tr>
                    <td><strong>Civilstatus :</strong> {{$othersUser->portalInfo->coupleFemale()->civilStatus}}</td>
                </tr>
                <tr>
                    <td><strong>Alder :</strong> {{Carbon\Carbon::parse($othersUser->portalInfo->coupleFemale()->dob)->age}} Years</td>
                </tr>
                <tr>
                    <td><strong>Højde :</strong> {{$othersUser->portalInfo->coupleFemale()->height}}</td>
                </tr>
                <tr>
                    <td><strong>Vægt :</strong> {{$othersUser->portalInfo->coupleFemale()->weight}}</td>
                </tr>
                <tr>
                    <td><strong>Hårfarve :</strong> {{$othersUser->portalInfo->coupleFemale()->hairColor}}</td>
                </tr>
                <tr>
                    <td><strong>Øjenfarve :</strong> {{$othersUser->portalInfo->coupleFemale()->eyeColor}}</td>
                </tr>
                <tr>
                    <td><strong>Seksualitet :</strong> {{$othersUser->portalInfo->coupleFemale()->sexualOrientation}}</td>
                </tr>
                <tr>
                    <td><strong>Kropsbygning :</strong> {{$othersUser->portalInfo->coupleFemale()->bodyType}}</td>
                </tr>
                <tr>
                    <td><strong>Piercinger :</strong> {{$othersUser->portalInfo->coupleFemale()->piercing}}</td>
                </tr>
                <tr>
                    <td><strong>Tatoveringer :</strong> {{$othersUser->portalInfo->coupleFemale()->tattoos}}</td>
                </tr>
                <tr>
                    <td><strong>Ryger :</strong> {{$othersUser->portalInfo->coupleFemale()->smoking}}</td>
                </tr>
                <tr>
                    <td><strong>Søger :</strong>
                        @if($othersUser->portalInfo->coupleFemale()->searching !=null)
                            @foreach(json_decode($othersUser->portalInfo->coupleFemale()->searching) as $female_s) 
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