@extends('layouts.app')

@section('page-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-10 mb-3">
      <div class="card">
          <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
        <div class="card-body">
            {{ __('user.welcome') }}, {{ $user->name }}.
        </div>
      </div>
    </div>
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          {{ __('user.dashappheader') }}
          <a href="{{ route('user.apply.form') }}"><button class="btn btn-sm btn-success float-right" type="button">Apply</button></a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="taskdetailtable" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">{{ __('user.fullname_ic_label') }}</th>
                  <th scope="col">{{ __('user.app_grp_label') }}</th>
                  <th scope="col">{{ __('user.personal_id_label') }}</th>
                  <th scope="col">{{ __('table.status') }}</th>
                  <th scope="col">{{ __('table.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->applications as $apl)
                <tr>
                  <td>{{ $apl->name }}</td>
                  <td>{{ $apl->appgroup->name }}</td>
                  <td>{{ $apl->personal_id }}</td>
                  <td>{{ __('lov.' . $apl->status) }}</td>
                  <td>
                    <a href="{{ route('user.apply.details', ['uuid' => $apl->uuid])}}">
                      <button class="btn btn-sm" title="{{ __('table.vdetail')}}"><i class="fa fa-eye"></i></button>
                    </a>
                    @if($apl->canSubmit())
                    <a href="{{ route('user.apply.submit', ['uuid' => $apl->uuid])}}">
                      <button class="btn btn-sm" title="{{ __('user.btn_submit')}}"><i class="fa fa-letter"></i></button>
                    </a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#taskdetailtable').DataTable();
} );

</script>

@endsection
