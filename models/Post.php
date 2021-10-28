<?php

namespace models;

use config\Dbh;

class Post extends Dbh
{

    private $table = "posts";
    public $id;
    public $title;
    public $body;
    public $author;
    public $category_id;

    public function all()
    {
        $sql = "SELECT p.*, c.name AS category FROM $this->table p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        return $stmt;
    }


    public function show($id)
    {
        $sql = "SELECT p.*, c.name AS category from $this->table p LEFT JOIN categories c ON p.category_id WHERE p.id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }

    public function create()
    {
        $sql = "INSERT INTO $this->table (title, body, author, category_id) values(?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);

        $data = array(
            $this->title,
            $this->body,
            $this->author,
            $this->category_id
        );

        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $sql = "UPDATE $this->table SET title = ?, body = ?, author = ?, category_id = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        $data = array(
            $this->title,
            $this->body,
            $this->author,
            $this->category_id,
            $this->id
        );

        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$this->id])) {
            return true;
        } else {
            return false;
        }
    }
}
