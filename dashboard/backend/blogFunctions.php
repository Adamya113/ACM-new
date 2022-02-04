<?php

class Blog
{
    private $conn;
    private $table = "blogs";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createBlog($details)
    {
        boolval($details['isDraft']) ? $isDraft = 1 : $isDraft = 0;
        $tags = $details['tags'] ? serialize($details['tags']) : serialize([]);
        $content = str_replace("'", "`", $details['content']);

        $query =
            "INSERT INTO $this->table
                (userEmail, userName, blogTitle, coverImage, content, tags, isDraft, approved)
                VALUES (
                    '$details[userEmail]',
                    '$details[userName]',
                    '$details[blogTitle]',
                    '$details[coverImage]',
                    '$content',
                    '$tags',
                    $isDraft,
                    0
                )";
        $res = $this->conn->query($query);
        return $res;
    }

    public function fetchAllBlogs($userEmail)
    {
        $query =
            "SELECT * FROM $this->table 
                WHERE userEmail = '$userEmail'";

        $res = $this->conn->query($query);
        return $res;
    }
    
    public function fetchSingleBlog($userEmail, $blogId)
    {
        $query =
            "SELECT * FROM $this->table 
                WHERE userEmail = '$userEmail' and blogId = '$blogId'";

        $res = $this->conn->query($query);
        return $res;
    }

    public function updateBlog($details)
    {
        boolval($details['isDraft']) ? $isDraft = 1 : $isDraft = 0;
        boolval($details['isPublished']) ? $isPublishing = 0 : ($isDraft ? $isPublishing = 0 : $isPublishing = 1);
        $tags = $details['tags'] ? serialize($details['tags']) : serialize([]);

        $query = $isPublishing ?
            "UPDATE $this->table
                    SET 
                        blogTitle = '$details[blogTitle]',
                        coverImage = '$details[coverImage]',
                        content = '$details[content]',
                        tags = '$tags',
                        isDraft = '$isDraft',
                        published = (SELECT CURRENT_TIMESTAMP)
                    WHERE userEmail = '$details[userEmail]' AND blogId = '$details[blogId]'"
            :
            "UPDATE $this->table
                    SET 
                        blogTitle = '$details[blogTitle]',
                        coverImage = '$details[coverImage]',
                        content = '$details[content]',
                        tags = '$tags',
                        isDraft = '$isDraft'
                    WHERE userEmail = '$details[userEmail]' AND blogId = '$details[blogId]'";

        $res = $this->conn->query($query);
        return $res;
    }

    public function deleteBlog($id)
    {
        $query =
            "DELETE FROM $this->table 
                WHERE blogId = '$id'";

        $res = $this->conn->query($query);
        return $res;
    }
}
