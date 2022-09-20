@section('head')
    <link rel="stylesheet" href="{{ asset('vendor/core/core/base/js/noty/noty.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/core/core/base/js/noty/themes/bootstrap-v3.css') }}">
@endsection

<div class="tab-content tab-content-in-right">
    <div class="tab-pane active">
        <div class="form-group mb-3">
            <form method="post" id="formslider" action="" enctype="multipart/form-data">
                @csrf
        
                <label>Nama File</label>
                <input class="form-control" type="text" name="name" value="" id="name"><br>
                
                <label>Gambar (780 x 260)</label>
                <input class="form-control" type="file" name="img" value="" id="img">
                <input class="form-control" type="hidden" name="img_name" id="img_name">
                <input class="form-control" type="hidden" name="idslider" id="idslider">
                <span id="filename"></span><br>
                
                <label>Link</label>
                <input class="form-control" type="text" name="link" value="" id="link"><br>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

            <div id="dataslider"></div>
            
        </div>
        <hr>
    </div>
</div>

@section('javascript-custom')
<script src="{{ asset('vendor/core/core/base/js/noty/noty.min.js') }}"></script>
<script type="text/javascript">

    Noty.overrideDefaults({
        layout: 'topRight',
        theme: 'bootstrap-v3',
        timeout: 3000
    });

    function ResetForm(){
        $('#name').val("");
        $('#img_name').val("");
        $('#idslider').val("");
        $('#link').val("");
        $('#filename').html("");

        var $el = $('#img');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();

        $(':input[type="submit"]').prop('disabled', false);
    }

    function view_data()
    {
        $.ajax({
            type: "POST",
            url: "{{ route('sliderku.data') }}",
            data: ({_token: "{{csrf_token()}}"}),
            beforeSend: function () {
                //
            },
            complete: function () {
                //
            },
            success: function (result) {
                if(result['status'] == 'success')
                {
                    $('#dataslider').html(result['data']);
                }
                else
                {
                    // new Noty({
                    //     type: 'error',
                    //     text: result['message'],
                    //     timeout: 2000,
                    // }).show();
                }
            },
            error: function (e) {
                // new Noty({
                //     type: 'error',
                //     text: 'Response error ' + e,
                //     timeout: 5000
                // }).show();
            }
        })
    }

    $("#formslider").on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ route('sliderku.store') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(':input[type="submit"]').prop('disabled', true);
            },
            error: function (e) {
                $(':input[type="submit"]').prop('disabled', false);
            },
            success: function (result) {
                if(result['status'] == 'success')
                {
                    new Noty({
                        type: 'success',
                        text: result['message'],
                        timeout: 2000,
                    }).show();
                    
                    view_data();
                    ResetForm();
                    $(':input[type="submit"]').prop('disabled', false);
                }
                else
                {
                    new Noty({
                        type: 'success',
                        text: result['message'],
                        timeout: 2000,
                    }).show();
                    $(':input[type="submit"]').prop('disabled', false);
                }
            }
        });

    });
    
    $(document).on("click", ".editslider", function (){

        var id = $(this).attr('ket-id');

        var editUrl = "{{ route('sliderku.edit.view', 'url') }}";
        editUrl = editUrl.replace('url', id);
        $.get(editUrl , function (data) {
            $('#name').val(data.data.name);
            $('#filename').html(data.data.img);
            $('#link').val(data.data.link);
            $('#idslider').val(data.data.id);
        })
    });

    $(document).on('click', '.hapuslider', function () {
        var ketid = $(this).attr('ket-id');
        var b = $(this).attr('ket-data');

        var n = new Noty({
            
            text: 'Apakah File <strong>' + b + '</strong> akan dihapus?',
            type: 'error',
            buttons: [
                Noty.button('YA', 'btn btn-success', function () {
                    n.close();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('sliderku.destroy') }}',
                        data: { _token: "{{csrf_token()}}", ketid: ketid},
                        success: function(result){
                            if(result['status'] == 'success')
                            {
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: result['msg'],
                                    
                                    timeout: 4000,
                                }).show();
                                view_data();
                            }
                            else
                            {
                                new Noty({
                                    type: 'error',
                                    layout: 'topRight',
                                    text: result['msg'],
                                    
                                    timeout: 4000,
                                }).show();
                            }
                        }
                    });

                }, {id: 'button1', 'data-status': 'ok'}),

                Noty.button('BATAL', 'btn btn-error', function () {
                    n.close();
                })
            ]
        }).show();

    });

    function showcostom(){
        var adminruang = document.getElementById("tab-adminruang");
        var admincustom = document.getElementById("tab-admincustom");
        var btnsaveadmin_t = document.getElementById("btnsaveadmin-top");
        var btnsaveadmin_b = document.getElementById("btnsaveadmin-bottom");

        admincustom.style.display = "block";
        adminruang.style.display = "none";
        btnsaveadmin_t.style.display = "none";
        btnsaveadmin_b.style.display = "none";

        $('#dataslider').fadeIn();
        ResetForm();
        view_data();
    }

    function hidecostom(){
        var adminruang = document.getElementById("tab-adminruang");
        var admincustom = document.getElementById("tab-admincustom");
        var btnsaveadmin_t = document.getElementById("btnsaveadmin-top");
        var btnsaveadmin_b = document.getElementById("btnsaveadmin-bottom");

        adminruang.style.display = "block";
        admincustom.style.display = "none";
        btnsaveadmin_t.style.display = "block";
        btnsaveadmin_b.style.display = "block";

        $('#dataslider').fadeOut();
    }
</script>
@endsection