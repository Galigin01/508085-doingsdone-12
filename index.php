<?php
require_once 'my_functions.php';
require_once 'helpers.php';
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

# В сценарии главной страницы выполните подключение к MySQL.
# Отправьте SQL-запрос для получения списка проектов у текущего пользователя.
# Используйте эти данные для показа списка проектов и списка задач на главной странице.



# Отправьте SQL-запрос для получения списка из всех задач у текущего пользователя.


$con = mysqli_connect("localhost", "root", "mysql","doinngsdone"); 

if ($con == false) {
   print("Ошибка подключения: " . mysqli_connect_error());
}
else {
   #print("Соединение установлено");
   $sql_projects = "SELECT project_name FROM project";
   $sql_tasks = "SELECT task_name, status_ready, dt_deadline FROM task";

   $sql_projects_result = mysqli_query($con, $sql_projects);
   $sql_tasks_result = mysqli_query($con, $sql_tasks);

   if ($sql_projects_result){
        $sql_projects_arr = mysqli_fetch_all($sql_projects_result, MYSQLI_ASSOC);
   };

   if ($sql_tasks_result){
        $sql_tasks_arr = mysqli_fetch_all($sql_tasks_result, MYSQLI_ASSOC);
        print($sql_tasks_arr[0]['task_name']);
        // foreach ($sql_tasks_arr as $arr){
        //     $foo = date_create($arr['dt_deadline']);
        //     $foo = date_format($arr['dt_deadline'],"Y-m-d");
            
        // }
//         print($foo);
        #print($sql_tasks_arr[0]['dt_deadline']);#'2001-12-20'  2001-12-20 19:00:00 
   }
}



$user = [
    'id' => 1,
    'user_name' => 'Вася',
    ];

    

// $projects = [
//     'Входящие',
//     'Учеба',
//     'Работа',
//     'Домашние дела',
//     'Авто',
// ];

//  $tasks = [
//     [
//         'task_name' => 'Собеседование в IT компании',
//         'deadline' => '01.12.2019', 
//         'project' => 'Работа',
//         'ready' => false
//     ],
//     [
//         'task_name' => 'Выполнить тестовое задание',
//         'deadline' => '25.12.2019', 
//         'project' => 'Работа',
//         'ready' => false
//     ],
//     [
//         'task_name' => 'Сделать задание первого раздела',
//         'deadline' => '21.12.2019', 
//         'project' => 'Учеба',
//         'ready' => true
//     ],
//     [
//         'task_name' => 'Встреча с другом',
//         'deadline' => '22.12.2019',
//         'project' => 'Входящие',
//         'ready' => false
//     ],
//     [
//         'task_name' => 'Купить корм для кота',
//         'deadline' => null,
//         'project' => 'Домашние дела',
//         'ready' => false
//     ],
//     [
//         'task_name' => 'Заказать пиццу',
//         'deadline' => null,
//         'project' => 'Домашние дела',
//         'ready' => false
//     ],

// ];


$main = include_template(
    'main.php',
    [
        'tasks' => $sql_tasks_arr, #tasks,
        'show_complete_tasks' => $show_complete_tasks,

    ]
);

$layout = include_template(
    'layout.php',
    [
        'title' => 'Дела в порядке',
        'user_name' => 'Дмитрий',
        'main' => $main,
        'projects' => $sql_projects_arr, #$projects,
        'tasks' => $sql_tasks_arr, #tasks

    ]
);

print($layout);


