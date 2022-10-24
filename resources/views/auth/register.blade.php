@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"  style=" color:black;">{{ __('新規登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <p style="text-align:center; color:black;">名前は一度登録すると変更ができません</p>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('名前') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('E-Mail アドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('パスワードを確認') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        <!--年齢 -->
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('年齢') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!--性別 -->
                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('性別') }}</label>

                            <div class="col-md-6">
                                <!--<input id="sex" type="text" class="form-control @error('sex') is-invalid @enderror" name="sex" value="{{ old('sex') }}" required autocomplete="sex" autofocus>-->
                                <select id="sex" type="text" class="form-control @error('sex') is-invalid @enderror" name='sex'value="{{ old('sex') }}" required autocomplete="sex" autofocus>
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
                        
                        <!--image画像 -->
                        <!--<div class="form-group row">-->
                        <!--    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('画像') }}</label>-->

                        <!--    <div class="col-md-6">-->
                        <!--        <input id="image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" value="{{ old('profile_image') }}" required autocomplete="image" autofocus>-->

                        <!--        @error('profile_image')-->
                        <!--            <span class="invalid-feedback" role="alert">-->
                        <!--                <strong>{{ $message }}</strong>-->
                        <!--            </span>-->
                        <!--        @enderror-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <!--apexランク-->
                        <div class="form-group row">
                            <label for="apex_rank" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('Apex ランク') }}</label>

                            <div class="col-md-6">
                                <!--<input id="apex_rank" type="text" class="form-control @error('apex_rank') is-invalid @enderror" name="apex_rank" value="{{ old('apex_rank') }}" required autocomplete="apex_rank" autofocus>-->
                                <select id="apex_rank" class="form-control @error('apex_rank') is-invalid @enderror" name='apex_rank'value="{{ old('apex_rank') }}" required autocomplete="apex_rank" autofocus>
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
                            <label for="valorant_rank" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('Valorant ランク') }}</label>

                            <div class="col-md-6">
                                <!--<input id="valorant_rank" type="text" class="form-control @error('valorant_rank') is-invalid @enderror" name="valorant_rank" value="{{ old('valorant_rank') }}" required autocomplete="valorant_rank" autofocus>-->
                                <select id="valorant_rank" class="form-control @error('valorant_rank') is-invalid @enderror" name='valorant_rank'value="{{ old('valorant_rank') }}" required autocomplete="valorant_rank" autofocus>
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
                            <label for="pubg_rank" class="col-md-4 col-form-label text-md-right" style=" color:black;">{{ __('PUBG ランク') }}</label>

                            <div class="col-md-6">
                                <!--<input id="pubg_rank" type="text" class="form-control @error('pubg_rank') is-invalid @enderror" name="pubg_rank" value="{{ old('pubg_rank') }}" required autocomplete="pubg_rank" autofocus>-->
                                <select id="pubg_rank" class="form-control @error('pubg_rank') is-invalid @enderror" name='pubg_rank'value="{{ old('pubg_rank') }}" required autocomplete="pubg_rank" autofocus>
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
