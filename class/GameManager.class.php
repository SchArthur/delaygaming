<?php

class GameManager
{
    private PDO $db;

    public function __construct()
    {
        $this->connect();
    }

    public function selectOne(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM table_game WHERE game_id = :id");
        $stmt->execute([":id" => $id]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return false;
    }

    public function delete(Game $game)
    {
        if ($game->getImage() != "") {
            foreach (Game::IMG_FORMAT as $prefix => $info){
                deleteFile($_SERVER["DOCUMENT_ROOT"] . "/upload/" . $prefix . $game->getImage());
            }
        }
        $stmt = $this->db->prepare("DELETE FROM table_game WHERE game_id = :id");
        $stmt->execute([":id" => $game->getId()]);
    }

    public function save(Game $game)
    {
        if ($game->getId() == 0) {
            $this->insert($game);
        } else {
            $this->update($game);
        }
    }

    private function insert(Game $game)
    {
        $stmt = $this->db->prepare("INSERT INTO table_game (
            game_name, game_editor, game_date, game_description, 
            game_price, game_stock, game_image, game_rating, 
            game_players, game_status, game_type
        ) VALUES (
            :game_name, :game_editor, :game_date, :game_description, 
            :game_price, :game_stock, :game_image, :game_rating, 
            :game_players, :game_status, :game_type
        )
        ");

        $stmt->bindValue(":game_name", $game->getName(true));
        $stmt->bindValue(":game_editor", $game->getEditor(true));
        $stmt->bindValue(":game_date", $game->getDate(true));
        $stmt->bindValue(":game_description", $game->getDescription(true));
        $stmt->bindValue(":game_price", $game->getPrice(true));
        $stmt->bindValue(":game_stock", $game->getStock(true));
        $stmt->bindValue(":game_image", $game->getImage(true));
        $stmt->bindValue(":game_rating", $game->getRating(true));
        $stmt->bindValue(":game_players", $game->getPlayers(true));
        $stmt->bindValue(":game_status", $game->getStatus(true));
        $stmt->bindValue(":game_type", $game->getType(true));
        $stmt->execute();
    }

    private function update(Game $game)
    {
        $stmt = $this->db->prepare("UPDATE table_game SET 
            game_name = :game_name,
            game_editor = :game_editor,
            game_date = :game_date,
            game_description = :game_description,
            game_price = :game_price,
            game_stock = :game_stock,
            game_image = :game_image,
            game_rating = :game_rating,
            game_players = :game_players,
            game_status = :game_status,
            game_type = :game_type
        WHERE
            game_id = :game_id
        ");

        $stmt->bindValue(":game_name", $game->getName(true));
        $stmt->bindValue(":game_editor", $game->getEditor(true));
        $stmt->bindValue(":game_date", $game->getDate(true));
        $stmt->bindValue(":game_description", $game->getDescription(true));
        $stmt->bindValue(":game_price", $game->getPrice(true));
        $stmt->bindValue(":game_stock", $game->getStock(true));
        $stmt->bindValue(":game_image", $game->getImage(true));
        $stmt->bindValue(":game_rating", $game->getRating(true));
        $stmt->bindValue(":game_players", $game->getPlayers(true));
        $stmt->bindValue(":game_status", $game->getStatus(true));
        $stmt->bindValue(":game_type", $game->getType(true));
        $stmt->bindValue(":game_id", $game->getId(true));
        $stmt->execute();
    }



    private function connect()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=delaygaming;charset=utf8", "root", "");
    }
}