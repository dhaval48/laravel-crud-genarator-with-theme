
        <?php

        $formelements = ["color" => "",
		
		// [ThemesettingArray]
		];
		
        $formelements["_token"] = csrf_token();
		$data =  [
                'lang' => Lang::get('theme_settings'),
                'common' => Lang::get('label.common'),
                
                'dir'  => 'themesetting',
                'id' => 0,
                'is_visible' => true,
                
                'list_route'  =>  route('themesetting.index'),
                'store_route'  => route('themesetting.store'),
                // 'paginate_route'  => route('themesetting.paginate'),
                // 'edit_route'  => route('themesetting.edit',''),
                // 'create_route'  => route('themesetting.create'),
                // 'destory_route' => route('themesetting.destroy'),
                'get_activity' => route('get.activity'),
                'get_file' => route('get.file'),
                
				// [ThemesettingModule]
            ];
		$data["fillable"] = $formelements;
		$data["color"] = ["Yellow","Red","Blue","Green","Purple"];
			
		// [ThemesettingGrid]
		return $data;

        