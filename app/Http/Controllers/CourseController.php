<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course as Course;
use App\Lesson as Lesson;
use App\Registration as Registration;
use App\Tenant as Tenant;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	
	/**
     * List courses
     *
     * @return void
     */
    public function courses($tenant_id,Request $request)
    {
        $query = [
					['tenant_id', '=', $tenant_id]
				];
		
		if($request->has('course_id')){
			array_push($query,['course_id', '=', $request->course_id]);
		}	
				
		$courses = $request->has('paginate') ? 
						Course::with('registrations')
								->where($query)
								->paginate($request->paginate) 
								
					: Course::with('registrations')
							->where($query)
							->get();
						
		if(sizeof($courses)){
			return response()->json($courses,200);
		}else{
			
			$message = 'no courses found for tenant id : '.$tenant_id;
			
			return response()->json(['message' => $message],404);
		}
		
    }
	
	/**
     * List registrations
     *
     * @return void
     */
    public function registrations($tenant_id,Request $request)
    {
        $query = [
					['tenant_id', '=', $tenant_id]
				];
		
		if($request->has('user_id')){
			array_push($query,['user_id', '=', $request->user_id]);
		}

		if($request->has('course_id')){
			array_push($query,['course_id', '=', $request->course_id]);
		}			
				
		$registrations = $request->has('paginate') ? Registration::with('course','user')->where($query)->paginate($request->paginate) : Registration::with('course','user')->where($query)->get();
						
		if(sizeof($registrations)){
			return response()->json($registrations,200);
		}else{
			
			$message = 'no registrations found for tenant id : '.$tenant_id;
			
			return response()->json(['message' => $message],404);
		}
    }
	
	/**
     * List lessons
     *
     * @return void
     */
    public function lessons($tenant_id,Request $request)
    {
        $query = [];
				
		if(!$tenant_id){
			$message = 'tenant id required';
			
			return response()->json($message,500);
		}else{
			array_push($query,['tenant_id', '=', $tenant_id]);
		}
		
		if(!$request->has('course_id')){
			$message = 'course id required';
			
			return response()->json($message,500);
		}else{
			array_push($query,['course_id', '=', $request->course_id]);
			array_push($query,['parent_id', '=', null]);
		}	

		if($request->has('instructor_id')){
			array_push($query,['meta->instructor_id', '=', $request->instructor_id]);
		}
				
		$lessons = $request->has('paginate') ? Lesson::with('sub_lessons','course')->where($query)->paginate($request->paginate) : Lesson::with('sub_lessons','course')->where($query)->get();
						
		if(sizeof($lessons)){
			return response()->json($lessons,200);
		}else{
			
			$message = 'no lessons found for course id : '.$request->course_id;
			
			return response()->json(['message' => $message],404);
		}
    }
	
	public function getTenant($tenant){
		try{
			$tenant = Tenant::where('username', $tenant)->first();
			
			return $tenant;
			
		}catch(Exception $e){
			return false;
		}
	}
}
