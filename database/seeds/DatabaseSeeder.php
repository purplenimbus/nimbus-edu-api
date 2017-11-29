<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
		$subjects = ['mathematics','english','physics','chemistry','biology'];
		
		foreach($subjects as $course){
			factory(App\Course::class)->create([
						'name' => $course,
						'tenant_id' => 1,
						'meta'	=>	[
							'course_schema' =>	[
								'quiz' =>  15,
								'midterm' => 30,
								'assignment' => 15,
								'lab' => 5,
								'exam' => 35
							]
						]
					])
					->each(function($course){
						factory(App\Lesson::class,5)->create([
							'tenant_id' => 1,
							'course_id' => $course->id
						])->each(function($lesson)use($course){
							factory(App\Lesson::class,2)->create([
								'tenant_id' => 1,
								'parent_id' => $lesson->id,
								'course_id' => $course->id
							]);
							echo "New Lesson , id : ".$lesson->id." , for course id :".$course->id."\r\n";
							
						});
						
					});
		}
		
		factory(App\User::class, 10)
				->create()
				->each(function($user)use($subjects){
					foreach($subjects as $key => $course){
						//$faker = new Faker\Generator();
						//var_dump($faker);
						
						$registration = [
							'user_id' => $user->id,
							'course_id' => $key+1,
							'tenant_id' => 1,
							'meta'      => [
								'grades' => factory(App\Scores::class)->make()
							]
						];
						
						/*foreach($course->meta->course_schema as $key => $schema){
							$regisration['meta']['grades'][$key] = [];
						}*/
						
						factory(App\Registration::class, 1)->create($registration)->each(function($registration)use($user){ 	echo "user :".$user->id." registration id:".$registration->id."\r\n"; });
					}
				});
    }
}
