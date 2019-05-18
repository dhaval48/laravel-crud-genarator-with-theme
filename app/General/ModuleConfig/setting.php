
        <?php

        $formelements = [
            // "enable_registration" => "",
		    'app_name' => "",
            'favicon' => "",
            'nav_color' => "",
            'side_color' => "",  
		// [SettingArray]
		];
		
        $formelements["_token"] = csrf_token();
		$data =  [
                'lang' => Lang::get('settings'),
                'common' => Lang::get('label.common'),
                
                'dir'  => 'setting',
                'id' => 0,
                'is_visible' => false,
                
                'list_route'  =>  route('setting.index'),
                'store_route'  => route('setting.store'),
                'get_activity' => route('get.activity'),
                'get_file' => route('get.file'),
                
				// [SettingModule]
            ];
		$data["fillable"] = $formelements;
		$data["nav_colors"] = ["Yellow","Red","Blue","Green","Purple"];
        $data["side_colors"] = ["Yellow","Red","Blue","Green","Purple"];
		// [SettingGrid]
		return $data;

        