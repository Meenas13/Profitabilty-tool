@extends('layouts.main')
@section('title', 'Offer')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-blue"></i>
                    <div class="d-inline">
                        <h5>Offer</h5>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Offer</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-md-12">
            <div class="card" >
                <br>
                <div style="text-align: center !important;" class="card-options">
                    <h3 style="border: 3px solid #007bff;">Forecasted OTI = <span id="forecasted">0%</span></h3>
                </div>
                <div class="card-body">
                    <table id="advanced_table" class="table table-striped table-bordered nowrap dataTable">
                        <thead style="text-align: center;">
                            <tr valign="center">

                                <th width="15%">Buy Domain</th>
                                <th width="15%">Subsys<br>Art No</th>
                                <th width="15%">Subsys<br>Art Name</th>
                                <th width="15%"> Status</th>
                                <th>Colli</th>
                                <th>Requested Price<br>/<br>MU</th>
                                

                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $offer)
                            <tr>
                                <td>{{$offer->buy_domain_no}}</td>
                                <td>{{$offer->subsys_art_no}}</td>
                                <td>{{$offer->article}}</td>
                                <td>{{$offer->status_article}}</td>
                                <td><input type="text" name="colli[]" value="0" class="form-control colli"></td>
                                <td>
                                    <input type="text" name="selling[]" value="0" class="form-control selling">
                                    <input type="hidden" name="buying[]" value="{{$offer->nn_buy_pr_ho_curr}}" class="form-control buying">
                                </td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-options text-right mt-5">

                        <button type="button" id="calculate" class="btn btn-primary mt-5 mb-2">Calculate</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@push('script')
<script type="text/javascript">
    $("#calculate").on("click", function() {
        $('#calculate').prop('disabled', true);
        var selling = [];
        $(".selling").each(function() {
            selling.push($(this).val());
        });

        var colli = [];
        $(".colli").each(function() {
            colli.push($(this).val());
        });
        var buying = [];
        $(".buying").each(function() {
            buying.push($(this).val());
        });
        $.ajax({
            method: "POST",
            url: "{{route('forcasted-cal')}}",
            dataType: "json",
            data: {
                '_token': $('meta[name="_token"]').attr('content'),
                'selling': selling,
                'colli': colli,
                'buying': buying,
            },
            success: function(response) {
                
                $('#calculate').prop('disabled', false);
                if(response=="Less Then Zero"){
                    $("#forecasted").text(response);
                    $("#forecasted").css("color", "red");
                }else{
                    $("#forecasted").css("color", "");
                    $("#forecasted").text(response+'%');
                }
                
            },
            fail: function(response) {
               
            }
        });
        $('#calculate').prop('disabled', false);
    });
</script>
@endpush


@endsection