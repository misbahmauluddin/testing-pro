
<div class="container padtop50">
    <div class="row">
        <div class="col-md-12">
            <div class="vertical-tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab" style="display: block;">Profile</a></li>
                    <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab" style="display: block;">My bookings</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    

                    <div role="tabpanel" class="tab-pane fade in active show" id="Section1">
                        <h3>Profile</h3>
                        <div style="border: 1px dashed #e4e6ef;padding: 1rem 1rem;">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover vertical-middle dataTable no-footer dtr-inline">
                                    <thead>
                                        <tr role="row">
                                            <th style="width: 30%;">Property</th>
                                            <th style="width: 30%;">Status</th>
                                            <th style="width: 30%;">Durasi</th>
                                        </tr>
                                    </thead>
                                    <tbody style="white-space: nowrap;">
                                        <tr>
                                            <td>Kantor Jakarta Pusat</td>
                                            <td>Menunggu Pembayaran</td>
                                            <td>12 Bulan</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section2">
                        <h3>My bookings</h3>
                        <div style="border: 1px dashed #e4e6ef;padding: 1rem 1rem;">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover vertical-middle dataTable no-footer dtr-inline">
                                    <thead>
                                        <tr role="row">
                                            <th style="width: 30%;">Property</th>
                                            <th style="width: 30%;">Status</th>
                                            <th style="width: 30%;">Durasi</th>
                                        </tr>
                                    </thead>
                                    <tbody style="white-space: nowrap;">
                                        <tr>
                                            <td>Kantor Jakarta Pusat</td>
                                            <td>Menunggu Pembayaran</td>
                                            <td>12 Bulan</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @section('js-custom') --}}
{{-- <script src="{{ asset('vendor/core/core/base/js/noty/noty.min.js') }}"></script> --}}

{{-- <script type="text/javascript">

    Noty.overrideDefaults({
        layout: 'topRight',
        theme: 'bootstrap-v3',
        timeout: 3000
    });
</script> --}}
{{-- @endsection --}}