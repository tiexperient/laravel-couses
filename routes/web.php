<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusCourseController;
use App\Http\Controllers\StatusUserController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/
// Página Inicial do site
Route::get('/', [HomeController::class, 'index'])->name('home');

// **********************************************************************************
// ****************************** Refatoração de Rotas ******************************
// **********************************************************************************

    // Tela de login
    Route:: get('/login', [AuthController:: class, 'index'])->name('login');

    // Processar os dados do login
    Route:: post('/login', [AuthController:: class, 'loginProcess'])->name('login.process');

    // Logout
    Route:: get('/logout', [AuthController:: class, 'logout'])->name('logout');

    // Formulário cadastrar novo usuário
    Route::get('/register', [AuthController::class, 'create'])->name('register');

    // Receber os dados do formulário e cadastrar novo usuário
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    // Solicitar link para resetar senha
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

    // Formulário para redefinir a senha com o token
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showRequestForm'])->name('password.reset');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Grupo de rotas restritas
    Route::group(['middleware' => 'auth'], function (){

    // Página inicial do administrativo
    Route:: get('/dashboard', [DashboardController:: class, 'index'])->name('dashboard.index');

    Route::prefix('profile')->group(function(){
        // Exibir o Perfil
        Route:: get('/', [ProfileController:: class, 'show'])->name('profile.show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/edit-password', [ProfileController::class, 'editPassword'])->name('profile.edit_password');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update_password');

    });


    Route::prefix('courses')->group(function(){
        Route::get('/', [CourseController::class, 'index'])->name('courses.index')->middleware('permission:index-course');

        // Criar precisa estar antes do show
        Route::get('/create', [CourseController::class, 'create'])->name('courses.create')->middleware('permission:create-course');

        Route::get('/{course}', [CourseController::class, 'show'])->name('courses.show')->middleware('permission:show-course');
        Route::post('/', [CourseController::class, 'store'])->name('courses.store')->middleware('permission:create-course');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit')->middleware('permission:edit-course');
        Route::put('/{course}', [CourseController::class, 'update'])->name('courses.update')->middleware('permission:edit-course');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('courses.destroy')->middleware('permission:destroy-course');
    });


    Route::prefix('status')->group(function(){
        // Exibir Status do Curso
        Route:: get('/', [StatusCourseController:: class, 'index'])->name('status-course.index');
        // Criar Status do Curso
        Route:: get('/create', [StatusCourseController:: class, 'create'])->name('status-course.create');
        // Exibir Status do Curso
        Route:: get('/{status}', [StatusCourseController:: class, 'show'])->name('status-course.show');
        // Criar rota para o método POST
        Route:: post('/', [StatusCourseController:: class, 'store'])->name('status-course.store');
        // Editar Status do Curso
        Route:: get('/{status}/edit', [StatusCourseController:: class, 'edit'])->name('status-course.edit');
        // Atualizar Status do Curso
        Route:: put('/{status}', [StatusCourseController:: class, 'update'])->name('status-course.update');
        // Apagar Status do Curso
        Route:: delete('/{status}', [StatusCourseController:: class, 'destroy'])->name('status-course.destroy');
    });

    Route::prefix('batches')->group(function () {

        // 1) Exibir turma
        Route::get('/show/{batches}', [BatchesController::class, 'show'])
            ->name('batches.show');

        // 2) Criar turma → /batches/create/ID
        Route::get('/create/{course}', [BatchesController::class, 'create'])
            ->name('batches.create');

        // 3) Salvar turma
        Route::post('/', [BatchesController::class, 'store'])
            ->name('batches.store');

        // 4) Editar turma
        Route::get('/edit/{batches}', [BatchesController::class, 'edit'])
            ->name('batches.edit');

        // 5) Atualizar turma
        Route::put('/{batches}', [BatchesController::class, 'update'])
            ->name('batches.update');

        // 6) Deletar turma
        Route::delete('/{batches}', [BatchesController::class, 'destroy'])
            ->name('batches.destroy');

        // 7) Listar turmas do curso → deixar por último
        Route::get('/{course}', [BatchesController::class, 'index'])
            ->name('batches.index');
    });


    Route::prefix('modules')->group(function(){

        // Exibir o Módulo 
        Route:: get('/show/{module}', [ModulesController:: class, 'show'])->name('modules.show');

        // Exibir Módulos dos Cursos
        Route:: get('/{batches}', [ModulesController:: class, 'index'])->name('modules.index');

        // Criar Módulos de Turmas
        Route:: get('/create/{batches}', [ModulesController:: class, 'create'])->name('modules.create');

        // Criar rota para o método POST
        Route:: post('/', [ModulesController:: class, 'store'])->name('modules.store');
        // Editar o Módulo 
        Route:: get('/{module}/edit', [ModulesController:: class, 'edit'])->name('modules.edit');
        // Atualizar o Módulo 
        Route:: put('/{module}', [ModulesController:: class, 'update'])->name('modules.update');
        // Apagar Módulo 
        Route:: delete('/{module}', [ModulesController:: class, 'destroy'])->name('modules.destroy');
    });

    Route::prefix('lessons')->group(function(){
        // Exibir Aulas do Curso
        Route:: get('/{modules}', [LessonsController:: class, 'index'])->name('lessons.index');
        // Criar Aulas do Curso
        Route:: get('/create', [LessonsController:: class, 'create'])->name('lessons.create');
        // Exibir as Aulas do Curso
        Route:: get('/{lesson}', [LessonsController:: class, 'show'])->name('lessons.show');
        // Criar rota para o método POST
        Route:: post('/', [LessonsController:: class, 'store'])->name('lessons.store');
        // Editar a Aula do Curso
        Route:: get('/{lesson}/edit', [LessonsController:: class, 'edit'])->name('lessons.edit');
        // Atualizar a Aula do Curso
        Route:: put('/{lesson}', [LessonsController:: class, 'update'])->name('lessons.update');
        // Apagar Aula do Curso
        Route:: delete('/{lesson}', [LessonsController:: class, 'destroy'])->name('lessons.destroy');
    });

    Route::prefix('users')->group(function(){
        // Exibir Usuários
        Route:: get('/', [UsersController:: class, 'index'])->name('users.index');
        // Criar Usuarios
        Route:: get('/create', [UsersController:: class, 'create'])->name('users.create');
        // Exibir o Usuário
        Route:: get('/{user}', [UsersController:: class, 'show'])->name('users.show');
        // Criar rota para o método POST
        Route:: post('/', [UsersController:: class, 'store'])->name('users.store');
        // Editar o Usuário
        Route:: get('/{user}/edit', [UsersController:: class, 'edit'])->name('users.edit');
        // Atualizar Usuário
        Route:: put('/{user}', [UsersController:: class, 'update'])->name('users.update');
        // Apagar Usuário
        Route:: delete('/{user}', [UsersController:: class, 'destroy'])->name('users.destroy');

        // Editar o Senha
        Route:: get('/{user}/edit-password', [UsersController:: class, 'editPassword'])->name('users.edit_password');
        // Atualizar Senha
        Route:: put('/{user}/update-password', [UsersController:: class, 'updatePassword'])->name('users.update_password');
    });

    Route::prefix('status-user')->group(function(){
        // Exibir Status dos Usuários
        Route:: get('/', [StatusUserController:: class, 'index'])->name('status-user.index');
        // Criar Status de Usuário
        Route:: get('/create', [StatusUserController:: class, 'create'])->name('status-user.create');
        // Exibir Status do Usuário
        Route:: get('/{status_user}', [StatusUserController:: class, 'show'])->name('status-user.show');
        // Criar rota para o método POST
        Route:: post('/', [StatusUserController:: class, 'store'])->name('status-user.store');
        // Editar o Status do Usuário
        Route:: get('/{status_user}/edit', [StatusUserController:: class, 'edit'])->name('status-user.edit');
        // Atualizar Status do Usuário
        Route:: put('/{status_user}', [StatusUserController:: class, 'update'])->name('status-user.update');
        // Apagar Status do Usuário
        Route:: delete('/{status_user}', [StatusUserController:: class, 'destroy'])->name('status-user.destroy');
    });
    
    });

   