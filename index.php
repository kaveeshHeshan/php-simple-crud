<?php
require('config/config.php');
require('config/db.php');

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == 'POST') {

    $postId = mysqli_real_escape_string($connection, $_POST['post_id']);

    $delete_post_query = "DELETE FROM posts WHERE id = {$postId}";

    if(mysqli_query($connection, $delete_post_query)) {
        // success redirect
        header('Location: ' .ROOT_URL.'');
    } else {
        echo 'ERROR: '. mysqli_error($connection);
    }
}

$AllPostsQuery = 'SELECT * FROM posts ORDER BY created_at DESC';

// Get Result
$result = mysqli_query($connection, $AllPostsQuery);

// fetch Data
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
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

    <!-- Box Icons Styles -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include('include/header.php') ?>
    <div class="">
        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">Learn how to grow your business with our expert advice.</p>
                </div>
                <div class="mt-8">
                    <a href="addPost.php" class="justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <i class='bx bx-plus'></i> &nbsp; Add Post
                    </a>
                </div>
                <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-y-16 gap-x-8 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                
                <?php foreach ($posts as $post) : ?>
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
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <a href="#">
                            <span class="absolute inset-0"></span>
                            <?php echo $post['title'] ?>
                            </a>
                        </h3>
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
                        <div class="pt-4 pb-4">
                            <a class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" 
                                href="<?php echo ROOT_URL; ?>show.php?id=<?php echo $post['id']; ?>">
                                Read More
                            </a>

                            <a class="inline-flex w-full justify-center rounded-md border border-transparent bg-yellow-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" 
                                href="<?php echo ROOT_URL; ?>edit.php?id=<?php echo $post['id']; ?>">
                                <i class='bx bx-edit'></i>
                            </a>

                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                                <button class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" type="submit"><i class='bx bx-trash'></i></button>
                            </form>
                            
                        </div>
                    </article>
                <?php endforeach; ?>
                <!-- More posts... -->
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php') ?>
</body>
</html>