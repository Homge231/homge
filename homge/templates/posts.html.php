<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/post_styles.css">
    <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>
    <main>
        <div class="container">
            <?php foreach ($posts as $post): ?>
                <div class="post" data-post-id="<?php echo htmlspecialchars($post['post_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <!-- User Info -->
                    <div class="post-header">
                        <img src="img/<?php echo htmlspecialchars($post['user_avatar'], ENT_QUOTES, 'UTF-8'); ?>" alt="User Avatar" class="user-avatar">
                        <span><?php echo htmlspecialchars($post['user_name'], ENT_QUOTES, 'UTF-8'); ?><br>
                        <?php echo htmlspecialchars(date('F j, Y, g:i a', strtotime($post['created_at'])), ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>

                    <!-- Post Content -->
                    <h2><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p><?php echo htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php if (!empty($post['image_url'])): ?>
                        <img src="img/<?php echo htmlspecialchars($post['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="Post Image" class="post-image">
                    <?php endif; ?>

                    <!-- Comments -->
                    <div class="comments">
                        <h3>Comments:</h3>
                        <?php if (!empty($post['comments'])): ?>
                            <?php $visibleComments = array_slice($post['comments'], 0, 3); ?>
                            <?php foreach ($visibleComments as $comment): ?>
                                <div class="comment">
                                    <img src="img/<?php echo htmlspecialchars($comment['user_avatar'], ENT_QUOTES, 'UTF-8'); ?>" alt="Commenter Avatar" class="user-avatar">
                                    <div>
                                        <span><?php echo htmlspecialchars($comment['user_name'], ENT_QUOTES, 'UTF-8'); ?><br>
                                        <?php echo htmlspecialchars(date('F j, Y, g:i a', strtotime($comment['created_at'])), ENT_QUOTES, 'UTF-8'); ?></span>
                                        <p><?php echo htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php if (count($post['comments']) > 3): ?>
                                <button class="toggle-comments">Show More Comments</button>
                                <div class="all-comments hidden">
                                    <?php foreach (array_slice($post['comments'], 3) as $comment): ?>
                                        <div class="comment">
                                            <img src="img/<?php echo htmlspecialchars($comment['user_avatar'], ENT_QUOTES, 'UTF-8'); ?>" alt="Commenter Avatar" class="user-avatar">
                                            <div>
                                                <span><?php echo htmlspecialchars($comment['user_name'], ENT_QUOTES, 'UTF-8'); ?><br>
                                                <?php echo htmlspecialchars(date('F j, Y, g:i a', strtotime($comment['created_at'])), ENT_QUOTES, 'UTF-8'); ?></span>
                                                <p><?php echo htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <p>No comments yet.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Add Comment Form -->
                    <form action="posts.php" method="POST" class="comment-form">
                        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['post_id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="text" name="comment" placeholder="Add a comment" required>
                        <button type="submit">Post Comment</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script src="js/comments.js"></script>
</body>
</html>
