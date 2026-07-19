<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class ResumeController extends Controller
{


    public function create()
    {
        return view('resumes.create');
    }





    public function store(Request $request)
    {


        $data = $request->validate([

            'full_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',

            'email' => 'required|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',

            'photo' => 'nullable|image|max:2048',

            'summary' => 'nullable|string',


            'template' => 'required|in:modern,professional,minimal,creative,dark,ats',

            'accent_color' => 'nullable|string',

            'font' => 'nullable|string',


            'experiences' => 'nullable|array',
            'educations' => 'nullable|array',


            'skills' => 'nullable',
            'projects' => 'nullable',
            'certificates' => 'nullable',
            'languages' => 'nullable',
            'awards' => 'nullable',
            'volunteer' => 'nullable',
            'references' => 'nullable',

        ]);



/*
        |--------------------------------------------------------------------------
        | Generate Public CV Link
        |--------------------------------------------------------------------------
        */


        $data['slug'] = Str::uuid();



        /*
        |--------------------------------------------------------------------------
        | Upload Photo
        |--------------------------------------------------------------------------
        */


        if($request->hasFile('photo')){


            $data['photo'] = $request
                ->file('photo')
                ->store('resumes','public');


        }







        /*
        |--------------------------------------------------------------------------
        | Convert JSON Fields
        |--------------------------------------------------------------------------
        */


        $jsonFields = [

            'experiences',
            'educations',
            'skills',
            'projects',
            'certificates',
            'languages',
            'awards',
            'volunteer',
            'references'

        ];





        foreach($jsonFields as $field){


            if($request->filled($field)){


                if(is_array($request->$field)){


                    $data[$field] = $request->$field;


                }else{


                    $data[$field] = json_decode(
                        $request->$field,
                        true
                    );


                }


            }else{


                $data[$field] = [];


            }


        }








        $resume = auth()->user()
            ->resumes()
            ->create($data);






        return redirect()
            ->route('resumes.pdf',$resume->id);


    }









    public function pdf($id)
    {


        $resume = auth()->user()
            ->resumes()
            ->findOrFail($id);




        $template = match($resume->template){


            'professional' => 'professional',

            'minimal' => 'minimal',

            'creative' => 'creative',

            'dark' => 'dark',

            'ats' => 'ats',

            default => 'modern',

        };





        $pdf = Pdf::loadView(

            'resumes.pdf.'.$template,

            compact('resume')

        )

        ->setPaper('a4');





        return $pdf->download(

            str_replace(
                ' ',
                '-',
                $resume->full_name
            )
            .'-resume.pdf'

        );


    }








    public function edit($id)
    {


        $resume = auth()->user()
            ->resumes()
            ->findOrFail($id);


        return view(
            'resumes.edit',
            compact('resume')
        );


    }









    public function update(Request $request,$id)
    {


        $resume = auth()->user()
            ->resumes()
            ->findOrFail($id);




        $data = $request->all();




        if($request->hasFile('photo')){


            if($resume->photo){

                Storage::disk('public')
                    ->delete($resume->photo);

            }



            $data['photo'] = $request
                ->file('photo')
                ->store('resumes','public');


        }






        $jsonFields = [

            'experiences',
            'educations',
            'skills',
            'projects',
            'certificates',
            'languages',
            'awards',
            'volunteer',
            'references'

        ];





        foreach($jsonFields as $field){


            if(isset($data[$field])){


                if(!is_array($data[$field])){


                    $data[$field] = json_decode(
                        $data[$field],
                        true
                    );


                }


            }


        }





        $resume->update($data);




        return redirect()
            ->route('resumes.pdf',$resume->id);


    }




/*
    |--------------------------------------------------------------------------
    | Public Resume Link
    |--------------------------------------------------------------------------
    */


    public function public($slug)
    {


        $resume = Resume::where('slug', $slug)->firstOrFail();

    
        $writer = new PngWriter();

    
        $qr = new QrCode(
        data: route('resume.public', $resume->slug),
        size: 200,
        margin: 10
        );

    
        $result = $writer->write($qr);

    
        $qrCode = base64_encode($result->getString());

    
        return view('resumes.public', compact('resume', 'qrCode'));

    }




    public function destroy($id)
    {


        $resume = auth()->user()
            ->resumes()
            ->findOrFail($id);



        if($resume->photo){


            Storage::disk('public')
                ->delete($resume->photo);


        }



        $resume->delete();



        return redirect()
            ->route('resumes.create');


    }


}