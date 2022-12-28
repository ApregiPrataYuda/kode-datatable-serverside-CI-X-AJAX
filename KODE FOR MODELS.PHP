// start datatables
    var $column_order = array(null, 'barcode', 'item.name', 'categori_name', 'unit_name', 'gudang_name','distributor_name', 'price', 'stock'); //set column field database for datatable orderable
    var $column_search = array('barcode', 'item.name', 'price'); //set column field database for datatable searchable
    var $order = array('item_id' => 'asc'); // default order 
 
    private function _get_datatables_query() {
         $this->db->select('item.*,unit.name as unit_name,category.name as categori_name,gudang.name as gudang_name,distributor.name as distributor_name');
        $this->db->from('item');
        $this->db->join('category', 'item.categori_id = category.categori_id');
        $this->db->join('unit', 'item.unit_id = unit.unit_id');
         $this->db->join('gudang', 'item.gudang_id = gudang.gudang_id');
          $this->db->join('distributor', 'item.distributor_id = distributor.distributor_id');
       
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('item');
        return $this->db->count_all_results();
    }
    // end datatables
