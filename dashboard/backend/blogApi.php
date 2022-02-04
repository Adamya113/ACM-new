<?php

include_once './blogFunctions.php';

function blogInit()
{
    $database = new Database();
    $db = $database->connect();
    $blog = new Blog($db);
    return $blog;
}

function createBlog()
{
    if ($_SERVER['REQUEST_METHOD'] !== "POST") {
        echo "Cannot " . $_SERVER['REQUEST_METHOD'] . " /createBlog";
        return;
    }

    $blog = blogInit();
    $req = json_decode(file_get_contents('php://input'), true);
    if ($req["blogTitle"] && $req["userEmail"] && $req["userName"] && $req["content"] && $req["coverImage"]) {
        $result = $blog->createBlog($req);
        if ($result) {
            $allBlogs = $blog->fetchAllBlogs($req["userEmail"]);
            $allBlogsArr = array();
            if ($allBlogs->num_rows > 0) {
                while ($row = $allBlogs->fetch_assoc()) {
                    $blogRow = array(
                        "blogId" => $row["blogId"],
                        "blogTitle" => $row["blogTitle"],
                        "coverImage" => $row["coverImage"],
                        "content" => $row["content"],
                        "userEmail" => $row["userEmail"],
                        "userName" => $row["userName"],
                        "isDraft" => boolval($row["isDraft"]),
                        "tags" => unserialize($row["tags"]),
                        "created" => $row["created"],
                        "published" => $row["published"],
                        "lastUpdated" => $row["lastUpdated"],
                        "approved" => boolval($row["approved"])
                    );
                    array_push($allBlogsArr, $blogRow);
                }
                echo json_encode(array("message" => "success", "blogs" => $allBlogsArr));
            } else {
                echo json_encode(array("error" => "no blogs found"));
            };
        }
    } else {
        echo json_encode(array('error' => 'One or more fields are missing.'));
        return;
    }
}

function fetchUserBlogs()
{
    if ($_SERVER['REQUEST_METHOD'] !== "POST") {
        echo "Cannot " . $_SERVER['REQUEST_METHOD'] . " /blogs";
        return;
    }

    $blog = blogInit();
    $req = json_decode(file_get_contents('php://input'), true);
    if ($req["userEmail"]) {
        $allBlogs = $blog->fetchAllBlogs($req["userEmail"]);
        $allBlogsArr = array();
        if ($allBlogs->num_rows > 0) {
            while ($row = $allBlogs->fetch_assoc()) {
                $blogRow = array(
                    "blogId" => $row["blogId"],
                    "blogTitle" => $row["blogTitle"],
                    "coverImage" => $row["coverImage"],
                    "content" => $row["content"],
                    "userEmail" => $row["userEmail"],
                    "userName" => $row["userName"],
                    "isDraft" => boolval($row["isDraft"]),
                    "tags" => unserialize($row["tags"]),
                    "created" => $row["created"],
                    "published" => $row["published"],
                    "lastUpdated" => $row["lastUpdated"],
                    "approved" => boolval($row["approved"])
                );
                array_push($allBlogsArr, $blogRow);
            }
            echo json_encode(array("message" => "success", "blogs" => $allBlogsArr));
        } else {
            echo json_encode(array("error" => "no blogs found"));
        };
    } else {
        echo json_encode(array('error' => 'One or more fields are missing.'));
        return;
    }
}

function fetchSingleBlog()
{
    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        echo "Cannot " . $_SERVER['REQUEST_METHOD'] . " /singleBlog";
        return;
    }
    $req = json_decode(file_get_contents('php://input'), true);
    if($req["userEmail"] && $req["blogId"]){
        $blog = blogInit();        
        $singleBlog = $blog->fetchSingleBlog($req["userEmail"], $req["blogId"]);
        if ($singleBlog) {   
            $singleBlog = $singleBlog->fetch_assoc();
            echo json_encode(array(
                'message' => 'success',
                'blog' => array(
                    "blogId" => $singleBlog["blogId"],
                    "blogTitle" => $singleBlog["blogTitle"],
                    "coverImage" => $singleBlog["coverImage"],
                    "content" => $singleBlog["content"],
                    "userEmail" => $singleBlog["userEmail"],
                    "userName" => $singleBlog["userName"],
                    "isDraft" => boolval($singleBlog["isDraft"]),
                    "tags" => unserialize($singleBlog["tags"]),
                    "created" => $singleBlog["created"],
                    "published" => $singleBlog["published"],
                    "lastUpdated" => $singleBlog["lastUpdated"],
                    "approved" => boolval($singleBlog["approved"])
                )
            ));
        } else {
            echo json_encode(array('error' => 'Invalid Details'));
            return;
        }
    }else {
        echo json_encode(array('error' => 'One or more fields are missing.'));
        return;
    }
}

function updateBlog()
{
    if ($_SERVER['REQUEST_METHOD'] !== "POST") {
        echo "Cannot " . $_SERVER['REQUEST_METHOD'] . " /updateBlog";
        return;
    }

    $blog = blogInit();
    $req = json_decode(file_get_contents('php://input'), true);
    if ($req["blogId"] && $req["blogTitle"] && $req["userEmail"] && $req["content"] && $req["coverImage"]) {
        $result = $blog->updateBlog($req);
        if ($result) {
            $allBlogs = $blog->fetchAllBlogs($req["userEmail"]);
            $allBlogsArr = array();
            if ($allBlogs->num_rows > 0) {
                while ($row = $allBlogs->fetch_assoc()) {
                    $blogRow = array(
                        "blogId" => $row["blogId"],
                        "blogTitle" => $row["blogTitle"],
                        "coverImage" => $row["coverImage"],
                        "content" => $row["content"],
                        "userEmail" => $row["userEmail"],
                        "userName" => $row["userName"],
                        "isDraft" => boolval($row["isDraft"]),
                        "tags" => unserialize($row["tags"]),
                        "created" => $row["created"],
                        "published" => $row["published"],
                        "lastUpdated" => $row["lastUpdated"]
                    );
                    array_push($allBlogsArr, $blogRow);
                }
                echo json_encode(array("message" => "success", "blogs" => $allBlogsArr));
            } else {
                echo json_encode(array("error" => "no blogs found"));
            };
        }
    } else {
        echo json_encode(array('error' => 'One or more fields are missing.'));
        return;
    }
}

function deleteBlog()
{
    if ($_SERVER['REQUEST_METHOD'] !== "POST") {
        echo "Cannot " . $_SERVER['REQUEST_METHOD'] . " /deleteBlog";
        return;
    }

    $blog = blogInit();
    $req = json_decode(file_get_contents('php://input'), true);
    if ($req["blogId"] && $req["userEmail"]) {
        $result = $blog->deleteBlog($req["blogId"]);
        if ($result) {
            $allBlogs = $blog->fetchAllBlogs($req["userEmail"]);
            $allBlogsArr = array();
            if ($allBlogs->num_rows > 0) {
                while ($row = $allBlogs->fetch_assoc()) {
                    $blogRow = array(
                        "blogId" => $row["blogId"],
                        "blogTitle" => $row["blogTitle"],
                        "coverImage" => $row["coverImage"],
                        "content" => $row["content"],
                        "userEmail" => $row["userEmail"],
                        "userName" => $row["userName"],
                        "isDraft" => boolval($row["isDraft"]),
                        "tags" => unserialize($row["tags"]),
                        "created" => $row["created"],
                        "published" => $row["published"],
                        "lastUpdated" => $row["lastUpdated"]
                    );
                    array_push($allBlogsArr, $blogRow);
                }
                echo json_encode(array("message" => "success", "blogs" => $allBlogsArr));
            } else {
                echo json_encode(array("error" => "No Blogs"));
            };
        }
    } else {
        echo json_encode(array('error' => 'Missing id'));
        return;
    }
}
