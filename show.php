<?php
require('config/config.php');
require('config/db.php');

// Get Id

$id = mysqli_real_escape_string($connection, $_GET['id']);

$AllPostsQuery = 'SELECT * FROM posts WHERE id ='.$id;

// Get Result
$result = mysqli_query($connection, $AllPostsQuery);

// fetch Data
$post = mysqli_fetch_assoc($result);
// var_dump($posts);

// Free Results
mysqli_free_result($result);

// close connection
mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="./public/css/bootstrap.min.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include('include/header.php') ?>
    <div class="lg:px-8 pt-6">
        <a class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" 
            href="<?php echo ROOT_URL; ?>">
            Back
        </a>
    </div>
    <div class="">
    <div class="text-center">
    <div class="pb-6">
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl"><?php echo $post['title'] ?></h1>
        </div>
        <hr>
        <div class="p-8">
            <p class="mt-6 text-base leading-7 text-gray-600"><?php echo $post['body'] ?></p>
        </div>
        <hr>
        <div class="grid mt-8 place-items-center bg-white">
            <img src="./public/img/system_defaults/default-profile.png" alt="" class="h-10 w-10 rounded-full bg-gray-50">
            <div class="text-sm leading-6">
                <p class="font-semibold text-gray-900">
                    <?php echo $post['author'] ?>
                </p>
                <p class="text-gray-600">Author</p>
            </div>
        </div>      
    </div>
        <!-- <main class="grid min-h-full place-items-center bg-white px-6 sm:py-12 lg:px-8">
            
        </main> -->
    </div>
    <!-- <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"><?php echo $post['title'] ?></h2>
                <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-y-16 gap-x-8 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    <article class="border-solid border-2 border-slate-400 p-3 rounded-lg flex max-w-xl flex-col items-start justify-between">
                        <div class="flex items-center gap-x-4 text-xs">
                        <time datetime="2020-03-16" class="text-gray-500">
                            <?php 
                            
                            $credatedDate = new DateTime($post['created_at']);
                            echo 'Created On : '.$credatedDate->format('Y-m-d');
                            ?>
                        </time>
                        <a href="#" class="relative z-10 rounded-full bg-gray-50 py-1.5 px-3 font-medium text-gray-600 hover:bg-gray-100">Marketing</a>
                        </div>
                        <div class="group relative">
                        <p class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3">
                            <?php echo $post['body'] ?>
                        </p>
                        </div>
                        <div class="relative mt-8 flex items-center gap-x-4">
                            <img src="./public/img/system_defaults/default-profile.png" alt="" class="h-10 w-10 rounded-full bg-gray-50">
                            <div class="text-sm leading-6">
                                <p class="font-semibold text-gray-900">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    <?php echo $post['author'] ?>
                                </a>
                                </p>
                                <p class="text-gray-600">Author</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div> -->
    <?php include('include/footer.php') ?>
</body>
</html>