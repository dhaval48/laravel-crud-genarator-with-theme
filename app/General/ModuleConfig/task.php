
        <?php

        $formelements = ["name" => "",
		"status" => "",
		"description" => "",
		
		// [TaskArray]
		];
		
        $formelements["_token"] = csrf_token();
		$data =  [
                'lang' => Lang::get('tasks'),
                'common' => Lang::get('label.common'),
                
                'dir'  => 'task',
                'id' => 0,
                'is_visible' => true,
                
                'list_route'  =>  route('task.index'),
                'store_route'  => route('task.store'),
                'paginate_route'  => route('task.paginate'),
                'edit_route'  => route('task.edit',''),
                'create_route'  => route('task.create'),
                'destory_route' => route('task.destroy'),
                'get_activity' => route('get.activity'),
                'get_file' => route('get.file'),
                'status_search' => route('get.status'),
				
				// [TaskModule]
            ];
		$data["fillable"] = $formelements;
		
		// [TaskGrid]
		return $data;

        