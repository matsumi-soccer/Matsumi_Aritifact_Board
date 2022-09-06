@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        <!--年齢 -->
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

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
                            <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sex') }}</label>

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
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="text" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!--apexランク-->
                        <div class="form-group row">
                            <label for="apex_rank" class="col-md-4 col-form-label text-md-right">{{ __('Apex_rank') }}</label>

                            <div class="col-md-6">
                                <!--<input id="apex_rank" type="text" class="form-control @error('apex_rank') is-invalid @enderror" name="apex_rank" value="{{ old('apex_rank') }}" required autocomplete="apex_rank" autofocus>-->
                                <select id="apex_rank" class="form-control @error('apex_rank') is-invalid @enderror" name='apex_rank'value="{{ old('apex_rank') }}" required autocomplete="apex_rank" autofocus>
                                    <option value = 'Predator'>Predator</option>
                                    <option value = 'Master'>Master</option>
                                    <option value = 'Diamond'>Diamond</option>
                                    <option value = 'Platinum'>Platinum</option>
                                    <option value = 'Gold'>Gold</option>
                                    <option value = 'Silver'>Silver</option>
                                    <option value = 'Bronze'>Bronze</option>
                                    <option value = 'Rookie'>Rookie</option>
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
                            <label for="valorant_rank" class="col-md-4 col-form-label text-md-right">{{ __('Valorant_rank') }}</label>

                            <div class="col-md-6">
                                <!--<input id="valorant_rank" type="text" class="form-control @error('valorant_rank') is-invalid @enderror" name="valorant_rank" value="{{ old('valorant_rank') }}" required autocomplete="valorant_rank" autofocus>-->
                                <select id="valorant_rank" class="form-control @error('valorant_rank') is-invalid @enderror" name='valorant_rank'value="{{ old('valorant_rank') }}" required autocomplete="valorant_rank" autofocus>
                                    <option value = 'Radiant'>Radiant</option>
                                    <option value = 'Immortal'>Immortal</option>
                                    <option value = 'Ascendant'>Ascedant</option>
                                    <option value = 'Diamond'>Diamond</option>
                                    <option value = 'Platinum'>Platinum</option>
                                    <option value = 'Gold'>Gold</option>
                                    <option value = 'Silver'>Silver</option>
                                    <option value = 'Bronze'>Bronze</option>
                                    <option value = 'Iron'>Iron</option>
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
                            <label for="pubg_rank" class="col-md-4 col-form-label text-md-right">{{ __('PUBG_rank') }}</label>

                            <div class="col-md-6">
                                <!--<input id="pubg_rank" type="text" class="form-control @error('pubg_rank') is-invalid @enderror" name="pubg_rank" value="{{ old('pubg_rank') }}" required autocomplete="pubg_rank" autofocus>-->
                                <select id="pubg_rank" class="form-control @error('pubg_rank') is-invalid @enderror" name='pubg_rank'value="{{ old('pubg_rank') }}" required autocomplete="pubg_rank" autofocus>
                                    <option value = 'Grand Master'>Grand Master</option>
                                    <option value = 'Master'>Master</option>
                                    <option value = 'Elite'>Elite</option>
                                    <option value = 'Diamond'>Diamond</option>
                                    <option value = 'Platinum'>Platinum</option>
                                    <option value = 'Gold'>Gold</option>
                                    <option value = 'Silver'>Silver</option>
                                    <option value = 'Bronze'>Bronze</option>
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
                                    {{ __('Register') }}
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
