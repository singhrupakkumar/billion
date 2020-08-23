<?php



namespace App;



use Illuminate\Database\Eloquent\Model;

use DB;

class Config extends Model

{

    protected $table = 'configs';

    protected $guarded=[];



    public static function fields(){ 



        $fields = [

            'Website' =>

                [

                    [

                        'name'          =>  'site_title',

                        'type'          =>  'text',

                        'label'         =>  'Website Title',

                        'placeholder'   =>  'Enter Website Title'

                    ],

                    [

                        'name'          =>  'logo',

                        'type'          =>  'file',

                        'label'         =>  'Logo'

                    ],

                    [

                        'name'          =>  'favicon',

                        'type'          =>  'file',

                        'label'         =>  'Favicon'

                    ]

                ],

            'Homepage' =>

                [

                    [

                        'name'          =>  'large_banner_text',

                        'type'          =>  'text',

                        'label'         =>  'Large Banner Text',

                        'placeholder'   =>  'Enter Large Banner Text'

                    ],

                    [

                        'name'          =>  'small_banner_text',

                        'type'          =>  'text',

                        'label'         =>  'Small Banner Text',

                        'placeholder'   =>  'Enter Small Banner Text'

                    ],

                    // [

                    //     'name'          =>  'home_banner',

                    //     'type'          =>  'file',

                    //     'label'         =>  'Homepage Banner'

                    // ]

                ],

            

            'Footer' =>

            [

                [

                    'name'          =>  'facebook_link',

                    'type'          =>  'text',

                    'label'         =>  'Facebook Link',

                    'placeholder'   =>  'Enter Facebook link'

                ],

                [

                    'name'          =>  'twitter_link',

                    'type'          =>  'text',

                    'label'         =>  'Twitter Link',

                    'placeholder'   =>  'Enter Twitter link'

                ],

                [

                    'name'          =>  'linkedin_link',

                    'type'          =>  'text',

                    'label'         =>  'Linkedin Link',

                    'placeholder'   =>  'Enter Linkedin link'

                ],

                [

                    'name'          =>  'instagram_link',

                    'type'          =>  'text',

                    'label'         =>  'Insragram Link',

                    'placeholder'   =>  'Enter Insragram link'

                ],

                [

                    'name'          =>  'google_link',

                    'type'          =>  'text',

                    'label'         =>  'Google Link',

                    'placeholder'   =>  'Enter Google link'

                ], 

                [

                    'name'          =>  'youtube_link',

                    'type'          =>  'text',

                    'label'         =>  'YouTube Link',

                    'placeholder'   =>  'Enter YouTube link'

                ],

                [

                    'name'          =>  'copyright',

                    'type'          =>  'text',

                    'label'         =>  'Copyright',

                    'placeholder'   =>  'Copyright'

                ]

            ],

            'Address' =>

            [

                [

                    'name'          =>  'address',

                    'type'          =>  'text',

                    'label'         =>  'Your Address',

                    'placeholder'   =>  'Enter Your Address'

                ],
                [

                    'name'          =>  'map',

                    'type'          =>  'textarea',

                    'label'         =>  'Your Address Map',

                    'placeholder'   =>  'Enter Your Map iframe'

                ],

                [

                    'name'          =>  'phone',

                    'type'          =>  'text',

                    'label'         =>  'Your Phone',

                    'placeholder'   =>  'Enter Phone'

                ],

                [

                    'name'          =>  'email',

                    'type'          =>  'text',

                    'label'         =>  'Your Email',

                    'placeholder'   =>  'Enter Email'

                ],
                [

                    'name'          =>  'business_hours',

                    'type'          =>  'text',

                    'label'         =>  'Business Hours',

                    'placeholder'   =>  'Enter Business Hours'

                ],

            ],

            'App Details' =>

            [

                [

                    'name'          =>  'app_link_android',

                    'type'          =>  'text',

                    'label'         =>  'App Link Android',

                    'placeholder'   =>  'App Link Android'

                ],

                 [

                    'name'          =>  'app_link_ios',

                    'type'          =>  'text',

                    'label'         =>  'App Link Ios',

                    'placeholder'   =>  'App Link Ios'

                ]

            ]

        ];

        return $fields;

    } 



    public static function get_field($key){

        $data = Config::where([ 'meta_key' =>  $key ])->first();

        if(!empty($data)){

            return $data->meta_value;

        }else{

            return '';

        }

    }

    public static function updateAll($key, $value, $type){

        $data = Config::where([ 'meta_key' =>  $key ])->first();

        if($type == 'file'){

            if(!empty($data)){

                if($data->meta_value != ''){

                    if(file_exists(public_path('/images/config/'.$data->meta_value))){

                        unlink(public_path('/images/config/'.$data->meta_value));

                    }

                }

            }

        

            $file = $value;

            $imageName = time().$file->getClientOriginalName();

            $upload = $file->move(public_path('images/config'), $imageName); 

            $value = $imageName;

        }

        if(!empty($data)){

            Config::where('meta_key', $key)->update(['meta_value' => $value]);

        }else{

            Config::where('meta_key', $key)->insert(['meta_key' => $key, 'meta_value' => $value]);

        }

        return '1';

    } 



 

}

