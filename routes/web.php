<?php


	Auth::routes();

	Route::group(['middleware'=>['check.admin.role','prevent-back-history']], function(){
		//rutas del admin
		Route::resource('usuarios','UserController');
		Route::resource('departamentos','DepartmentController');
		Route::resource('actividades','TaskTypeController');
		Route::resource('lugares','PlaceController');
	});

	Route::group(['middleware'=>['check.technician.role','prevent-back-history']], function(){
		//rutas del tecnico
		Route::get('/tareas-pendientes','TechnicianController@pending')->name('pending');
		Route::get('/tareas-iniciadas','TechnicianController@initiated')->name('initiated');
		Route::get('/tareas-finalizadas','TechnicianController@finished')->name('finished');
		Route::patch('/actualizar-anotacion/{task}','TechnicianController@updateAnnotation')->where('task', '\d+')->name('update task annotation');
		Route::get('/editar-anotacion/{task}','TechnicianController@editAnnotation')->name('edit task annotation');
		Route::get('/mostrar-anotacion/{task}','TechnicianController@showAnnotation')->name('show task annotation');
		Route::patch('/actualizar-estado/{task}','TechnicianController@updateState')->where('task', '\d+')->name('update task state');
	});

	Route::group(['middleware'=>['check.client.role','prevent-back-history']], function(){
		//rutas del cliente
		Route::get('/tareas','TaskController@index')->name('tasks.index');
		Route::get('/tareas/edit/{task}','TaskController@edit')->name('tasks.edit');
		Route::put('/tareas/update/{task}','TaskController@update')->name('tasks.update');
		Route::post('/tareas/store','TaskController@store')->name('tasks.store');
		Route::delete('/tareas/destroy/{task}','TaskController@destroy')->name('tasks.destroy');
		Route::get('/tareas/create','TaskController@create')->name('tasks.create');
		Route::get('/tareas/historial','TaskLogController@index')->name('task_logs.index');
		Route::delete('/tareas/historial/destroy/{task_log}','TaskLogController@destroy')->name('task_logs.destroy');
		Route::get('/chat/{task}','TaskMessageController@index')->name('chat.index');
		Route::get('/editar-descripcion/{task}','TaskController@editDescription')->name('edit.description');
		Route::patch('/actualizar-descripcion/{task}','TaskController@updateDescription')->name('update.description');
		Route::patch('/verificar-tarea/{task}','TechnicianController@updateState')->where('task', '\d+')->name('verify.task');
	});

	Route::group(['middleware'=>['check.boss.role','prevent-back-history']], function(){
		//rutas del jefe
		Route::get('/inicio-jefe/','BossController@index')->name('boss index');
		Route::get('/inicio-jefe/tareas_x_dpto/pdf','BossController@showPDF')->name('boss.pdf');
	});

	Route::group(['middleware'=>['check.client_or_technician.role','prevent-back-history']], function(){
		//rutas para el tecnico y el cliente
		Route::get('/chat/{task}','TaskMessageController@index')->name('chat.index');
		Route::post('/chat/store','TaskMessageController@store')->name('chat.store');
		Route::get('/mostrar-descripcion/{task}','TaskController@showDescription')->name('show.description');
	});

	Route::group(['middleware'=>['auth','prevent-back-history']], function(){
		//rutas para todos los roles
		Route::get('/editar-perfil/{id}','UserController@editProfile')->name('edit.profile');
		Route::get('/mostrar-perfil/{id}','UserController@showProfile')->name('show.profile');
		Route::put('/actualizar-perfil/{id}','UserController@updateProfile')->name('update.profile');
		Route::get('/home','HomeController@index')->name('home');

	});
		Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
		Route::get('/','HomeController@index')->name('root');

?>