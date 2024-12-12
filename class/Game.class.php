<?php

class Game
{
    
    // ? signifie Null possible
    private ?int $id;
    private ?string $name;
    private ?float $price;
    private ?string $editor;
    private ?string $date;
    private ?string $description;
    private ?int $stock;
    private ?string $image;
    private ?string $rating;
    private ?int $players;
    private ?int $status;
    private ?int $type;

    /**
     * Object qui contient les valeures qui définissent un jeu vidéo.
     *
     * @param mixed $data Un tableau associatif avec les colonnes et leurs valeures.
     */
    public function __construct($data = NULL)
    {
        $this->setId(0);
        $this->setName("Nouveau jeu");
        $this->setPrice(0);
        $this->setEditor(null);
        $this->setDate(null);
        $this->setDescription(null);
        $this->setStock(0);
        $this->setImage(null);
        $this->setRating(null);
        $this->setPlayers(null);
        $this->setStatus(null);
        $this->setType(null);

        $this->hydrate($data);
    }

    public function hydrate($data = null){
        if (!is_null($data) and is_array($data)) {
            foreach ($data as $key => $value) {
                $methodName = "set" . ucfirst(str_replace("game_", "", $key));
                if (method_exists($this,$methodName)){
                    $this->{$methodName}($value);
                }
            }
        }
    }

    public function setId(?int $value)
    {
        $this->id = ($value < 0 ? 0 : $value);
    }
    public function getId($raw = false)
    {
        if (!is_null($this->id)){
            return ($raw ? $this->id : htmlspecialchars($this->id));
        } else {
            return 0;
        }
    }

    public function setName(?string $value)
    {
        $this->name = $value;
    }
    public function getName(bool $raw = false)
    {
        if (!is_null($this->name)){
            return ($raw ? $this->name : htmlspecialchars($this->name));
        } else {
            return "";
        }
    }

    public function setPrice(?float $value)
    {
        $this->price = ($value < 0 ? 0 : $value);
    }
    public function getPrice(bool $raw = false)
    {
        if (!is_null($this->price)){
            return ($raw ? $this->price : htmlspecialchars($this->price));
        } else {
            return 0;
        }
    }

    public function setEditor(?string $value)
    {
        $this->editor = $value;
    }
    public function getEditor(bool $raw = false)
    {
        if (!is_null($this->editor)){
            return ($raw ? $this->editor : htmlspecialchars($this->editor));
        } else {
            return "";
        }
    }

    public function setDate(?string $value)
    {
        $this->date = $value;
    }
    public function getDate(bool $raw = false)
    {
        if (!is_null($this->date)){
            return ($raw ? $this->date : htmlspecialchars($this->date));
        } else {
            return "";
        }
    }
    public function setDescription(?string $value)
    {
        $this->description = $value;
    }
    public function getDescription(bool $raw = false)
    {
        if (!is_null($this->description)){
            return ($raw ? $this->description : htmlspecialchars($this->description));
        } else {
            return "";
        }
    }
    public function setStock(?int $value)
    {
        $this->stock = ($value < 0 ? 0 : $value);
    }
    public function getStock(bool $raw = false)
    {
        if (!is_null($this->stock)){
            return ($raw ? $this->stock : htmlspecialchars($this->stock));
        } else {
            return 0;
        }
    }
    public function setImage(?string $value)
    {
        $this->image = $value;
    }
    public function getImage(bool $raw = false)
    {
        if (!is_null($this->image)){
            return ($raw ? $this->image : htmlspecialchars($this->image));
        } else {
            return "";
        }
    }
    public function setRating(?string $value)
    {
        $this->rating = $value;
    }
    public function getRating(bool $raw = false)
    {
        if (!is_null($this->rating)){
            return ($raw ? $this->rating : htmlspecialchars($this->rating));
        } else {
            return "";
        }
    }
    public function setPlayers(?int $value)
    {
        $this->players = ($value < 0 ? 0 : $value);
    }
    public function getPlayers(bool $raw = false)
    {
        if (!is_null($this->players)){
            return ($raw ? $this->players : htmlspecialchars($this->players));
        } else {
            return 0;
        }
    }
    public function setStatus(?int $value)
    {
        $this->status = ($value < 0 ? 0 : $value);
    }
    public function getStatus(bool $raw = false)
    {
        if (!is_null($this->status)){
            return ($raw ? $this->status : htmlspecialchars($this->status));
        } else {
            return 0;
        }
    }
    public function setType(?int $value)
    {
        $this->type = ($value < 0 ? 0 : $value);
    }
    public function getType(bool $raw = false)
    {
        if (!is_null($this->type)){
            return ($raw ? $this->type : htmlspecialchars($this->type));
        } else {
            return 0;
        }
    }

}

?>