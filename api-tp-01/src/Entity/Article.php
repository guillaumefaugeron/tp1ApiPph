<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("article:detail")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups("article:detail")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     * @Groups("article:detail")
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("article:detail")
     */
    private $trending;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("article:detail")
     */
    private $published;

    /**
     * @ORM\Column(type="date")
     * @Groups("article:detail")

     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     * @Groups("article:detail")
     */
    private $category_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTrending(): ?bool
    {
        return $this->trending;
    }

    public function setTrending(bool $trending): self
    {
        $this->trending = $trending;

        return $this;
    }

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setPublished(?\DateTimeInterface $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getCategoryId(): ?category
    {
        return $this->category_id;
    }

    public function setCategoryId(?category $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }
}
