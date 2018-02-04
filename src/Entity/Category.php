<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestamps;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 * @ORM\HasLifecycleCallbacks
 */
class Category extends SerializableEntity
{
    /**
     * Use the Trait Timestamp to generate default timestamps
     */
    use Timestamps;

    /**
     * Define what attributes will be serializable
     *
     * @var array
     */
    protected $serializable = [
        'id',
        'name',
        'description'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $description;

    /**
     * Get Category ID
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set Category ID
     *
     * @param $id
     * @return Category
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the Category Name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the Category Name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the Category Description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the Category Description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }
}
