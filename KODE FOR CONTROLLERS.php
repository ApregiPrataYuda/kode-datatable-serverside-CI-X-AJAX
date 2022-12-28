 
 function get_ajax() {
        $list = $this->Item_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->barcode.'<br><a href="'.site_url('Item/barcode_qrcode/'.$item->item_id).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
            $row[] = $item->name;
            $row[] = $item->categori_name;
            $row[] = indo_currency($item->price);
            $row[] = $item->unit_name;
            $row[] = $item->stock;
             $row[] = $item->gudang_name;
            $row[] = $item->distributor_name;
            $row[] = $item->image != null ? '<img src="'.base_url('image/product/'.$item->image).'" class="img" style="width:100px">' : null;
            // add html for action
            $row[] = '<a href="'.site_url('Item/edit/'.$item->item_id).'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> </a> 
                    <a href="'.site_url('Item/delete/'.$item->item_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Item_m->count_all(),
                    "recordsFiltered" => $this->Item_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }
