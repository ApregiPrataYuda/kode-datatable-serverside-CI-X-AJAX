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