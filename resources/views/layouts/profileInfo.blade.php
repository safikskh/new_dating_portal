<!-- Developed By CBS -->
    <div class="table-responsive ">
        <table class="table row table-borderless">
            <tbody class="col-lg-6 col-xl-6 p-0">
                <tr>
                    <td><strong>Køn :</strong> {{$profileItem->sex}}</td>
                </tr>
                <tr>
                    <td><strong>Lokation :</strong> {{$profileItem->regionName}}</td>
                </tr>
                <tr>
                    <td><strong>Postnummer :</strong> {{$profileItem->zipCode}}</td>
                </tr>
                <tr>
                    <td><strong>Civilstatus :</strong> {{$profileItem->civilStatus}}</td>
                </tr>
                <tr>
                    <td><strong>Alder :</strong> {{$profileItem->humanTime}} Years</td>
                </tr>
                <tr>
                    <td><strong>Højde :</strong> {{$profileItem->height}}</td>
                </tr>
                <tr>
                    <td><strong>Vægt :</strong> {{$profileItem->weight}}</td>
                </tr>
            </tbody>
            <tbody class="col-lg-6 col-xl-6 p-0">
                <tr>
                    <td><strong>Hårfarve :</strong> {{$profileItem->hairColor}}</td>
                </tr>
                <tr>
                    <td><strong>Øjenfarve :</strong> {{$profileItem->eyeColor}}</td>
                </tr>
                <tr>
                    <td><strong>Seksualitet :</strong> {{$profileItem->sexualOrientation}}</td>
                </tr>
                <tr>
                    <td><strong>Kropsbygning :</strong> {{$profileItem->bodyType}}</td>
                </tr>
                <tr>
                    <td><strong>Piercinger :</strong> {{$profileItem->piercing}}</td>
                </tr>
                <tr>
                    <td><strong>Tatoveringer :</strong> {{$profileItem->tattoos}}</td>
                </tr>
                <tr>
                    <td><strong>Ryger :</strong> {{$profileItem->smoking}}</td>
                </tr>
            </tbody>
            <tbody class="col-lg-12 col-xl-12 p-0">
                <tr>
                    <td><strong>Søger :</strong>
                        @if($profileItem->searching != null)
                            @foreach(json_decode($profileItem->searching) as $s) 
                                <span style="font-size: 12px; font-weight: bold;" class="badge badge-pill badge-dark">{{$s}}</span>
                            @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        </table>
    </div>
<!-- Developed By CBS -->