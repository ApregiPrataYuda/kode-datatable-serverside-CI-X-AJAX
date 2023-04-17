  <script>
 $(document).ready(function() {
        $('#table1').DataTable({
             "processing": true,
             "serverSide": true,
             "ajax": {

               "url": "<?=site_url('Item/get_ajax')?>",
               "type": "POST",
             },

             "columnDefs": [
               {
                 "targets": [5],
                 "ClassName": 'text-center',
               },

               {
                 "targets": [7,8],
                 "orderable": false,
               },

             ]

        })
 }) 
</script>



//kode kedua bisa pilih salah satu saja atas / bawah
$(document).ready(function() {
    tbl_store = $('#tbl_store').DataTable({ 
        "processing": true, 
        "serverSide": true, 
        "order": [], 
        "ajax": {
            "url": "<?php echo site_url('master/store/store_controller/Data/')?>",
            "type": "POST"
        },
        "columnDefs": [
        { 
            "targets": [ 0,5 ], 
            "orderable": false, 
        }
        ],
    });
});
