<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 * @UniqueEntity(
 * fields={"email"},
 * message="L'email que vous avez utilisé est déjà utilisé"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $lastname;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     * 
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password",  message ="Vous n'avez pas inscrit le même mot de passe.")
     */
    public $confirm_password;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $image_size;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Request::class, mappedBy="requester")
     */
    private $requests;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="commentator")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="commented")
     */
    private $allComments;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    //private $role;


    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="users")
     */
    private $roles;

    public function __construct()
    {
        $this->requests = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->allComments = new ArrayCollection();
        //$this->setRole = array('membre');
        //$this->roles = array("ROLE_MEMBER");
       $this->roles = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(string $image_name): self
    {
        $this->image_name = $image_name;

        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->image_size;
    }

    public function setImageSize(int $image_size): self
    {
        $this->image_size = $image_size;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

  

    /*public function getRoles(){
        return ['ROLE_USER'];

    }*/

    /**
     * @return String[] Array of roles as String (e.g. 'ROLE_ADMIN')
     * @see UserInterface
     */
    public function getRoles(): array
    {
        foreach($this->roles as $role) {
            $roles[] = $role->getRole();
        }

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }

        return $this;
    }



    /**
     * @return Collection|Request[]
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(Request $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests[] = $request;
            $request->setRequester($this);
        }

        return $this;
    }

    public function removeRequest(Request $request): self
    {
        if ($this->requests->contains($request)) {
            $this->requests->removeElement($request);
            // set the owning side to null (unless already changed)
            if ($request->getRequester() === $this) {
                $request->setRequester(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCommentator($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getCommentator() === $this) {
                $comment->setCommentator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getAllComments(): Collection
    {
        return $this->allComments;
    }

    public function addAllComment(Comment $allComment): self
    {
        if (!$this->allComments->contains($allComment)) {
            $this->allComments[] = $allComment;
            $allComment->setCommented($this);
        }

        return $this;
    }

    public function removeAllComment(Comment $allComment): self
    {
        if ($this->allComments->contains($allComment)) {
            $this->allComments->removeElement($allComment);
            // set the owning side to null (unless already changed)
            if ($allComment->getCommented() === $this) {
                $allComment->setCommented(null);
            }
        }

        return $this;
    }

     /**
      * A visual identifier that represents this user.
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
     /**
     * @see UserInterface
     */
    public function eraseCredentials(){

    }
    /**
     * @see UserInterface
     */
    public function getSalt(){

    }
    /*public function __toString()
    {
        return $this->role;
    }*/

   

    
}
