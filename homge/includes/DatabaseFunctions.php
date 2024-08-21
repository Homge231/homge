<?php
// Database connection function
if (!function_exists('query')) {
    function query($pdo, $sql, $parameters = []) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($parameters);
        return $stmt;
    }
}

// Insert a post
if (!function_exists('insertPost')) {
    function insertPost($pdo, $userId, $title, $content, $imageUrl, $moduleId) {
        $sql = 'INSERT INTO posts (user_id, title, content, image_url, module_id) VALUES (:user_id, :title, :content, :image_url, :module_id)';
        $params = [
            ':user_id' => $userId,
            ':title' => $title,
            ':content' => $content,
            ':image_url' => $imageUrl,
            ':module_id' => $moduleId
        ];
        query($pdo, $sql, $params);
    }
}

// Update a post
if (!function_exists('updatePost')) {
    function updatePost($pdo, $id, $title, $content, $imageUrl, $moduleId) {
        $sql = 'UPDATE posts SET title = :title, content = :content, image_url = :image_url, module_id = :module_id WHERE id = :id';
        $params = [
            ':title' => $title,
            ':content' => $content,
            ':image_url' => $imageUrl,
            ':module_id' => $moduleId,
            ':id' => $id
        ];
        query($pdo, $sql, $params);
    }
}

// Display image
if (!function_exists('displayImage')) {
    function displayImage($imageUrl) {
        if (!empty($imageUrl)) {
            return '<img height="100px" src="img/' . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . '" alt="Image">';
        }
        return '<p>No Image</p>';
    }
}

if (!function_exists('manageModule')) {
    // Manage modules (add, update, delete)
function manageModule($pdo, $action, $moduleId = null, $moduleName = null) {
    switch ($action) {
        case 'fetch_all':
            $sql = 'SELECT * FROM modules';
            return query($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);
        case 'add':
            if ($moduleName) {
                $sql = 'INSERT INTO modules (module_name) VALUES (:module_name)';
                query($pdo, $sql, [':module_name' => $moduleName]);
            }
            break;
        case 'update':
            if ($moduleId && $moduleName) {
                $sql = 'UPDATE modules SET module_name = :module_name WHERE id = :id';
                query($pdo, $sql, [':module_name' => $moduleName, ':id' => $moduleId]);
            }
            break;
        case 'delete':
            if ($moduleId) {
                $sql = 'DELETE FROM modules WHERE id = :id';
                query($pdo, $sql, [':id' => $moduleId]);
            }
            break;
    }
}
}
if (!function_exists('deletePostByAdmin')) {
    function deletePostByAdmin($pdo, $postId) {
        // Check if the post exists
        $post = getPostById($pdo, $postId);
        if ($post) {
            deletePost($pdo, $postId);
            return true;
        }
        return false;
    }
}
if (!function_exists('deleteUser')) {
    function deleteUser($pdo, $userId) {
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
        $stmt->execute(['id' => $userId]);
}
}
if (!function_exists('deletePost')) {
    function deletePost($pdo, $id) {
        try {
            // First, delete associated comments
            $sql = 'DELETE FROM comments WHERE post_id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);

            // Then, delete the post itself
            $sql = 'DELETE FROM posts WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
// Add a comment
if (!function_exists('addComment')) {
    function addComment($pdo, $postId, $userId, $commentText) {
        $sql = "INSERT INTO comments (post_id, user_id, comment_text, created_at) VALUES (:post_id, :user_id, :comment_text, NOW())";
        $params = [
            ':post_id' => $postId,
            ':user_id' => $userId,
            ':comment_text' => $commentText
        ];
        query($pdo, $sql, $params);
    }
}

// Update user profile
if (!function_exists('updateUserProfile')) {
    function updateUserProfile($pdo, $userId, $name, $avatarUrl, $bio) {
        $sql = "UPDATE users SET name = :name, avatar = :avatar, bio = :bio WHERE id = :id";
        $params = [
            ':name' => $name,
            ':avatar' => $avatarUrl,
            ':bio' => $bio,
            ':id' => $userId
        ];
        query($pdo, $sql, $params);
    }
}
if (!function_exists('getAllPost')) {
    function getAllPosts($pdo) {
        $stmt = $pdo->query('SELECT * FROM posts');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
// Fetch all posts with users and comments
if (!function_exists('getAllPostsWithUsersAndComments')) {
    function getAllPostsWithUsersAndComments($pdo) {
        $sql = 'SELECT p.id AS post_id, p.title, p.content, p.image_url, p.created_at, 
                       u.id AS user_id, u.name AS user_name, u.avatar AS user_avatar
                FROM posts p
                JOIN users u ON p.user_id = u.id
                ORDER BY p.created_at DESC';
        $posts = query($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as &$post) {
            $post['comments'] = getCommentsByPostId($pdo, $post['post_id']);
        }
        return $posts;
    }
}


// Fetch a single post by ID
if (!function_exists('getPostById')) {
    function getPostById($pdo, $id) {
        $sql = 'SELECT * FROM posts WHERE id = :id';
        return query($pdo, $sql, [':id' => $id])->fetch(PDO::FETCH_ASSOC);
    }
}

if (!function_exists('getCommentsByPostId')) {
    function getCommentsByPostId($pdo, $postId) {
        $sql = 'SELECT c.comment_text, c.created_at, u.name AS user_name, u.avatar AS user_avatar
                FROM comments c
                JOIN users u ON c.user_id = u.id
                WHERE c.post_id = :post_id
                ORDER BY c.created_at DESC';
        return query($pdo, $sql, [':post_id' => $postId])->fetchAll(PDO::FETCH_ASSOC);
    }
}


// Fetch posts by user
if (!function_exists('getPostsByUserId')) {
    function getPostsByUserId($pdo, $userId) {
        $sql = 'SELECT * FROM posts WHERE user_id = :user_id';
        return query($pdo, $sql, [':user_id' => $userId])->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Fetch all modules
if (!function_exists('getAllModules')) {
    function getAllModules($pdo) {
        $sql = 'SELECT * FROM modules';
        return query($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}


// Fetch all users
if (!function_exists('getAllUsers')) {
    function getAllUsers($pdo) {
        $sql = 'SELECT * FROM users';
        return query($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Fetch a single user by ID
if (!function_exists('getUserById')) {
    function getUserById($pdo, $id) {
        $sql = 'SELECT * FROM users WHERE id = :id';
        return query($pdo, $sql, [':id' => $id])->fetch(PDO::FETCH_ASSOC);
    }
}



// Update a user
if (!function_exists('updateUser')) {
    function updateUser($pdo, $id, $name, $email, $password) {
        $sql = 'UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id';
        $params = [
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':id' => $id
        ];
        query($pdo, $sql, $params);
    }
}
