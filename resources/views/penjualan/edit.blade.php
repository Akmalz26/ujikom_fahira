<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="pelanggan_id">

                <div class="form-group">
                        <label for="tgl">Tanggal</label>
                        <input type="date" class="form-control" id="tgl" name="tgl">
                    </div>
            
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                    </div>

                    <div class="form-group">
                        <label for="id_pelanggan">pelanggan</label>
                        <select class="form-control" id="id_pelanggan" name="id_pelanggan">
                            <option value="">Pilih pelanggan</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nmae }}</option>
                            @endforeach
                        </select>
                    </div>

            </div>

<script>
    //button create penjualan event
    $('body').on('click', '#btn-edit-penjualan', function () {

        let pelanggan_id = $(this).data('id');

        //fetch detail penjualan with ajax
        $.ajax({
            url: `/penjualan/${penjualan_id}`,
            type: "GET",
            cache: false,
            success:function(response){

                //fill data to form
                $('#tanggal-edit').val(response.data.tanggal);
                $('#total-edit').val(response.data.total);
                $('#id_pelanggan-edit').val(response.data.id_pelanggan);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update penjualan
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let tanggal   = $('#tanggal').val();
        let jumlah = $('#jumlah').val();
        let id_pelanggan = $('#id_pelanggan').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/penjualan`,
            type: "POST",
            cache: false,
            data: {
                "tanggal": tanggal,
                "jumlah": jumlah,
                "id_pelanggan": id_pelanggan,
                "_token": token
            },
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                              //data penjualan
                              let penjualan = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.tanggal}</td>
                        <td>${response.data.jumlah}</td>
                        <td>${response.data.id_pelanggan}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-penjualan" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-penjualan" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                //append to penjualan data
                $(`#index_${response.data.id}`).replaceWith(penjualan);

                //close modal
                $('#modal-edit').modal('hide');
                

            },
            // error:function(error){
                
            //     if(error.responseJSON.title[0]) {

            //         //show alert
            //         $('#alert-title-edit').removeClass('d-none');
            //         $('#alert-title-edit').addClass('d-block');

            //         //add message to alert
            //         $('#alert-title-edit').html(error.responseJSON.title[0]);
            //     } 

            //     if(error.responseJSON.content[0]) {

            //         //show alert
            //         $('#alert-content-edit').removeClass('d-none');
            //         $('#alert-content-edit').addClass('d-block');

            //         //add message to alert
            //         $('#alert-content-edit').html(error.responseJSON.content[0]);
            //     } 

            // }

        });

    });

</script>