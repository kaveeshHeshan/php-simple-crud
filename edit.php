<?php
require('config/config.php');
require('config/db.php');

    if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == 'POST') {
        $postId = mysqli_real_escape_string($connection, $_POST['post_id']);
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $body = mysqli_real_escape_string($connection, $_POST['body']);
        $author = mysqli_real_escape_string($connection, $_POST['author']);

        $update_post_query = "UPDATE posts SET
                            title='$title',
                            body='$body',
                            author='$author'
                                WHERE id = {$postId}";

        if(mysqli_query($connection, $update_post_query)) {
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
    <link rel="stylesheet" href="./public/css/custom_styles.css">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <styles>

    </styles>
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
        <div class="bg-white py-12 sm:py-14">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Modify <?php echo $post['title'] ?> Details</h2>
                </div>
                <div class="mx-auto gridborder-t border-gray-200 pt-10">
                    <form id="postForm" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="shadow-lg sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="company-website" class="block text-sm font-medium text-gray-700">Title</label>
                                <div class="mt-1">
                                    <input class="text-input" type="text" name="title" id="post-title" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Title" value="<?php echo $post['title'] ?>">
                                </div>
                            </div>

                            <div>
                                <label for="about" class="block text-sm font-medium text-gray-700">Body</label>
                                <div class="mt-1">
                                    <textarea class="text-area-input" id="post-body" name="body" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Body"><?php echo $post['body'] ?></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Brief description for your Post.</p>
                            </div>
                            
                            <div class="col-span-3 sm:col-span-2">
                                <label for="company-website" class="block text-sm font-medium text-gray-700">Author</label>
                                <div class="mt-1">
                                    <input class="text-input" type="text" name="author" id="post-author" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Author" value="<?php echo $post['author'] ?>">
                                </div>
                            </div>
                            <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>

</div>
    <?php include('include/footer.php') ?>
</body>
</html>