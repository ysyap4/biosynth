<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use View;
use Validator;
use Illuminate\Support\Facades\Input;
use Hash;
use Redirect;
use Session;
use App\Thesis;
use \Auth;
use Response;


class ThesisController extends Controller
{
    public function thesis_index()
    {
       $thesis = Thesis::all();

        return View::make('thesis_index',array('thesis' => $thesis));
    }

    public function thesis_create()
    {
        return View::make('thesis_create');
    }

    public function thesis_create_process(Request $request)
    {
         $rules = array(
            't_title' => 'required',
            't_studname' => 'required',
            't_sv' => 'required',
            't_type' => 'required',
            't_thesis' => 'required',
            'abstract' => 'required',
            );

        $validator = Validator::make(Input::all(),$rules);

        if($validator -> fails()){

            $messages = $validator->messages();
            
            return Redirect::to('thesis_create')///nama dlm roteu
            -> withErrors($validator)
            ->withInput (Input::except('t_thesis','confirm'));
        }
        else
        {
            $add = new Thesis;
            $add->t_title = Input::get('t_title');
            $add->t_studname = Input::get('t_studname');
            $add->t_sv = Input::get('t_sv');
            $add->t_type = Input::get('t_type');
            $add->abstract = Input::get('abstract');
            
          if(!Auth::guest())
            $add->stud_id = Auth::user()->id;


             if($request->hasFile('t_thesis')){
                $file = Input::file('t_thesis');

                if($file->getClientMimeType() != 'application/pdf')
                    return "<script>
                                localStorage.setItem('hasFileTypeError', true);
                                window.history.go(-1);
                            </script>";
      
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                // Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
                // Storage::put($file->getFilename().'.'.$extension, $file);
                $destinationPath = public_path(). '/uploads/files/';
                $file->move($destinationPath, $filename);

                $add->t_thesis = $filename;

            }

            $add->save();

            Session::flash('message','Successfully added thesis!');
            return Redirect::to('thesis_index');


        }
    }

    public function thesis_show()
    {
        $thesis = Thesis::all();

        $selected_thesis = Input::get('selected_thesis');

        $show_selected_thesis = array();

        for ($i=0; $i < sizeof($selected_thesis); $i++)
        {
            $show_selected_thesis[$i] = '';
            $show_selected_thesis[$i] = Thesis::find($selected_thesis[$i]);
        }

        return View::make('thesis_show',array('show_selected_thesis'=>$show_selected_thesis));
    }

    public function thesis_edit()
    {
        $thesis = Thesis::all();

        $selected_thesis = Input::get('selected_thesis');

        $edit_selected_thesis = array();

        for ($i=0; $i < sizeof($selected_thesis); $i++)
        {
            $edit_selected_thesis[$i] = '';
            $edit_selected_thesis[$i] = Thesis::find($selected_thesis[$i]);
        }
  
        return View::make('thesis_edit')->with(array('edit_selected_thesis'=>$edit_selected_thesis));
    }

    public function thesis_edit_process(Request $request)
    {
            $rules_edit = array(
            't_title' => 'required',
            't_studname' => 'required',
            't_sv' => 'required',
            't_type' => 'required',
            //'t_thesis' => 'required',
            'abstract' => 'required',
            );

         $validator = Validator::make(Input::all(),$rules_edit);

        if($validator -> fails())
        {
            $messages = $validator->messages();
            
           // return Redirect::to('thesis_index')
           // -> withErrors($validator);
            return redirect()->back()
            -> withErrors($validator)
            ->withInput (Input::except('t_thesis','confirm'));
        }
        else
        {
            $thesis = Thesis::all();
            $edit_selected_thesis = Input::get('edit_selected_thesis');
            $t_title = Input::get('t_title');
            $t_studname = Input::get('t_studname');
            $t_sv = Input::get('t_sv');
            $t_type = Input::get('t_type');
            $t_oldname = Input::get('t_oldname');
            $abstract = Input::get('abstract');
            $edit = array();

            for ($i=0; $i < sizeof($edit_selected_thesis); $i++)
            {
                $edit[$i] = '';
                $edit[$i] = Thesis::find($edit_selected_thesis[$i]);
                $edit[$i]->t_title = $t_title[$i];
                $edit[$i]->t_studname = $t_studname[$i];
                $edit[$i]->t_sv = $t_sv[$i];
                $edit[$i]->t_type = $t_type[$i];
                $edit[$i]->abstract = $abstract[$i];

                
                
                if($request->hasFile('t_thesis'.$i)){
                    $file = Input::file('t_thesis'.$i);
                    //Session::flash('message','testing1'.$file.'abc');
                    //return redirect()->back();
                        

                        if($file->getClientMimeType() != 'application/pdf')
                           { return "<script>
                                        localStorage.setItem('hasFileTypeError', true);
                                        window.history.go(-1);
                                    </script>";}
              
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        // Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
                        // Storage::put($file->getFilename().'.'.$extension, $file);
                        $destinationPath = public_path(). '/uploads/files/';
                        $file->move($destinationPath, $filename);

                        $edit[$i]->t_thesis = $filename;
                        //$edit[$i]->t_thesis = $t_thesis[$i];
                        //$add->t_thesis = $filename;
                        
                }
                else
                {
                    $edit[$i]->t_thesis = $t_oldname[$i];
                     //Session::flash('message', $edit[$i]->t_thesis.'testing2');
                    //$edit[$i]->t_thesis = $edit_selected_thesis[$i]->t_thesis;

                }

                $edit[$i]->save();
            }

            Session::flash('message','Successfully Update Thesis!');
            return Redirect::to('thesis_index');
            //return redirect()->back();
        }
    }

    public function thesis_delete()
    {
        $selected_thesis = Input::get('selected_thesis');

        for ($i=0; $i < sizeof($selected_thesis); $i++)
        {
            $delete_selected_thesis[$i] = Thesis::where('id',$selected_thesis[$i])->delete();
        }

        Session::flash('message','Successfully deleted thesis!');
        return Redirect::to('thesis_index');
    }

}
