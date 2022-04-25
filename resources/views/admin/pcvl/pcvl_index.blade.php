@extends('home')

@section('title')
    Pcvl
@endsection

@section('extra-css')
@endsection

@section('index')
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="">
                        <h3>Number of Voters (PCVL) </h3>
                        {{-- <a href="{{ route('manage-voters.create') }}" class="btn btn-success btn-sm">Add New</a> --}}
                    </div>

                    
                    <div class="card-body">

                        <form action="POST" action="{{route('submitFilterPcvl')}}">
                            @csrf
                            <div class="float-right">
                                <div class="input-group borderbottom border-width-2">
                                    <input type="text" name="pcvlVotersFullName" id="" placeholder="Search voters name" class="rounded">
                                </div>
                            </div>
                        </form>

                        {{-- {{$pcvlData}} --}}
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Precinct No.</th>
                                        <th>Legend</th>
                                        <th>Voters Name</th>
                                        <th>Voters Address</th>
                                        <th>Municipality</th>
                                        <th>Barangay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pcvlData as $row)
                                        <tr>
                                            <td class="text-center">{{ ++$loop->index }}</td>
                                            <td>{{ $row->pcvlUploadPrecinctNumber }}</td>
                                            <td>{{ $row->pcvlUploadLegend }}</td>
                                            <td>{{ $row->pcvlUploadVotersName }}</td>
                                            <td>{{ $row->pcvlUploadVotersAddress }}</td>
                                            <td>{{ $row->pcvlMunicipality }}</td>
                                            <td>{{ $row->pcvlBarangay }}</td>
                                            {{-- <td class="text-center">
                                        <a href="#" class="btn btn-warning btn-sm disabled">Edit</a>
                                    </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="float-left">{{ $pcvlData->links() }}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
@endsection
