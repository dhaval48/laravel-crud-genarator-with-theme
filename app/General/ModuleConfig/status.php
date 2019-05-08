
        <?php

        $formelements = ["name" => "",
		
		// [StatusArray]
		];
		
        $formelements["_token"] = csrf_token();
		$data =  [
                'lang' => Lang::get('status'),
                'common' => Lang::get('label.common'),
                
                'dir'  => 'status',
                'id' => 0,
                'is_visible' => true,
                
                'list_route'  =>  route('status.index'),
                'store_route'  => route('status.store'),
                'paginate_route'  => route('status.paginate'),
                'edit_route'  => route('status.edit',''),
                'create_route'  => route('status.create'),
                'destory_route' => route('status.destroy'),
                'get_activity' => route('get.activity'),
                'get_file' => route('get.file'),
                
				// [StatusModule]
            ];
		$data["fillable"] = $formelements;
		
		// [StatusGrid]
		return $data;

        