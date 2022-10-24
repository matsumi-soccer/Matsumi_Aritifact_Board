@extends('layouts.app')
@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>chat</title>
        <link rel="stylesheet" href="/css/edit.css">
    </head>
    <body>
        <div class="profile-edit-body">
            <div class="edit-profile">
                <h3>プロフィール編集</h3>
                <p>{{Auth::user()->name}}</p>
            　　<form action="/profile/{{Auth::user()->id}}" method="POST">
             　 @csrf
              　@method('PUT')
                <div class="profile__body">
                    
                    <!--email変更-->
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right" style=" color:#DDDDD;">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="user[email]" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        
                    <!--年齢 -->
                    <div class="form-group row">
                        <label for="age" class="col-md-4 col-form-label text-md-right" style=" color:#DDDDD;;">{{ __('Age') }}</label>

                        <div class="col-md-6">
                            <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="user[age]" value="{{ old('age') }}" required autocomplete="age" autofocus>
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        
                    <!--性別 -->
                    <div class="form-group row">
                        <label for="sex" class="col-md-4 col-form-label text-md-right" style=" color:#DDDDD;">{{ __('Sex') }}</label>

                        <div class="col-md-6">
                            <!--<input id="sex" type="text" class="form-control @error('sex') is-invalid @enderror" name="sex" value="{{ old('sex') }}" required autocomplete="sex" autofocus>-->
                            <select id="sex" type="text" class="form-control @error('sex') is-invalid @enderror" name='user[sex]'value="{{ old('sex') }}" required autocomplete="sex" autofocus>
                                <option value = 'man'>男性</option>
                                <option value = 'woman'>女性</option>
                            </select>
                            
                            @error('sex')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        
                    <!--apexランク-->
                    <div class="form-group row">
                        <label for="apex_rank" class="col-md-4 col-form-label text-md-right" style=" color:#DDDDD;">{{ __('Apex_rank') }}</label>

                        <div class="col-md-6">
                            <!--<input id="apex_rank" type="text" class="form-control @error('apex_rank') is-invalid @enderror" name="apex_rank" value="{{ old('apex_rank') }}" required autocomplete="apex_rank" autofocus>-->
                            <select id="apex_rank" class="form-control @error('apex_rank') is-invalid @enderror" name='user[apex_rank]'value="{{ Auth::user()->apex_rank }}" required autocomplete="apex_rank" autofocus>
                                <option value = '1'>Predator</option>
                                <option value = '2'>Master</option>
                                <option value = '3'>Diamond</option>
                                <option value = '4'>Platinum</option>
                                <option value = '5'>Gold</option>
                                <option value = '6'>Silver</option>
                                <option value = '7'>Bronze</option>
                                <option value = '8'>Rookie</option>
                                <option value = '100'>Unlanked</option>
                            </select>

                            @error('apex_rank')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        
                    <!--Valorantランク -->
                    <div class="form-group row">
                        <label for="valorant_rank" class="col-md-4 col-form-label text-md-right" style=" color:#DDDDD;">{{ __('Valorant_rank') }}</label>

                        <div class="col-md-6">
                            <!--<input id="valorant_rank" type="text" class="form-control @error('valorant_rank') is-invalid @enderror" name="valorant_rank" value="{{ old('valorant_rank') }}" required autocomplete="valorant_rank" autofocus>-->
                            <select id="valorant_rank" class="form-control @error('valorant_rank') is-invalid @enderror" name='user[valorant_rank]'value="{{ old('valorant_rank') }}" required autocomplete="valorant_rank" autofocus>
                                <option value = '1'>Radiant</option>
                                <option value = '2'>Immortal</option>
                                <option value = '3'>Ascedant</option>
                                <option value = '4'>Diamond</option>
                                <option value = '5'>Platinum</option>
                                <option value = '6'>Gold</option>
                                <option value = '7'>Silver</option>
                                <option value = '8'>Bronze</option>
                                <option value = '9'>Iron</option>
                                <option value = '100'>Unlanked</option>
                            </select>

                            @error('valorant_rank')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        
                    <!--PUBGランク -->
                    <div class="form-group row">
                        <label for="pubg_rank" class="col-md-4 col-form-label text-md-right" style=" color:#DDDDD;">{{ __('PUBG_rank') }}</label>

                        <div class="col-md-6">
                            <!--<input id="pubg_rank" type="text" class="form-control @error('pubg_rank') is-invalid @enderror" name="pubg_rank" value="{{ old('pubg_rank') }}" required autocomplete="pubg_rank" autofocus>-->
                            <select id="pubg_rank" class="form-control @error('pubg_rank') is-invalid @enderror" name='user[pubg_rank]'value="{{ old('pubg_rank') }}" required autocomplete="pubg_rank" autofocus>
                                <option value = '1'>Grand Master</option>
                                <option value = '2'>Master</option>
                                <option value = '3'>Elite</option>
                                <option value = '4'>Diamond</option>
                                <option value = '5'>Platinum</option>
                                <option value = '6'>Gold</option>
                                <option value = '7'>Silver</option>
                                <option value = '8'>Bronze</option>
                                <option value = '100'>Unlanked</option>
                            </select>
                                
                            @error('pubg_rank')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
          　     </div>
              　<input type="submit" value="更新">
              </form>
            </div>
            
            
            <div class="footer"><a href="/posts/mypage">mypage / </a><a href="/">home</a></div>
        </div>
    </body>
    
</html>
@endsection