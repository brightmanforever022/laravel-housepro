<?php
namespace App\Http\Controllers;
use App\DynamicText;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class FooterDynamicController extends AdminController
{   
   public function __construct(DynamicText $dynamic)
   {
        $this->dynamic = $dynamic;
   }
   public function how_to_book()
   {
    $rows = $this->dynamic->where('type','book')->get()->toArray();
    return view('backend.dynamicsfooter.book.edit')->with('rows', $rows);
   }

   public function need_our_help()
   {
    $rows = $this->dynamic->where('type','help')->get()->toArray();
    return view('backend.dynamicsfooter.help.edit')->with('rows', $rows);
   }

   public function add_more_help()
   {
     return view('backend.dynamicsfooter.help.add_more_help'); 
   }

   public function saveHelpNewMenu()
   {
      
      $type_edit_data['title'] = Input::get('title');
      $type_edit_data['description'] = Input::get('description');
      $type_edit_data['rows'] = 2;
      $type_edit_data['type'] = 'help';
      $this->dynamic->create($type_edit_data);
      return redirect('/need_our_help');
   } 

   public function edit_press()
   {
    $rows = $this->dynamic->where('type','press')->get()->toArray();
    return view('backend.dynamicsfooter.press.edit')->with('rows', $rows);
   }

   public function edit_city()
   {
    $rows = $this->dynamic->where('type','city')->get()->toArray();
    return view('backend.dynamicsfooter.city.edit')->with('rows', $rows);
   }

   //Book Functionality
   public function row1Update()
   {
      $id = Input::get('id');
      $type_edit_data['title'] = Input::get('title');
      $type_edit_data['description'] = Input::get('description');
      $this->dynamic->where('id', $id)->update($type_edit_data);
      return back();
   }

   public function row2Update()
   {
      $i = 1;
      foreach(Input::all() as $key=>$val)
      {
        if($key != '_token')
        {
          if(Input::get('title'.$i) != "")
          {
            $id = Input::get('id'.$i);
            $type_edit_data['title'] = Input::get('title'.$i);
            $type_edit_data['description'] = Input::get('description'.$i);
            $this->dynamic->where('id', $id)->update($type_edit_data);
            $i++;
          }
        }
      }
      return back();
   }

   public function row3Update()
   {
      $i = 4;
      foreach(Input::all() as $key=>$val)
      {
        if($key != '_token')
        {
          if(Input::get('title'.$i) != "")
          {
            $id = Input::get('id'.$i);
            $type_edit_data['title'] = Input::get('title'.$i);
            $type_edit_data['description'] = Input::get('description'.$i);
            $this->dynamic->where('id', $id)->update($type_edit_data);
            $i++;
          }
        }
      }
      return back();
   }

   public function row4Update(Request $request)
   {
    $id = Input::get('id_image');
         
    if($request->file('file_logo'))
    {
      $ext = $request->file('file_logo')->getClientOriginalExtension();
      $type_edit_data['title'] = 'logo.'.$ext;
      $request->file('file_logo')->move(base_path() . '/public/images/', 'logo.'.$ext);
      $this->dynamic->where('id', $id)->update($type_edit_data);
    }
    if($request->file('file_management'))
    {
      $ext = $request->file('file_management')->getClientOriginalExtension();
      $type_edit_data1['description'] = 'management.'.$ext;
      $request->file('file_management')->move(base_path() . '/public/images/', 'management.'.$ext);
      $this->dynamic->where('id', $id)->update($type_edit_data1);
    }
    if($request->file('file_press'))
    {
      $ext = $request->file('file_press')->getClientOriginalExtension();
      $type_edit_data2['logo'] = 'press.'.$ext;
      $request->file('file_press')->move(base_path() . '/public/images/', 'press.'.$ext);
      $this->dynamic->where('id', $id)->update($type_edit_data2);
    }
     
    return back();
   }

   public function cityUpdate(Request $request)
   {
      foreach(Input::all() as $key=>$val)
      {
        if($key != '_token' && !Input::hasFile('file_logo'.Input::get($key)))
        {
          $type_edit_data4['title'] = Input::get('title'.Input::get($key));
          $this->dynamic->where('id', Input::get($key))->update($type_edit_data4); 
        }
      }
      
      foreach(Input::all() as $key=>$val)
      {
        if($key != '_token' && substr($key,0,9) != "file_logo" && Input::hasFile('file_logo'.Input::get($key)))
        {
          
            
            $ext = $request->file('file_logo'.Input::get($key))->getClientOriginalExtension();
            $type_edit_data2['title'] = Input::get('title'.Input::get($key));
            $type_edit_data2['logo'] = date('dmYhis').Input::get($key).'.'.$ext;
            //echo $type_edit_data2['logo']; die;
            $request->file('file_logo'.Input::get($key))->move(base_path() . '/public/cities/', $type_edit_data2['logo']);
            $this->dynamic->where('id', Input::get($key))->update($type_edit_data2); 
            
          
        }
      }
      //die;
      return back();
   }
  
  //Help Functionality
   public function rowh1Update()
   {
      $id = Input::get('id');
      $type_edit_data['title'] = Input::get('title');
      $type_edit_data['description'] = Input::get('description');
      $this->dynamic->where('id', $id)->update($type_edit_data);
      return back();
   }

   public function rowh2Update()
   {
      $i = 1;
      foreach(Input::all() as $key=>$val)
      {
        if($key != '_token')
        {
          if(Input::get('title'.$i) != "")
          {
            $id = Input::get('id'.$i);
            $type_edit_data['title'] = Input::get('title'.$i);
            $type_edit_data['description'] = Input::get('description'.$i);
            $this->dynamic->where('id', $id)->update($type_edit_data);
            $i++;
          }
        }
      }
      return back();
   }

   //Press Functionality
   public function rowp1Update()
   {
      $id = Input::get('id');
      $type_edit_data['title'] = Input::get('title');
      $type_edit_data['description'] = Input::get('description');
      $this->dynamic->where('id', $id)->update($type_edit_data);
      return back();
   }

   public function rowp2Update()
   {
      $i = 1;
      foreach(Input::all() as $key=>$val)
      {
        if($key != '_token')
        {
          
            $id = Input::get('id'.$i);
            $type_edit_data['title'] = Input::get('title'.$i);
            $type_edit_data['description'] = Input::get('description'.$i);
            $this->dynamic->where('id', $id)->update($type_edit_data);
            $i++;
         
        }
      }
      return back();
   }

   public function rowp3Update()
   {
      $i = 2;
      foreach(Input::all() as $key=>$val)
      {
        if($key != '_token')
        {
          if(Input::get('title'.$i) != "")
          {
            $id = Input::get('id'.$i);
            $type_edit_data['title'] = Input::get('title'.$i);
            $type_edit_data['description'] = Input::get('description'.$i);
            $this->dynamic->where('id', $id)->update($type_edit_data);
            $i++;
          }
        }
      }
      return back();
   }
   public function add_blog()
   {
      return view('backend.dynamicsfooter.press.add_blog');
   }

   public function add_city()
   {
      return view('backend.dynamicsfooter.city.add_city');
   }

   public function savePresBlog()
   {
      
      $type_edit_data['title'] = Input::get('title');
      $type_edit_data['description'] = Input::get('description');
      $type_edit_data['rows'] = 3;
      $type_edit_data['type'] = 'press';
      //echo "<pre>"; print_r($type_edit_data); die;
      $this->dynamic->create($type_edit_data);
      return redirect('/edit_press');
   }

   public function downLoadLogo($path)
   {
      //PDF file is stored under project/public/download/info.pdf
      $file= public_path(). "/images/".$path;
      // echo $file; die;
      $headers = array(
                //'Content-Type: application/pdf',
              );
      return \Response::download($file, $path, $headers);
   }


   public function saveCitySingle(Request $request)
   {
      
              
      if($request->file('file_press'))
      {
        $ext = $request->file('file_press')->getClientOriginalExtension();
        $type_edit_data['title'] = Input::get('title');
        $type_edit_data['description'] = "";
        $type_edit_data['logo'] = date('mdYhis').'.'.$ext;
        $type_edit_data['rows'] = $this->dynamic->where('type', 'city')->get()->count() + 1;
        $type_edit_data['type'] = 'city';
        $request->file('file_press')->move(base_path() . '/public/cities/', $type_edit_data['logo']);
        $this->dynamic->create($type_edit_data);
        return redirect('/edit_city');
      }
   }

   public function deleteCityOne($id)
   {
       $this->dynamic->where('id', $id)->delete();
       return back();
   }



}