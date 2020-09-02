@extends('layouts.app')

@section('page-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            <div class="card">
                <div class="card-header">{{ __('user.applyformheader') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.apply.update')}}">
                      @csrf
                      <input type="hidden" name="aid" value="{{ $apl->id }}" />
                      <!-- full name -->
                      <div class="form-group row" title="{{ __('user.fullname_ic_hint') }}">
                        <label for="fullname" class="col-md-3 col-form-label text-md-right">{{ __('user.fullname_ic_label') }}</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname" value="{{ old('fullname', $apl->name) }}" required/>
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
                            <option value="{{ $state->id }}" {{ old('state_id', $apl->state_id) == $state->id ? 'selected' : '' }} >{{ $state->name }}</option>
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
                            <option value="{{ $ag->id }}" {{ old('app_grp_id', $apl->applicant_group_id) == $ag->id ? 'selected' : '' }} >{{ $ag->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!-- personal ID -->
                      <div class="form-group row" title="{{ __('user.personal_id_hint') }}">
                        <label for="personal_id" class="col-md-3 col-form-label text-md-right">{{ __('user.personal_id_label') }}</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control @error('personal_id') is-invalid @enderror" name="personal_id" id="personal_id" value="{{ old('personal_id', $apl->personal_id) }}" required/>
                          @if ($errors->has('personal_id'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ __($errors->first('personal_id')) }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <!-- submit button -->
                      <div class="form-group row mb-0 justify-content-center">
                        <button type="submit" name="act" value="update" class="btn btn-primary m-1">{{ __('user.btn_update') }}</button>
                        @if($apl->canSubmit())
                        <button type="submit" name="act" value="submit" class="btn btn-success m-1">{{ __('user.btn_submit') }}</button>
                        @endif
                      </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-10 mb-3">
          <div class="card">
            <div class="card-header">
              {{ __('user.contact_header') }}
              <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addContactModal">
                <i class="fa fa-plus"></i> {{ __('table.add') }}
              </button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="taskdetailtable" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">{{ __('table.type') }}</th>
                      <th scope="col">{{ __('table.contactinfo') }}</th>
                      <th scope="col">{{ __('table.remark') }}</th>
                      <th scope="col">{{ __('table.actions') }}</th>
                    </tr>
                  </thead>
                  <tbody id="tblbod">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- add popup -->
        <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('table.m_add_ctc') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('table.close') }}">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ route('user.contact.add', [], false) }}">
                @csrf
                <div class="modal-body">
                  <input type="hidden" value="{{ $apl->id }}" name="aid" />
                  <div class="form-group row">
                    <label for="edit-key" class="col-sm-4 col-form-label text-sm-right">{{ __('table.type') }}</label>
                    <select class="form-control col-sm-6" name="ctc_type" required>
                      <option value="mobile_phone">{{ __('lov.mobile_phone') }}</option>
                      <option value="email">{{ __('lov.email') }}</option>
                      <option value="address">{{ __('lov.address') }}</option>
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="edit-value" class="col-sm-4 col-form-label text-sm-right">{{ __('table.contactinfo') }}</label>
                    <input type="text" class="form-control col-sm-6" name="ctc_info" >
                  </div>
                  <div class="form-group row">
                    <label for="edit-value" class="col-sm-4 col-form-label text-sm-right">{{ __('table.remark') }}</label>
                    <input type="text" class="form-control col-sm-6" name="remark" >
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('table.close') }}</button>
                  <button type="submit" class="btn btn-primary">{{ __('table.save') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>

<!-- dummy form for delete -->
<form id="delform" method="post" action="{{ route('user.contact.del')}}">
  @csrf
  <input type="hidden" id="del_aid" name="aid" value="{{ $apl->id }}" />
  <input type="hidden" id="del_cid" name="cid" value="0" />
</form>
@endsection

@section('page-js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

function reloadContact() {
  contact_table.clear();
  $.ajax({
    'url': "{{ route('wa.appcontact', ['aid' => $apl->id]) }}",
    'method': "GET",
    'contentType': 'application/json'
  }).done( function(data) {
    contact_table.rows.add(data).draw();
  });
}

function deleteCtc(aidi) {
  // alert("not del : " + aidi);
  if(confirm("{{ __('alerts.confirm_del') }}")){
    document.getElementById('del_cid').value = aidi;
    $('#delform').submit();
  }
}

$(document).ready(function() {
    contact_table = $('#taskdetailtable').DataTable({
      oLanguage: {
        "sSearch": "{{ __('table.filter') }}"
      },
      columns : [
        { "data": "type" },
        { "data": "ctc" },
        { "data": "remark" },
        {
          "data": 'id',
          render: function(data, type, row){
            return '<button type="button" class="btn btn-xs btn-np" title="{{ __('table.delete') }}" onclick="deleteCtc('+data+')"><i class="fa fa-trash"></i></button>';
          }
        }
      ]
     });

     reloadContact();
} );

</script>

@endsection
