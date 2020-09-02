@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            <div class="card">
                <div class="card-header">{{ __('user.applyformheader') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.apply.create')}}">
                      @csrf
                      <!-- full name -->
                      <div class="form-group row" title="{{ __('user.fullname_ic_hint') }}">
                        <label for="fullname" class="col-md-3 col-form-label text-md-right">{{ __('user.fullname_ic_label') }}</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname" value="{{ old('fullname') }}" required/>
                          @if ($errors->has('fullname'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ __($errors->first('fullname')) }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <!-- state -->
                      <div class="form-group row" title="{{ __('user.state_hint') }}">
                        <label for="state_id" class="col-md-3 col-form-label text-md-right">{{ __('user.state_label') }}</label>
                        <div class="col-md-7">
                          <select class="form-control" id="state_id" name="state_id" required>
                            @foreach ($states as $state)
                            <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }} >{{ $state->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!-- Applicant Group -->
                      <div class="form-group row" title="{{ __('user.app_grp_hint') }}">
                        <label for="app_grp_id" class="col-md-3 col-form-label text-md-right">{{ __('user.app_grp_label') }}</label>
                        <div class="col-md-7">
                          <select class="form-control" id="app_grp_id" name="app_grp_id" required>
                            @foreach ($appgrps as $ag)
                            <option value="{{ $ag->id }}" {{ old('app_grp_id') == $ag->id ? 'selected' : '' }} >{{ $ag->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!-- personal ID -->
                      <div class="form-group row" title="{{ __('user.personal_id_hint') }}">
                        <label for="personal_id" class="col-md-3 col-form-label text-md-right">{{ __('user.personal_id_label') }}</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control @error('personal_id') is-invalid @enderror" name="personal_id" id="personal_id" value="{{ old('personal_id') }}" required/>
                          @if ($errors->has('personal_id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ __($errors->first('personal_id')) }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <!-- submit button -->
                      <div class="form-group row mb-0 justify-content-center">
                        <button type="submit" class="btn btn-primary m-1">{{ __('user.btn_add_contacts') }}</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
