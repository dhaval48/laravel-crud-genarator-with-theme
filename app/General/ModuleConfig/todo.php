
        <?php

        $formelements = ["name" => "",
		"description" => "",
		
		// [TodoArray]
		];
		
        $formelements["_token"] = csrf_token();
		$data =  [
                'lang' => Lang::get('todos'),
                'common' => Lang::get('label.common'),
                
                'dir'  => 'todo',
                'id' => 0,
                'is_visible' => true,
                
                'list_route'  =>  route('todo.index'),
                'store_route'  => route('todo.store'),
                'paginate_route'  => route('todo.paginate'),
                'edit_route'  => route('todo.edit',''),
                'create_route'  => route('todo.create'),
                'destory_route' => route('todo.destroy'),
                'get_activity' => route('get.activity'),
                'get_file' => route('get.file'),
                
				// [TodoModule]
            ];
		$data["fillable"] = $formelements;
		
		// [TodoGrid]
		return $data;

        