
        <?php

        $formelements = ["name" => "",
		"postcode" => "",
		"area_no" => "",
		
		// [LocationArray]
		];
		
        $formelements["_token"] = csrf_token();
		$data =  [
                'lang' => Lang::get('location'),
                'common' => Lang::get('label.common'),
                
                'dir'  => 'location',
                'id' => 0,
                'is_visible' => true,
                
                'list_route'  =>  route('location.index'),
                'store_route'  => route('location.store'),
                'paginate_route'  => route('location.paginate'),
                'edit_route'  => route('location.edit',''),
                'create_route'  => route('location.create'),
                'destory_route' => route('location.destroy'),
                'get_activity' => route('get.activity'),
                'get_file' => route('get.file'),
                
				// [LocationModule]
            ];
		$data["fillable"] = $formelements;
		
		// [LocationGrid]
		return $data;

        