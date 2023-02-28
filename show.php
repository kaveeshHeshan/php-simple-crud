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
    
    <!-- Box Icons Styles -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include('include/header.php') ?>
    <div class="lg:px-8 pt-6">
        <a class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" 
            href="<?php echo ROOT_URL; ?>">
            Back
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
        <div class="grid mt-8 mb-8 place-items-center bg-white">
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
    <?php include('include/footer.php') ?>
</body>
</html>