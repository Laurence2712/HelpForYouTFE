<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     */
    private $commentator;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="allComments")
     */
    private $commented;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCommentator(): ?User
    {
        return $this->commentator;
    }

    public function setCommentator(?User $commentator): self
    {
        $this->commentator = $commentator;

        return $this;
    }

    public function getCommented(): ?User
    {
        return $this->commented;
    }

    public function setCommented(?User $commented): self
    {
        $this->commented = $commented;

        return $this;
    }

   

    public function __toString() 
    {
        return (string) $this->text; 
    }

}
