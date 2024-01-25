@extends('layouts.layout')
@section('pageTitle', ' | Søg')
@section('content')    
    <div class="row">
        <div class="col-lg-12">
            <div class="profile-high-light-area">
            <form id="statusForm" method="POST" action="{{route('post.advancesearch')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-title-area">
                                <div class="title-area">
                                    <h3>Søgning : </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="search-criteria advance-search-left">
                                <br>
                                <ul>
                                    <li>
                                        <input name="man" class="styled-checkbox" id="styled-checkbox-1"
                                    type="checkbox" value="{{App\Enums\Sex::getValue('Mand')}}" @if (array_key_exists('man', $search_criteria)) checked @endif>
                                        <label for="styled-checkbox-1">Mænd</label>
                                    </li>
                                    <li>
                                        <input name="woman" class="styled-checkbox" id="styled-checkbox-2"
                                                type="checkbox" value="{{App\Enums\Sex::getValue('Kvinde')}}" @if (array_key_exists('woman', $search_criteria)) checked @endif>
                                        <label for="styled-checkbox-2">Kvinder</label>
                                    </li>
                                    <li>
                                        <input name="couple" class="styled-checkbox" id="styled-checkbox-3"
                                                type="checkbox" value="{{App\Enums\Sex::getValue('Par')}}" @if (array_key_exists('couple', $search_criteria)) checked @endif>
                                        <label for="styled-checkbox-3">Par</label>
                                    </li>
                                </ul>
                                <p>Område : </p>
                                <select name="area[]" class="selectpicker" multiple data-live-search="true" title="Vælg område">
                                    {{-- <option disabled selected>Vælg område</option> --}}
                                    @foreach (App\Models\Region::all() as $item)
                                        <option value="{{ $item->id }} "@if (array_key_exists('area', $search_criteria) && in_array($item->id, $search_criteria['area'])) selected @endif>{{ $item->region_name }}</option>
                                    @endforeach
                                </select><br>

                                <input type="checkbox" id="havepicutre" class="styled-checkbox"
                                        name="havepictre" value="havepicutre" @if (array_key_exists('havepictre', $search_criteria)) checked @endif>
                                <label for="havepicutre">Har billeder</label>

                                <input type="checkbox" id="havevideo" class="styled-checkbox" name="havevideo"
                                        value="havevideo" @if (array_key_exists('havevideo', $search_criteria)) checked @endif>
                                <label for="havevideo">Har videoer</label>
                                {{-- <input type="checkbox" id="newid" class="styled-checkbox" name="userType"
                                        value="newUser">
                                <label for="newid">NEM-ID valideret</label> --}}
                                <input type="checkbox" id="inarelationship" class="styled-checkbox"
                                        name="inarelationship" value="i et forhold" @if (array_key_exists('inarelationship', $search_criteria)) checked @endif>
                                <label for="inarelationship">I forhold</label>
                                <br>
                               
                               
                               
                             
                                <label for="online-presence">Sidst online : </label> <br>
                                <select name="onlinePresence" class="selectpicker" title="Vælg">
                                    <option value="anyTime" @if (array_key_exists('onlinePresence', $search_criteria) && $search_criteria['onlinePresence'] == 'anyTime') selected @endif>Når som helst</option>
                                    <option value="online" @if (array_key_exists('onlinePresence', $search_criteria) && $search_criteria['onlinePresence'] == 'online') selected @endif>Online nu</option>
                                    <option value="lastDay" @if (array_key_exists('onlinePresence', $search_criteria) && $search_criteria['onlinePresence'] == 'lastDay') selected @endif>Seneste uge</option>
                                    <option value="lastWeek" @if (array_key_exists('onlinePresence', $search_criteria) && $search_criteria['onlinePresence'] == 'lastWeek') selected @endif>Seneste uge</option>
                                    <option value="lastMonth" @if (array_key_exists('onlinePresence', $search_criteria) && $search_criteria['onlinePresence'] == 'lastMonth') selected @endif>Seneste måned</option>
                                </select> <br>
                                {{-- <textarea type="text" name="onlineUserList" v-bind:value="allOnlineUserList"></textarea> --}}

                                <label for="matchword">Matchord : </label>
                                <br>
                                <div class="a-search-matchword">
                                    <input data-role="tagsinput"  placeholder="Matchord" name="matchword" class="input-height" @if (array_key_exists('matchword', $search_criteria)) value="{{ $search_criteria['matchword'] }}" @endif>
                                </div>
                                <br>
                                <label for="nmatchword">Søger : </label>
                                <br>
                                <select name="searching[]" class="selectpicker" multiple
                                         title="Vælg">
                                   @foreach (App\Enums\Searching::getValues() as $item)
                                    <option value="{{$item}}" @if (array_key_exists('searching', $search_criteria) && in_array($item, $search_criteria['searching'])) selected @endif> {{$item}}
                                    </option>
                                    @endforeach
                                </select>
                                
                            </div>


                        </div>
                        <div class="col-lg-7  advance-search-right">
                            <label>Alder :</label>
                            <select name="minAge" class="min-age search-selection">
                                <option disabled selected>Vælg min. alder</option>
                                @for($age = 18; $age <= 100; $age++)
                                    <option value="{{$age}}" @if (array_key_exists('minAge', $search_criteria) && $search_criteria['minAge'] == $age) selected @endif>{{$age}}</option>
                                @endfor
                            </select> <span>to</span>
                            <select name="maxAge" class="max-age search-selection">
                                <option disabled selected>Vælg max. alder</option>
                                @for($age = 18; $age <= 100; $age++)
                                    <option value="{{$age}}" @if (array_key_exists('maxAge', $search_criteria) && $search_criteria['maxAge'] == $age) selected @endif>{{$age}}</option>
                                @endfor
                            </select> <br>
                            <label>Vægt :</label>
                            <select name="minWeight" class="min-weight search-selection">
                                <option value="" disabled selected>Vælg min. vægt</option>
                                @foreach (App\Enums\Weight::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('minWeight', $search_criteria) && $search_criteria['minWeight'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> <span>to</span>
                            <select name="maxWeight" class="max-weight search-selection">
                                <option value="" disabled selected>Vælg max. vægt</option>
                                @foreach (App\Enums\Weight::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('maxWeight', $search_criteria) && $search_criteria['maxWeight'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> <br>
                            <label>Højde :</label>
                            <select name="minHeight" class="min-height search-selection">
                                <option value="" disabled selected>Vælg min. højde</option>
                                @foreach (App\Enums\Height::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('minHeight', $search_criteria) && $search_criteria['minHeight'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> <span>to</span>
                            <select name="maxHeight" class="max-height search-selection">
                                <option value="" disabled selected>Vælg max. højde</option>
                                @foreach (App\Enums\Height::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('maxHeight', $search_criteria) && $search_criteria['maxHeight'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> <br>
                            <label>Seksualitet :</label>
                            <select name="sexualOrientation" class="sexual-orientation search-selection">
                                <option value="" disabled selected>Vælg ...</option>
                                @foreach (App\Enums\SexualOrientation::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('sexualOrientation', $search_criteria) && $search_criteria['sexualOrientation'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> 
                            </select> <br>
                            <label>Kropsbygning :</label>
                            <select name="bodyType" class="sexual-orientation search-selection">
                                <option value="" disabled selected>Vælg ...</option>
                                @foreach (App\Enums\BodyType::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('bodyType', $search_criteria) && $search_criteria['bodyType'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> 
                            </select> 
                            <br>
                            <label>Tatoveringer :</label>
                            <select name="tattoos" class="totoverings search-selection">
                                <option value="" disabled selected>Vælg ...</option>
                                @foreach (App\Enums\Tattoos::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('tattoos', $search_criteria) && $search_criteria['tattoos'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> <br>
                            <label>Piercinger :</label>
                            <select name="piercing" class="priercings search-selection">
                                <option value="" disabled selected>Vælg ...</option>
                                @foreach (App\Enums\Piercing::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('piercing', $search_criteria) && $search_criteria['piercing'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> <br>
                            <label>Ryger :</label>
                            <select name="smoking" class="smoking search-selection">
                                <option value="" disabled selected>Vælg ...</option>
                                @foreach (App\Enums\Smoking::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('smoking', $search_criteria) && $search_criteria['smoking'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> 
                            </select> <br>
                            <label>Børn :</label>
                            <select name="children" class="smoking search-selection">
                                <option value="" disabled selected>Vælg ...</option>
                                @foreach (App\Enums\Children::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('children', $search_criteria) && $search_criteria['children'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> 
                            <br>
                            <label>Øjenfarve :</label>
                            <select style="margin-bottom: 0px;" name="eyeColor" class="sexual-orientation search-selection">
                                <option value="" disabled selected>Vælg ...</option>
                                @foreach (App\Enums\EyeColor::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('eyeColor', $search_criteria) && $search_criteria['eyeColor'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select> <br><br>
                            <label>Hårfarve :</label>
                            <select style="margin-bottom: 0px;" name="hairColor" class="sexual-orientation search-selection">
                                <option value="" disabled selected>Vælg ...</option>
                                @foreach (App\Enums\HairColor::getValues() as $item)
                                    <option value="{{ $item }}" @if (array_key_exists('hairColor', $search_criteria) && $search_criteria['hairColor'] == $item) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn-radiaus" 
                        style="padding:17px 50px; margin-top:
                            20px;letter-spacing: 2px;margin-left: 15px">Søg</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
